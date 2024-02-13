jQuery(document).ready(function() {
    jQuery('[data-toggle="tooltip"]').tooltip();
    jQuery('[data-toggle="popover"]').popover();
    jQuery('.inline-editable').editable({
        mode: 'inline',
        params: function(params) {
            params.action = 'savefield';
            params.token = csrfToken;
            return params;
        }
    });

    generateBootstrapSwitches();

    jQuery('select.form-control.enhanced').select2({
        theme: 'bootstrap'
    });

    jQuery('body').on('click', '.copy-to-clipboard', WHMCS.ui.clipboard.copy);

    jQuery(".credit-card-type li a").click(function() {
        jQuery("#selectedCard").html(jQuery(this).html());
        jQuery("#cctype").val(jQuery('span.type', this).html());
    });

    jQuery('.paging-dropdown li a,.page-selector').click(function() {
        if (jQuery(this).parent().hasClass('disabled')) {
            return false;
        }
        var form = jQuery('#frmRecordsFound');
        jQuery("#currentPage").html(jQuery(this).data('page'));
        form.find('input[name="page"]')
            .val(jQuery(this).data('page')).end();
        form.submit();
        return false;
    });

    jQuery(".no-results a").click(function(e) {
        e.preventDefault();
        jQuery('#checkboxShowHidden').bootstrapSwitch('state', false);
    });

    jQuery('body').on('click', 'a.autoLinked', function (e) {
        e.preventDefault();
        if (jQuery(this).hasClass('disabled')) {
            return false;
        }

        var child = window.open();
        child.opener = null;
        child.location = $(this).attr('href');
    });

    jQuery('#divModuleSettings').on('click', '.icon-refresh', function() {
        fetchModuleSettings(jQuery(this).data('product-id'), 'simple');
        processAddonDisplay();
    });

    jQuery('#mode-switch').click(function() {
        fetchModuleSettings(jQuery(this).data('product-id'), jQuery(this).attr('data-mode'));
    });

    $('body').on('click', '.modal-wizard .modal-submit', function() {
        var modal = $('#modalAjax');
        modal.find('.loader').show();
        modal.find('.modal-submit').prop('disabled', true);

        $('.modal-wizard .wizard-step:hidden :input').attr('disabled', true);

        var form = document.forms.namedItem('frmWizardContent'),
            oData = new FormData(form),
            currentStep = $('.modal-wizard .wizard-step:visible').data('step-number'),
            ccGatewayFormSubmitted = $('#ccGatewayFormSubmitted').val(),
            enomFormSubmitted = $('#enomFormSubmitted').val(),
            oReq = new XMLHttpRequest();

        if ((ccGatewayFormSubmitted && currentStep == 3) || (enomFormSubmitted && currentStep == 5)) {
            wizardStepTransition(false, true);
            fadeoutLoaderAndAllowSubmission(modal);
        } else {

            oReq.open('POST', $('#frmWizardContent').attr('action'), true);

            oReq.send(oData);
            oReq.onload = function () {
                if (oReq.status == 200) {
                    try {
                        var data = JSON.parse(oReq.responseText),
                            doNotShow = $('#btnWizardDoNotShow');
                        if (doNotShow.is(':visible')) {
                            doNotShow.fadeOut('slow', function () {
                                $('#btnWizardSkip').hide().removeClass('hidden').fadeIn('slow');
                            });
                        }

                        if (data.success) {
                            if (data.sslData) {
                                var sslData = data.sslData;
                                if (sslData.approverEmails) {
                                    for (i = 0; i < sslData.approverEmails.length; i++) {
                                        var email = sslData.approverEmails[i];
                                        $('.modal-wizard .cert-approver-emails')
                                            .append('<label class="radio-inline">' +
                                                '<input type="radio" name="approver_email" value="' + email + '"> '
                                                + email + '</label><br>');
                                    }
                                }
                                if (sslData.approvalMethods) {
                                    for (i = 0; i < sslData.approvalMethods.length; i++) {
                                        $("label[for='" + sslData.approvalMethods[i] + "Method']")
                                            .removeClass('hidden').show();
                                    }
                                }
                            } else if (data.authData) {
                                var authData = data.authData;
                                if (authData.method == 'emailauth') {
                                    $('.modal-wizard .cert-email-auth').removeClass('hidden');
                                    $('.modal-wizard .cert-email-auth-emailapprover').val(authData.email);
                                } else if (authData.method == 'fileauth') {
                                    $('.modal-wizard .cert-file-auth').removeClass('hidden');
                                    $('.modal-wizard .cert-file-auth-filename')
                                        .val('http://<domain>/' + authData.path + '/' + authData.name);
                                    $('.modal-wizard .cert-file-auth-contents').val(authData.contents);
                                } else if (authData.method == 'dnsauth') {
                                    $('.modal-wizard .cert-dns-auth').removeClass('hidden');
                                    $('.modal-wizard .cert-dns-auth-contents').val(authData.value);
                                    $('.modal-wizard .cert-dns-auth-host').val(authData.host);
                                    $('.modal-wizard .cert-dns-auth-type').val(authData.type);
                                }
                            }

                            if (data.refreshMc) {
                                $('#btnMcServiceRefresh').click();
                            }
                            wizardStepTransition(data.skipNextStep, false);
                        } else {
                            wizardError(data.error);
                        }
                    } catch (err) {
                        wizardError('An error occurred while communicating with the server. Please try again.');
                    } finally {
                        fadeoutLoaderAndAllowSubmission(modal);
                    }
                } else {
                    alert('An error occurred while communicating with the server. Please try again.');
                    modal.find('.loader').fadeOut();
                }
            };
        }
    }).on('click', '#btnWizardSkip', function(e) {
        e.preventDefault();
        var currentStep = $('#inputWizardStep').val(),
            skipTwo = false;

        if (currentStep === '2' || currentStep === '4') {
            skipTwo = true;
        }
        wizardStepTransition(skipTwo, true);
    }).on('click', '#btnWizardBack', function(e) {
        e.preventDefault();
        wizardStepBackTransition();
    }).on('click', '#btnWizardDoNotShow', function(e) {
        e.preventDefault();
        WHMCS.http.jqClient.post('wizard.php', 'dismiss=true', function() {
            //Success or no, still hide now
            $('#modalAjax').modal('hide');
        });
    });

    $('#modalAjax').on('hidden.bs.modal', function (e) {
        if ($('#modalAjax').hasClass('modal-wizard')) {
            $('#btnWizardSkip').remove();
            $('#btnWizardBack').remove();
            $('#btnWizardDoNotShow').remove();
        }
    });

    $('#prodsall').click(function () {
        var checkboxes = $('.checkprods');
        checkboxes.filter(':visible').prop('checked', $(this).prop('checked')).end();
        if ($(this).prop('checked')) {
            checkboxes.filter(':hidden').prop('checked', !$(this).prop('checked')).end();
        }
    });
    $('#addonsall').click(function () {
        var checkboxes = $('.checkaddons');
        checkboxes.filter(':visible').prop('checked', $(this).prop('checked')).end();
        if ($(this).prop('checked')) {
            checkboxes.filter(':hidden').prop('checked', !$(this).prop('checked')).end();
        }
    });
    $('#domainsall').click(function () {
        var checkboxes = $('.checkdomains');
        checkboxes.filter(':visible').prop('checked', $(this).prop('checked')).end();
        if ($(this).prop('checked')) {
            checkboxes.filter(':hidden').prop('checked', !$(this).prop('checked')).end();
        }
    });

    jQuery('#addPayment').submit(function (e) {
        e.preventDefault();
        addingPayment = false;
        jQuery('#btnAddPayment').attr('disabled', 'disabled');
        jQuery('#paymentText').hide();
        jQuery('#paymentLoading').removeClass('hidden').show();

        var postData = jQuery(this).serialize().replace('action=edit', 'action=checkTransactionId'),
            post = WHMCS.http.jqClient.post(
            'invoices.php',
            postData + '&ajax=1'
        );

        post.done(function (data) {
            if (data.unique == false) {
                jQuery('#modalDuplicateTransaction').modal('show');
            } else {
                addInvoicePayment();
            }
        });
    });

    $('#modalDuplicateTransaction').on('hidden.bs.modal', function () {
        if (addingPayment === false) {
            jQuery('#paymentLoading').hide('fast', function() {
                jQuery('#paymentText').show('fast');
                jQuery('#btnAddPayment').removeAttr('disabled');
            });
        }
    });

    jQuery(document).on('click', '.feature-highlights-content .btn-action-1, .feature-highlights-content .btn-action-2', function() {
        var linkId = jQuery(this).data('link'),
            linkTitle = jQuery(this).data('link-title');

        WHMCS.http.jqClient.post(
            'whatsnew.php',
            {
                action: "link-click",
                linkId: linkId,
                linkTitle: linkTitle,
                token: csrfToken
            }
        );
    });

    /**
     * Admin Tagging
     */
    if (typeof mentionsFormat !== "undefined") {
        jQuery('#replynote[name="message"],#note[name="note"]').atwho({
            at: "@",
            displayTpl: "<li class=\"mention-list\">${gravatar} ${username} - ${name} (${email})</li>",
            insertTpl: mentionsFormat,
            data: WHMCS.adminUtils.getAdminRouteUrl('/mentions'),
            limit: 5
        });
    }

    jQuery('.search-bar .search-icon').click(function(e) {
        jQuery('.search-bar').find('input:first').focus();
    });
    jQuery('.btn-search-advanced').click(function(e) {
        jQuery(this).closest('.search-bar').find('.advanced-search-options').slideToggle('fast');
    });

    // DataTable data-driven auto object registration
    WHMCS.ui.dataTable.register();

    // Bootstrap Confirmation popup auto object registration
    WHMCS.ui.confirmation.register();

    var mcProductPromos = jQuery("#mcConfigureProductPromos");

    if (mcProductPromos.length) {
        var itemCount = mcProductPromos.find('.item').length;
        mcProductPromos.owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                850: {
                    items: (itemCount < 2 ? itemCount : 2)
                },
                1250: {
                    items: (itemCount < 3 ? itemCount : 3)
                },
                1650: {
                    items: (itemCount < 4 ? itemCount : 4)
                }
            }
        });

        jQuery('#dismissPromos').on('click', function() {
            mcProductPromos.slideUp('fast');
            jQuery(this).hide();
            WHMCS.http.jqClient.post(
                WHMCS.adminUtils.getAdminRouteUrl('/dismiss-marketconnect-promo'),
                {
                    token: csrfToken
                },
                function (data) {
                    //do nothing
                }
            );
        });
    }

    jQuery(document).on('submit', '#frmCreditCardDeleteDetails', function(e) {
        e.preventDefault();
        jQuery('#modalAjax .modal-submit').prop("disabled", true);
        jQuery('#modalAjax .loader').show();
        $('#remoteFailureDetails').slideUp();
        WHMCS.http.jqClient.post(
            jQuery(this).attr('action'),
            jQuery(this).serialize(),
            function(data) {
                if (!data.error) {
                    updateAjaxModal(data);
                } else {
                    $('#remoteFailureDetails')
                        .find('.alert').html(data.errorMsg)
                        .end()
                        .slideDown();

                    jQuery('#modalAjax .loader').fadeOut();
                }
            },
            'json'
        ).fail(function() {
            jQuery('#modalAjax .modal-body').html('An error occurred while communicating with the server. Please try again.');
            jQuery('#modalAjax .loader').fadeOut();
        });
    });

    if (jQuery('.captcha-type').length) {
        jQuery(document).on('change', '.captcha-type', function() {
            var settings = jQuery('.recaptchasetts');
            if (jQuery(this).val() === '') {
                settings.hide();
            } else {
                settings.show();
            }
        });
    }

    if (jQuery('#frmClientSearch').length) {
        jQuery(document).on('change', '.status', function() {
            jQuery('#status').val(jQuery(this).val());
        });
    }

    jQuery('.ssl-state.ssl-sync').each(function () {
        var self = jQuery(this);
        WHMCS.http.jqClient.post(
            WHMCS.adminUtils.getAdminRouteUrl('/domains/ssl-check'),
            {
                'domain': self.data('domain'),
                'userid': self.data('user-id'),
                'token': csrfToken
            },
            function (data) {
                self.replaceWith('<img src="' + data.image + '" data-toggle="tooltip" title="' + data.tooltip + '" class="' + data.class + '">');
                jQuery('[data-toggle="tooltip"]').tooltip();
            }
        );
    });

    (function ($) {
        $.fn.setInputError = function(error) {
            this.parents('.form-group').addClass('has-error').find('.field-error-msg').text(error);
            return this;
        };
    })(jQuery);

    (function ($) {
        $.fn.showInputError = function () {
            this.parents(".form-group").addClass("has-error").find(".field-error-msg").show();
            return this;
        };
    })(jQuery);

    // Admin datatable row expand functionality
    jQuery('.datatable .view-detail').click(function(e) {
            e.preventDefault();
            $currentRow = jQuery(this).closest('tr');
            var loader = '<i class="fa fa-spinner fa-spin"></i> Loading...';
            if (jQuery(this).hasClass('expanded')) {
                $currentRow.next('tr.detail-row').hide();
                jQuery(this).removeClass('expanded').find('i').removeClass('fa-minus').addClass('fa-plus');
            } else {
                var colCount = $currentRow.find('td').length;
                if (jQuery(this).hasClass('data-loaded')) {
                    $currentRow.next('tr.detail-row').show();
                } else {
                    var $newRow = $currentRow.after('<tr class="detail-row"><td colspan="' + colCount + '">' + loader + '</td></tr>');
                    WHMCS.http.jqClient.jsonGet({
                        url: jQuery(this).attr('href'),
                        success: function(response) {
                            $currentRow.next('tr.detail-row').remove();
                            $currentRow.after('<tr class="detail-row"><td colspan="' + colCount + '">' + response.output + '</td></tr>');
                        }
                    });
                }
                jQuery(this).find('i').addClass('fa-minus').removeClass('fa-plus');
                jQuery(this).addClass('expanded').addClass('data-loaded');
            }
        });
    jQuery(document).on('change', '.toggle-display', function() {
        var showElement = jQuery(this).data('show'),
            element = jQuery('.' + showElement);
        jQuery(document).find('div.toggleable').hide();
        if (element.hasClass('hidden')) {
            element.removeClass('hidden');
        }
        element.show();
    });

    jQuery(document).on('click', 'button.disable-submit', function(e) {
        var button = jQuery(this),
            form = button.closest('form');

        button.prepend('<i class="fas fa-spinner fa-spin"></i> ')
            .addClass('disabled')
            .prop('disabled', true);

        form.submit();
    });

    /**
     * Resend verification email button handler.
     */
    jQuery('#btnResendVerificationEmail').click(function() {
        var button = $(this);
        button.prop('disabled', true).html('<i class="fa fa-spinner fa-spin fa-fw"></i> ' + button.html());
        WHMCS.http.jqClient.jsonPost(
                {
                    url: window.location.href,
                    data: {
                        token: csrfToken,
                        action: 'resendVerificationEmail',
                        userid: button.data('clientid')
                    },
                    success: function(data) {
                        if (data.success) {
                            button.html(button.data('successmsg'));
                        } else {
                            button.html(button.data('errormsg'));
                        }
                    }
                }
            );
    });

    if (typeof Selectize !== 'undefined') {
        Selectize.define('whmcs_no_results', function (options) {
            var self = this;
            this.search = (function () {
                var original = self.search;

                return function () {
                    var results = original.apply(this, arguments);

                    var isActualItem = function (item) {
                        // item.id may be 'client' - this is an actual item
                        return isNaN(item.id) || item.id > 0;
                    };

                    var actualItems = results.items.filter(function (item) {
                        return isActualItem(item);
                    });

                    var noResultsItems = results.items.filter(function (item) {
                        return !isActualItem(item);
                    });

                    if (actualItems.length > 0) {
                        results.items = actualItems;
                    } else if (noResultsItems.length > 0) {
                        results.items = [noResultsItems[0]];
                    }

                    return results;
                };
            })();
        });
    }

    jQuery('.addon-type[name="atype"]').on('change', function() {
        fetchModuleSettings(jQuery(this).closest('td').data('addon-id'));
        processAddonDisplay();
    });

    jQuery(document).on('change', '.module-action-control', function() {
        var actionActor = $(this).data('actor');
        var params = jQuery('.module-action-param-row[data-action-type="' + actionActor + '"]');

        if (parseInt($(this).val())) {
            params.show();
        } else {
            params.hide();
        }
    });

    jQuery(document).on('click', '.btn-create-module-action-custom-field', function() {
        var self = this;
        var productId = jQuery(self).data('product-id');

        jQuery(self).attr('disabled', 'disabled');

        WHMCS.http.jqClient.jsonPost({
            url: 'configproducts.php',
            data: {
                action: 'create-module-action-custom-field',
                id: productId,
                token: csrfToken,
                field_name: jQuery(self).data('field-name'),
                field_type: jQuery(self).data('field-type')
            },
            success: function (data) {
                var btnSave = jQuery('#btnSaveProduct');

                if (jQuery(btnSave).attr('disabled')) {
                    jQuery.growl.notice(
                        {
                            title: '',
                            message: data.successMsg
                        }
                    );
                } else {
                    jQuery(btnSave).trigger('click');
                }
            },
            error: function (data) {
                jQuery(self).removeAttr('disabled');

                jQuery.growl.warning(
                    {
                        title: '',
                        message: data
                    }
                );
            }
        });
    });

    jQuery.each(jQuery('table.table-themed.data-driven'), function () {
        var self = $(this),
            table = self.DataTable();
        table.on('preXhr.dt', function (e, settings, data) {
            var d = document.createElement('div');
            jQuery(d).css({
                'background-color': '#fff',
                'opacity': '0.5',
                'position': 'absolute',
                'top': self.offset().top,
                'left': self.offset().left,
                'width': self.width() + 2,
                'height': self.height() + 2,
                'line-height': self.height() + 'px',
                'font-size': 40 + 'px',
                'text-align': 'center',
                'color': '#000',
                'border-radius': self.css('border-radius'),
                'zIndex': 100
            })
                .attr('id', self.attr('id') + 'overlay')
                .html('<strong><i class="fas fa-spinner fa-pulse"></i></strong>');
            self.before(d);
            data.token = csrfToken;
        });
        table.on('xhr.dt', function ( e, settings, info, xhr ) {
            jQuery('#' + self.attr('id') + 'overlay').remove();
            self.removeClass('text-muted');
        });
    });
});

