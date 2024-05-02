/*
 * WHMCS Stripe SEPA Javascript
 *
 * @copyright Copyright (c) WHMCS Limited 2005-2019
 * @license https://www.whmcs.com/license/ WHMCS Eula
 */
function initStripeSEPA()
{
    var paymentForm = jQuery('#frmPayment');

    if (paymentForm.length) {
        jQuery('#inputBankAcctType').closest('div.form-group').slideUp().remove();
        jQuery('#inputBankRoutingNum').closest('div.form-group').slideUp().remove();
        jQuery('#inputBankName').closest('div.form-group').slideUp().remove();
        jQuery('#inputBankAcctNum').closest('div.form-group').slideUp().remove();
        jQuery('#inputDescriptionContainer').before(
            '<div id="ibanElementContainer" class="form-group row bank-details">\n' +
            '    <label for="ibanElement" class="col-sm-4 control-label">\n' +
            lang.iban +
            '    </label>\n' +
            '<div class="col-sm-7">' +
            '    <div class="input-inline form-control" id="ibanElement">\n' +
            '</div>' +
            '    </div>\n' +
            '</div>' +
            '<div id="mandateAcceptanceContainer" class="form-group bank-details">\n' +
            '    <div class="alert alert-info" id="mandateAcceptance">\n' +
            lang.mandate_acceptance +
            '    </div>\n' +
            '</div>'

        );

        var currentSelection = jQuery('input[name="paymethod"]:checked').val(),
            ibanElementContainer = jQuery('#ibanElementContainer'),
            mandateAcceptanceContainer = jQuery('#mandateAcceptanceContainer'),
            bankAccountHolderContainer = jQuery('#inputBankAcctHolderName').closest('div.form-group');

        iban.mount('#ibanElement');

        paymentForm.off('submit');
        iban.off('change');

        if (currentSelection === 'new') {
            if (ibanElementContainer.not(':visible')) {
                ibanElementContainer.show('fast');
                iban.on('change', stripe_sepa_iban_change_event);
                paymentForm.on('submit.stripe_sepa', stripe_sepa_form_submit);
            }
            if (mandateAcceptanceContainer.not(':visible')) {
                mandateAcceptanceContainer.show('fast');
            }
            if (bankAccountHolderContainer.not(':visible')) {
                bankAccountHolderContainer.show('fast');
            }
        } else {
            if (ibanElementContainer.is(':visible')) {
                ibanElementContainer.hide('fast');
            }
            if (mandateAcceptanceContainer.is(':visible')) {
                mandateAcceptanceContainer.hide('fast');
            }
            if (bankAccountHolderContainer.is(':visible')) {
                bankAccountHolderContainer.hide('fast');
            }
        }

        jQuery('input[name="paymethod"]').on('ifChecked', function() {
            ibanElementContainer = jQuery('#ibanElementContainer');
            mandateAcceptanceContainer = jQuery('#mandateAcceptanceContainer');
            bankAccountHolderContainer = jQuery('#inputBankAcctHolderName').closest('div.form-group');
            if (jQuery(this).val() === 'new') {
                if (ibanElementContainer.not(':visible')) {
                    ibanElementContainer.show('fast');
                    iban.on('change', stripe_sepa_iban_change_event);
                    paymentForm.on('submit.stripe_sepa', stripe_sepa_form_submit);
                }
                if (mandateAcceptanceContainer.not(':visible')) {
                    mandateAcceptanceContainer.show('fast');
                }
                if (bankAccountHolderContainer.not(':visible')) {
                    bankAccountHolderContainer.show('fast');
                }
            } else {
                if (ibanElementContainer.is(':visible')) {
                    ibanElementContainer.hide('fast');
                    iban.off('change');
                    paymentForm.off('submit.stripe_sepa');
                }
                if (mandateAcceptanceContainer.is(':visible')) {
                    mandateAcceptanceContainer.hide('fast');
                }
                if (bankAccountHolderContainer.is(':visible')) {
                    bankAccountHolderContainer.hide('fast');
                }
            }
        });
    }
}

function stripe_sepa_iban_change_event(event)
{
    var displayError = jQuery('.gateway-errors').first();
    // Handle real-time validation errors from the iban Element.
    if (event.error && event.error.message.length) {
        displayError.html(event.error.message);
        if (displayError.not(':visible')) {
            displayError.slideDown();
        }
        scrollToGatewayInputError();
    } else {
        if (displayError.is(':visible')) {
            displayError.slideUp();
        }
    }
}

