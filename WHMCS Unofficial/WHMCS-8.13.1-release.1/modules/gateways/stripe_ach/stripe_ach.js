/*
 * WHMCS Stripe ACH Javascript
 *
 * @copyright Copyright (c) WHMCS Limited 2005-2019
 * @license http://www.whmcs.com/license/ WHMCS Eula
 */
function initStripeACH()
{
    var paymentForm = jQuery('#frmPayment');

    if (paymentForm.length) {
        jQuery('#inputBankAcctType').closest('div.form-group').slideUp().remove();
        jQuery('#inputBankRoutingNum').closest('div.form-group').slideUp().remove();
        jQuery('#inputBankName').closest('div.form-group').slideUp().remove();
        jQuery('#inputBankAcctNum').closest('div.form-group').slideUp().remove();
        jQuery('#billingAddressChoice').closest('div.form-group').slideUp().remove();
        var btnContainer = jQuery('#btnSubmitContainer'),
            currentSelection = jQuery('input[name="paymethod"]:checked').val();

        paymentForm.off('submit');
        btnContainer.find('button').addClass('disabled').prop('disabled', true);

        jQuery('#inputDescriptionContainer').after(
            '<div class="form-group row bank-details">\n' +
            '    <label for="inputBankDetails" class="col-sm-4 control-label">\n' +
            '        \n' +
            '    </label>\n' +
            '    <div class="col-sm-6">\n' +
            '        <button type="button" class="btn btn-default form-control" id="inputBankDetails">' +
            '            <i class="fal fa-plus-circle"></i> Add Bank Information' +
            '        </button>' +
            '    </div>\n' +
            '</div>' +
            '<div id="mandateAcceptanceContainer" class="form-group bank-details">\n' +
            '    <div class="alert alert-info" id="mandateAcceptance">\n' +
            lang.mandate_acceptance +
            '    </div>\n' +
            '</div>'
        );
        var bankDetailsId = '#inputBankDetails',
            inputBankDetails = jQuery(bankDetailsId);

        if (currentSelection === 'new') {
            if (inputBankDetails.not(':visible')) {
                inputBankDetails.show('fast');
            }
            jQuery(document).on('click', bankDetailsId, handler_open);
        } else {
            if (inputBankDetails.is(':visible')) {
                inputBankDetails.hide('fast');
            }
            jQuery(document).off('click', bankDetailsId);
            btnContainer.find('button').removeClass('disabled').prop('disabled', false);
        }

        jQuery('input[name="paymethod"]').on('ifChecked', function() {
            inputBankDetails = jQuery('#inputBankDetails');
            if (jQuery(this).val() === 'new') {
                btnContainer.find('button').addClass('disabled').prop('disabled', true);
                jQuery(document).on('click', bankDetailsId, handler_open);
            } else {
                if (inputBankDetails.is(':visible')) {
                    inputBankDetails.hide('fast');
                }
                jQuery(document).off('click', bankDetailsId);
                btnContainer.find('button').removeClass('disabled').prop('disabled', false);
            }
        });
    }
}

function stripe_ach_reset_input_to_new()
{
    jQuery('input[name="paymethod"][value="new"]').iCheck('check');

    setTimeout(function() {
        jQuery('.gateway-errors').slideUp();
    }, 4000);
}

function handler_open(event) {
    event.preventDefault();
    var paymentForm = jQuery('#frmPayment'),
        displayError = jQuery('.gateway-errors').first(),
        clientName = jQuery('#inputBankAcctHolderName').val();

    if (!clientName) {
        displayError.html(lang.account_holder_name_required);
        if (displayError.not(':visible')) {
            displayError.slideDown();
        }
        scrollToGatewayInputError();
        return;
    }

    stripeACH.collectBankAccountForSetup({
        clientSecret: clientToken,
        params: {
            payment_method_type: 'us_bank_account',
            payment_method_data: {
                billing_details: {
                    name: clientName,
                    email: clientEmail,
                }
            },
        },
        expand: ['payment_method'],
    })
        .then(({setupIntent, error}) => {
            if (error) {
                displayError.html(error.message);
                if (displayError.not(':visible')) {
                    displayError.slideDown();
                }
                scrollToGatewayInputError();
                // PaymentMethod collection failed for some reason.
            } else if (setupIntent.status === 'requires_payment_method') {
                // Customer canceled the hosted verification modal. Present them with other
                // payment method type options.
                displayError.html(lang.requires_payment_method);
                if (displayError.not(':visible')) {
                    displayError.slideDown();
                }
                scrollToGatewayInputError();
            } else if (setupIntent.status === 'requires_confirmation') {
                // We collected an account - possibly instantly verified, but possibly
                // manually-entered. Display payment method details and mandate text
                // to the customer and confirm the intent once they accept
                // the mandate.

                stripeACH.confirmUsBankAccountSetup(clientToken)
                    .then(({setupIntent, error}) => {
                        if (error) {
                            displayError.html(error.message);
                            if (displayError.not(':visible')) {
                                displayError.slideDown();
                            }
                            scrollToGatewayInputError();
                            // The payment failed for some reason.
                        } else if (setupIntent.status === "requires_payment_method") {
                            displayError.html(lang.requires_payment_method);
                            if (displayError.not(':visible')) {
                                displayError.slideDown();
                            }
                            scrollToGatewayInputError();
                            // Confirmation failed. Attempt again with a different payment method.
                        } else if (
                            setupIntent.status === "succeeded"
                            || setupIntent.next_action?.type === "verify_with_microdeposits"
                        ) {
                            var hiddenInput = document.createElement('input');
                            hiddenInput.setAttribute('type', 'hidden');
                            hiddenInput.setAttribute('name', 'remoteStorageToken');
                            hiddenInput.setAttribute('value', setupIntent.id);
                            paymentForm.append(hiddenInput);

                            var inputBankDetails = jQuery('#inputBankDetails');

                            if (inputBankDetails.is(':visible')) {
                                inputBankDetails.hide('fast');
                            }

                            jQuery('#inputBankAcctHolderName').attr('readonly', true);
                            paymentForm.submit();
                            // Confirmation succeeded! The account will be debited.
                            // Display a message to customer.
                        }
                    });
            }
        });
}