var addingPayment = false,
    loadedModuleConfiguration = false,
    addonSupportsFeatures = false;

function updateServerGroups(requiredModule) {
    var optionServerTypes = '';
    var doShowOption = false;

    $('#inputServerGroup').find('option:not([value=0])').each(function() {
        optionServerTypes = $(this).attr('data-server-types');

        if (requiredModule && optionServerTypes) {
            doShowOption = (optionServerTypes.indexOf(',' + requiredModule + ',') > -1);
        } else {
            doShowOption = true;
        }

        if (doShowOption) {
            $(this).attr('disabled', false);
        } else {
            $(this).attr('disabled', true);

            if ($(this).is(':selected')) {
                $('#inputServerGroup').val('0');
            }
        }
    });
}

function processAddonDisplay()
{
    var element = jQuery('input[name="atype"]:checked');
    if (!loadedModuleConfiguration) {
        setTimeout(processAddonDisplay, 100);
        return;
    }
    var packageList = jQuery('#associatedPackages'),
        typeAndGroupRows = jQuery('#rowProductType,#rowServerGroup');
    packageList.find('option').prop('disabled', false);
    if (addonSupportsFeatures) {
        jQuery('#addonProvisioningType').find('div.radio').each(function() {
            $(this).removeClass('radio-disabled').find('input').prop('disabled', false);
        });
    }
    if (element.val() === 'feature') {
        packageList.find('option[data-server-module!="' + $('#inputModule').val() + '"]')
            .prop('checked', false)
            .prop('disabled', true);
        typeAndGroupRows.find('select').addClass('disabled').prop('disabled', true);
    } else {
        packageList.find('option').prop('disabled', false);
        typeAndGroupRows.find('select').removeClass('disabled').prop('disabled', false)
            .find('option[value="notAvailable"]').remove();
    }
    packageList.bootstrapDualListbox('refresh', true);
}