function stripe_sepa_form_submit(event)
{
    var submitButton = jQuery('#btnSubmit').addClass('disabled').prop('disabled', true),
        paymentForm = jQuery('#frmPayment'),
        displayError = jQuery('.gateway-errors').first();
    event.preventDefault();

    if (!stripeSepaValidate()) {
        submitButton.prop('disabled', false).removeClass('disabled');
        scrollToGatewayInputError();
        return false;
    }

    let billingContact = stripeSepaGetSelectedBillingContact();

    stripe.confirmSepaDebitSetup(
        clientToken,
        {
            payment_method: {
                sepa_debit: iban,
                billing_details: {
                    name: jQuery('#inputBankAcctHolderName').val(),
                    email: clientEmail,
                    address: {
                        country: billingContact.country,
                        line1: billingContact.address1,
                        line2: billingContact.address2,
                        postal_code: billingContact.postcode,
                        state: billingContact.state,
                        city:  billingContact.city
                    }
                }
            }
        }
    ).then(({setupIntent, error}) => {
        if (error) {
            displayError.html(error);
            if (displayError.not(':visible')) {
                displayError.slideDown();
            }
            scrollToGatewayInputError();
        } else if (setupIntent.status === 'requires_payment_method') {
            // Customer canceled the hosted verification modal. Present them with other
            // payment method type options.
            displayError.html(lang.requires_payment_method);
            if (displayError.not(':visible')) {
                displayError.slideDown();
            }
            scrollToGatewayInputError();
        } else if (setupIntent.status === 'succeeded') {
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'remoteStorageToken');
            hiddenInput.setAttribute('value', setupIntent.id);
            paymentForm.append(hiddenInput);

            var inputBankDetails = jQuery('#inputBankDetails');

            if (inputBankDetails.is(':visible')) {
                inputBankDetails.hide('fast');
            }

            paymentForm.off('submit.stripe_sepa');
            jQuery('#inputBankAcctHolderName').attr('readonly', true);
            paymentForm.submit();
        }
    });
}

function stripeSepaValidate()
{
    let frm = jQuery('#frmPayment');

    let showError = function (error){
        let displayError = jQuery('.gateway-errors').first();
        displayError.html(error);
        if (displayError.not(':visible')) {
            displayError.slideDown();
        }
    }

    if (!frm.find('#inputBankAcctHolderName').val()) {
        showError(lang.acctHolderError);
        return false;
    }

    let selectedContact = jQuery('input[name=billingcontact]:checked').val();

    if (selectedContact === 'new') {
        let contactContainer = frm.find('#newBillingAddress');
        if (!contactContainer.find('#inputAddress1').val()) {
            showError(lang.addressError);
            return false;
        }
        if (!contactContainer.find('#country').val()) {
            showError(lang.countryError);
            return false;
        }
    } else {
        let contactContainer = frm.find('.billing-contact-' + selectedContact);
        if (!contactContainer.find('.address1').text()) {
            showError(lang.addressError);
            return false;
        }
        if (!contactContainer.find('.country').text()) {
            showError(lang.countryError);
            return false;
        }
    }

    return true;
}

function stripeSepaGetSelectedBillingContact()
{
    let frm = jQuery('#frmPayment');

    let selectedContact = jQuery('input[name=billingcontact]:checked').val(),
        billingContact = {};

    if (selectedContact === 'new') {
        let contactContainer = frm.find('#newBillingAddress');
        billingContact = {
            name: contactContainer.find('.inputFirstName').text()
                + ' '
                + contactContainer.find('.inputLastName').text(),
            country: contactContainer.find('#country').val(),
            address1: contactContainer.find('#inputAddress1').val(),
            address2: contactContainer.find('#inputAddress2').val(),
            postcode: contactContainer.find('#inputPostcode').val(),
            state: (contactContainer.find('#stateinput').css("display") === "none")
                ? contactContainer.find('#stateselect').val()
                : contactContainer.find('#stateinput').val(),
            city: contactContainer.find('#inputCity').val(),
        };
    }
    else {
        let contactContainer = frm.find('.billing-contact-' + selectedContact);
        billingContact = {
            name: contactContainer.find('.name').text(),
            country: contactContainer.find('.country').text(),
            address1: contactContainer.find('.address1').text(),
            address2: contactContainer.find('.address2').text(),
            postcode: contactContainer.find('.postcode').text(),
            state: contactContainer.find('.state').text(),
            city: contactContainer.find('.city').text()
        };
    }

    return billingContact;
}

function stripeSourceHandler(source) {
    // Insert the Source ID into the form so it gets submitted to the server.
    var paymentForm = document.getElementById('frmPayment'),
        hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'remoteStorageToken');
    hiddenInput.setAttribute('value', source.id);
    paymentForm.appendChild(hiddenInput);
    // Submit the form.
    paymentForm.submit();
}