function fetchModuleSettings(productId, mode) {
    var gotValidResponse = false;
    var dataResponse = '';
    var switchLink = $('#mode-switch');
    var module = $('#inputModule').val();
    var addonProvisioningType = jQuery('#addonProvisioningType');

    if (module === "") {
        $('#divModuleSettings').html('');
        $('#noModuleSelectedRow').removeClass('hidden');
        $('#tblModuleAutomationSettings').find('input[type=radio]').attr('disabled', true);
        if (addonProvisioningType.length) {
            jQuery('input[name="atype"]').first().prop('checked', true);
            addonProvisioningType.find('div.radio').each(function(index) {
                $(this).addClass('radio-disabled').find('input').prop('disabled', true);
            });
        }
        return;
    }

    loadedModuleConfiguration = false;
    mode = mode || 'simple';
    if (mode !== 'simple' && mode !== 'advanced') {
        mode = 'simple';
    }
    requestedMode = mode;
    $('#divModuleSettings').addClass('module-settings-loading');
    $('#tblModuleAutomationSettings').addClass('module-settings-loading');
    $('#tblMetricSettings').addClass('module-settings-loading');
    $('#serverReturnedError').addClass('hidden');
    $('#moduleSettingsLoader').removeClass('hidden').show();
    switchLink.attr('data-product-id', productId);
    WHMCS.http.jqClient.post(window.location.pathname, {
        'action': 'module-settings',
        'module': module,
        'servergroup': $('#inputServerGroup').val(),
        'id': productId,
        'type': $('#selectType').val(),
        'atype': $('input[name="atype"]:checked').val(),
        'mode': mode
    },
    function(data) {
        gotValidResponse = true;
        $('#divModuleSettings').removeClass('module-settings-loading');
        $('#tblModuleAutomationSettings').removeClass('module-settings-loading');
        $('#tblMetricSettings').removeClass('module-settings-loading');
        $('#divModuleSettings').html('');
        switchLink.parent('div .module-settings-mode').addClass('hidden');
        if (module && data.error) {
            $('#serverReturnedErrorText').html(data.error);
            $('#serverReturnedError').removeClass('hidden');
        }
        if (module && data.content) {
            $('#noModuleSelectedRow').addClass('hidden');
            $('#divModuleSettings').html(data.content);
            $('#tblModuleAutomationSettings').find('input[type=radio]').removeAttr('disabled');
            if (data.mode === 'simple') {
                switchLink.attr('data-mode', 'advanced').find('span').addClass('hidden').parent().find('.text-advanced').removeClass('hidden');
                switchLink.parent('div .module-settings-mode').removeClass('hidden');
            } else {
                if (data.mode === 'advanced' && requestedMode === 'advanced') {
                    switchLink.attr('data-mode', 'simple').find('span').addClass('hidden').parent().find('.text-simple').removeClass('hidden');
                    switchLink.parent('div .module-settings-mode').removeClass('hidden');
                } else {
                    switchLink.parent('div .module-settings-mode').addClass('hidden');
                }
            }
            if (data.metrics) {
                $('#metricsConfig').html(data.metrics).show();
                $('#tblMetricSettings').removeClass('hidden').show();
                $('.metric-toggle').bootstrapSwitch({
                    size: 'mini',
                    onColor: 'success'
                }).on('switchChange.bootstrapSwitch', function(event, state) {
                    WHMCS.http.jqClient.post($(this).data('url'), 'action=toggle-metric&id=' + $('#inputProductId').val() + '&module=' + module + '&metric=' + $(this).data('metric') + '&token=' + csrfToken + '&enable=' + state);
                });
            } else {
                $('#tblMetricSettings').hide();
            }
            if (addonProvisioningType.length) {
                var packageList = jQuery('#associatedPackages'),
                    selectElements = jQuery('#selectType,#inputServerGroup'),
                    notAvailableOptions = selectElements.find('option[value="notAvailable"]');
                if (typeof data.supportsFeatures !== 'undefined') {
                    addonSupportsFeatures = data.supportsFeatures;
                    addonProvisioningType.find('div.radio').each(function() {
                        $(this).removeClass('radio-disabled').find('input').prop('disabled', false);
                    });
                }
                if (!addonSupportsFeatures) {
                    jQuery('input[name="atype"]').first().prop('checked', true);
                    addonProvisioningType.find('div.radio').each(function() {
                        $(this).addClass('radio-disabled').find('input').prop('disabled', true);
                    });
                    packageList.find('option').prop('disabled', false);
                    selectElements.removeClass('disabled').prop('disabled', false);
                    notAvailableOptions.remove();
                } else {
                    packageList.find('option').prop('disabled', true);
                    if (jQuery('input[name="atype"]:checked').val() === 'feature') {
                        selectElements.addClass('disabled').prop('disabled', true);
                        if (!notAvailableOptions.length) {
                            selectElements.prepend(
                                $('<option>').val('notAvailable')
                                    .text(data.languageStrings['notAvailableForStyle'])
                                    .attr('selected', 'selected')
                            );
                        }
                    }
                }
                packageList.bootstrapDualListbox('refresh', true);
            }
        } else {
            $('#noModuleSelectedRow').removeClass('hidden');
            $('#tblModuleAutomationSettings').find('input[type=radio]').attr('disabled', true);
        }
    }, "json")
    .always(function() {
        $('#moduleSettingsLoader').fadeOut();
        jQuery('[data-toggle="tooltip"]').tooltip();
        updateServerGroups(gotValidResponse ? module : '');

        if (!gotValidResponse) {
            // non json response, likely session expired
        }
        loadedModuleConfiguration = true;
    });
    return dataResponse;
}

function wizardCall(action, request, handler) {
    var requestString = 'wizard=' + $('input[name="wizard"]').val()
        + '&step=' + $('input[name="step"]').val()
        + '&token=' + $('input[name="token"]').val()
        + '&action=' + action
        + '&' + request;

    WHMCS.http.jqClient.post('wizard.php', requestString, handler);
}

function wizardError(errorMsg) {
    WHMCS.ui.effects.errorShake($('.modal-wizard .wizard-step:visible .info-alert:first')
        .html(errorMsg).removeClass('hidden').addClass('alert-danger'));
}

function wizardStepTransition(skipNextStep, skip) {
    var currentStepNumber = $('.modal-wizard .wizard-step:visible').data('step-number');
    if (skipNextStep) {
        increment = 2;
    } else {
        increment = 1;
    }
    var lastStep = $('.modal-wizard .wizard-step:visible');
    var nextStepNumber = currentStepNumber + increment;
    if ($('#wizardStep' + nextStepNumber).length) {
        $('#wizardStep' + currentStepNumber).fadeOut('', function() {
            var newClass = 'completed';
            if (skip) {
                newClass = 'skipped';
                $('#wizardStepLabel' + currentStepNumber + ' i').removeClass('fa-check-circle').addClass('fa-minus-circle');
            } else {
                lastStep.find('.signup-frm').hide();
                lastStep.find('.signup-frm-success').removeClass('hidden');

                if (currentStepNumber == 3) {
                    lastStep.find('.signup-frm-success')
                        .append('<input type="hidden" id="ccGatewayFormSubmitted" name="ccGatewayFormSubmitted" value="1" />');
                } else if (currentStepNumber == 5) {
                    lastStep.find('.signup-frm-success')
                        .append('<input type="hidden" id="enomFormSubmitted" name="enomFormSubmitted" value="1" />');
                }

            }

            if (nextStepNumber > 0) {
                // Show the BACK button.
                if (!$('#btnWizardBack').is(':visible')) {
                    $('#btnWizardBack').hide().removeClass('hidden').fadeIn('slow');
                }
            } else {
                $('#btnWizardBack').fadeOut('slow');
                $('#btnWizardDoNotShow').fadeIn('slow');
                $('#btnWizardSkip').fadeOut('slow');
            }
            $('#wizardStepLabel' + currentStepNumber).removeClass('current').addClass(newClass);
            $('.modal-wizard .wizard-step:visible :input').attr('disabled', true);
            $('#wizardStep' + nextStepNumber + ' :input').removeAttr('disabled');
            $('#wizardStep' + nextStepNumber).fadeIn();
            $('#inputWizardStep').val(nextStepNumber);
            $('#wizardStepLabel' + nextStepNumber).addClass('current');
        });
        if (!$('#wizardStep' + (nextStepNumber + 1)).length) {
            $('#btnWizardSkip').fadeOut('slow');
            $('#btnWizardBack').fadeOut('slow');
            $('.modal-submit').html('Finish');
        }
    } else {
        // end of steps
        $('#modalAjax').modal('hide');
    }
}

function wizardStepBackTransition() {
    var currentStepNumber = $('.modal-wizard .wizard-step:visible').data('step-number');
    var previousStepNumber = parseInt(currentStepNumber) - 1;

    $('#wizardStep' + currentStepNumber).fadeOut('', function() {
        if (previousStepNumber < 1) {
            $('#btnWizardBack').fadeOut('slow');
            $('#btnWizardDoNotShow').fadeIn('slow');
            $('#btnWizardSkip').addClass('hidden');
        }

        $('.modal-wizard .wizard-step:visible :input').attr('disabled', true);
        $('#wizardStep' + previousStepNumber + ' :input').removeAttr('disabled');
        $('#wizardStep' + previousStepNumber).fadeIn();
        $('#inputWizardStep').val(previousStepNumber);
        $('#wizardStepLabel' + previousStepNumber).addClass('current');
        $('#wizardStepLabel' + currentStepNumber).removeClass('current');
    });
}

function fadeoutLoaderAndAllowSubmission(modal) {
    modal.find('.loader').fadeOut();
    modal.find('.modal-submit').removeProp('disabled');
}

function openSetupWizard() {
    $('#modalFooterLeft').html('<a href="#" id="btnWizardSkip" class="btn btn-link pull-left hidden">Skip Step</a>' +
        '<a href="#" id="btnWizardDoNotShow" class="btn btn-link pull-left">Do not show this again</a>' +
        '</div>');
    $('#modalAjaxSubmit').before('<a href="#" id="btnWizardBack" class="btn btn-default hidden">Back</a>');
    openModal('wizard.php?wizard=GettingStarted', '', 'Getting Started Wizard', 'modal-lg', 'modal-wizard modal-setup-wizard', 'Next', '', '',true);
}

function addInvoicePayment() {
    addingPayment = true;
    jQuery('#modalDuplicateTransaction').modal('hide');
    WHMCS.http.jqClient.post(
        'invoices.php',
        jQuery('#addPayment').serialize() + '&ajax=1',
        function (data) {
            if (data.redirectUri) {
                window.location = data.redirectUri;
            }
        }
    );
}

function cancelAddPayment() {
    jQuery('#paymentLoading').fadeOut('fast', function() {
        jQuery('#paymentText').fadeIn('fast');
        jQuery('#btnAddPayment').removeAttr('disabled');
    });
    jQuery('#modalDuplicateTransaction').modal('hide');
}

function openFeatureHighlights() {
    openModal('whatsnew.php?modal=1', '', 'What\'s new in Version ...', '', 'modal-feature-highlights', '', '', '', true);
}

/**
 * Submit the first form that exists within a given container.
 *
 * @param {string} containerId The ID name of the container
 */
function autoSubmitFormByContainer(containerId) {
    if (typeof noAutoSubmit === "undefined" || noAutoSubmit === false) {
        jQuery("#" + containerId).find("form:first").submit();
    }
}

/**
 * Sluggify a text string.
 */
function slugify(text) {
    var search =  "āæåãàáäâảẩấćčçđẽèéëêếēėęīįìíïîłńñœøōõòóöôốớơśšūùúüûưÿžźż·/_,:;–"; // contains Unicode dash
    var replace = "aaaaaaaaaaacccdeeeeeeeeeiiiiiilnnooooooooooossuuuuuuyzzz-------";

    for (var i = 0, l = search.length; i < l; i++) {
        text = text.replace(new RegExp(search.charAt(i), 'g'), replace.charAt(i));
    }

    return text
        .toString()
        .toLowerCase()
        .trim()
        .replace(/\s+/g, '-')
        .replace(/&/g, '-and-')
        .replace(/[^\w\-]+/g, '')
        .replace(/\-\-+/g, '-');
}

function generateBootstrapSwitches()
{
    jQuery('.slide-toggle').bootstrapSwitch();
    jQuery('.slide-toggle-mini').bootstrapSwitch({
        size: 'mini'
    });
}

function submitForm(frmId, addTarget) {
    var formTarget = jQuery('#' + frmId);
    if (addTarget) {
        formTarget.attr('target', '_blank');
    } else {
        formTarget.removeAttr('target');
    }
    formTarget.submit();
}

function reverseCommissionConfirm(totalDue, remainingBalance) {
    var amountValue,
        form = jQuery('form#transactions'),
        formData = form.serializeArray();

    amountValue = formData.find(function (object) {
        return object['name'] === 'amount';
    }).value;
    if (!amountValue) {
        var transidValue = formData.find(function (object) {
            return object['name'] === 'transid';
        }).value;
        amountValue = jQuery('form#transactions select#transid option[value="' + transidValue + '"]').data('amount');
    }
    if ((remainingBalance + amountValue) < totalDue) {
        jQuery('#modalReverseAffiliateCommission').modal().show();
        return false;
    }
    jQuery(
        '<input>',
        {
            type: 'hidden',
            name: 'reverseCommission',
            value: 'true'
        }
    ).appendTo(form);
    form.removeAttr('onsubmit').submit();
}

function reverseCommissionSubmit(reverseCommission = false) {
    var form = jQuery('form#transactions');

    if (reverseCommission) {
        jQuery(
            '<input>',
            {
                type: 'hidden',
                name: 'reverseCommission',
                value: 'true'
            }
        ).appendTo(form);
    }
    form.removeAttr('onsubmit').submit();
}
