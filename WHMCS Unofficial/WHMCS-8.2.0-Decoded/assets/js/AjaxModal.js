/*!
 * WHMCS Ajax Driven Modal Framework
 *
 * @copyright Copyright (c) WHMCS Limited 2005-2019
 * @license http://www.whmcs.com/license/ WHMCS Eula
 */
var ajaxModalSubmitEvents = [],
    ajaxModalPostSubmitEvents = [];
jQuery(document).ready(function(){
    jQuery(document).on('click', '.open-modal', function(e) {
        e.preventDefault();
        var url = jQuery(this).attr('href'),
            modalSize = jQuery(this).data('modal-size'),
            modalClass = jQuery(this).data('modal-class'),
            modalTitle = jQuery(this).data('modal-title'),
            submitId = jQuery(this).data('btn-submit-id'),
            submitLabel = jQuery(this).data('btn-submit-label'),
            submitColor = jQuery(this).data('btn-submit-color'),
            hideClose = jQuery(this).data('btn-close-hide'),
            disabled = jQuery(this).attr('disabled'),
            successDataTable = jQuery(this).data('datatable-reload-success');

        if (!disabled) {
            openModal(url, '', modalTitle, modalSize, modalClass, submitLabel, submitId, submitColor, hideClose, successDataTable);
        }
    });

    // define modal close reset action
    jQuery('#modalAjax').on('hidden.bs.modal', function (e) {
        if (jQuery(this).hasClass('modal-feature-highlights')) {
            var dismissForVersion = jQuery('#cbFeatureHighlightsDismissForVersion').is(':checked');
            WHMCS.http.jqClient.post(
                'whatsnew.php',
                {
                    dismiss: "1",
                    until_next_update: dismissForVersion ? '1' : '0',
                    token: csrfToken
                }
            );
        }

        jQuery('#modalAjax').find('.modal-body').empty();
        jQuery('#modalAjax').children('div.modal-dialog').removeClass('modal-lg');
        jQuery('#modalAjax').removeClass().addClass('modal whmcs-modal fade');
        jQuery('#modalAjax .modal-title').html('Title');
        jQuery('#modalAjax .modal-submit').html('Submit')
            .removeClass()
            .addClass('btn btn-primary modal-submit')
            .removeAttr('id')
            .removeAttr('disabled');
        jQuery('#modalAjax .loader').show();
    });
});

function openModal(url, postData, modalTitle, modalSize, modalClass, submitLabel, submitId, submitColor, hideClose, successDataTable) {
    //set the text of the modal title
    jQuery('#modalAjax .modal-title').html(modalTitle);

    // set the modal size via a class attribute
    if (modalSize) {
        jQuery('#modalAjax').children('div[class="modal-dialog"]').addClass(modalSize);
    }
    // set the modal class
    if (modalClass) {
        jQuery('#modalAjax').addClass(modalClass);
    }

    // set the modal class
    if (modalClass) {
        jQuery('#modalAjax').addClass(modalClass);
    }

    // set the text of the submit button
    if(!submitLabel){
       jQuery('#modalAjax .modal-submit').hide();
    } else {
        jQuery('#modalAjax .modal-submit').show().html(submitLabel);
        // set the button id so we can target the click function of it.
        if (submitId) {
            jQuery('#modalAjax .modal-submit').attr('id', submitId);
        }
    }

    if (hideClose) {
        jQuery('#modalAjaxClose').hide();
    }

    if (submitColor) {
        jQuery('#modalAjax .modal-submit').removeClass('btn-primary')
            .addClass('btn-' + submitColor);
    }

    jQuery('#modalAjax .modal-body').html('');

    jQuery('#modalSkip').hide();
    jQuery('#modalAjax .modal-submit').prop('disabled', true);

    // show modal
    jQuery('#modalAjax').modal('show');

    // fetch modal content
    WHMCS.http.jqClient.post(url, postData, function(data) {
        updateAjaxModal(data);
    }, 'json').fail(function() {
        jQuery('#modalAjax .modal-body').html('An error occurred while communicating with the server. Please try again.');
        jQuery('#modalAjax .loader').fadeOut();
    }).always(function () {
        var modalForm = jQuery('#modalAjax').find('form');
        // If a submitId is present, then we're working with a form and need to override the default event
        if (submitId) {
            modalForm.submit(function (event) {
                submitIdAjaxModalClickEvent();
                return false;
            });
        }
        if (successDataTable) {
            modalForm.data('successDataTable', successDataTable);
        }

        // Since the content is dynamically fetched, we have to check for the elements we want here too
        var inputs = jQuery(modalForm).find('input:not(input[type=checkbox],input[type=radio],input[type=hidden])');

        if (inputs.length > 0) {
            jQuery(inputs).first().focus();
        }
    });

    //define modal submit button click
    if (submitId) {
        /**
         * Reloading ajax modal multiple times on the same page can add
         * multiple "on" click events which submits the same form over
         * and over.
         * Remove the on click event with "off" to avoid multiple growl
         * and save events being run.
         *
         * @see http://api.jquery.com/off/
         */
        var submitButton = jQuery('#' + submitId);
        submitButton.off('click');
        submitButton.on('click', submitIdAjaxModalClickEvent);
    }
}

function submitIdAjaxModalClickEvent ()
{
    if (jQuery(this).hasClass('disabled')) {
        return;
    }
    var canContinue = true,
        btn = jQuery(this);
    btn.addClass('disabled');
    jQuery('#modalAjax .loader').show();
    if (ajaxModalSubmitEvents.length) {
        jQuery.each(ajaxModalSubmitEvents, function (index, value) {
            var fn = window[value];
            if (canContinue && typeof fn === 'function') {
                canContinue = fn();
            }
        });
    }
    if (!canContinue) {
        btn.removeClass('disabled');
        jQuery('#modalAjax .loader').hide();
        return;
    }
    var modalForm = jQuery('#modalAjax').find('form');
    var modalBody = jQuery('#modalAjax .modal-body');
    var modalErrorContainer = jQuery(modalBody).find('.admin-modal-error');

    jQuery(modalErrorContainer).slideUp();

    var modalPost = WHMCS.http.jqClient.post(
        modalForm.attr('action'),
        modalForm.serialize(),
        function(data) {
            if (modalForm.data('successDataTable')) {
                data.successDataTable = modalForm.data('successDataTable');
            }
            /**
             * When actions should occur before the ajax modal is updated
             * that do not fall into the standard actions.
             * Calling code (ie the function defined in fn) should validate
             * that the ajax modal being updated is the one that the code should
             * run for, as there is potential for multiple ajax modals on the
             * same page.
             */
            if (ajaxModalPostSubmitEvents.length) {
                jQuery.each(ajaxModalPostSubmitEvents, function (index, value) {
                    var fn = window[value];
                    if (typeof fn === 'function') {
                        fn(data, modalForm);
                    }
                });
            }
            updateAjaxModal(data);
        },
        'json'
    ).fail(function(xhr) {
        var data = xhr.responseJSON;
        var genericErrorMsg = 'An error occurred while communicating with the server. Please try again.';
        if (data && data.data) {
            data = data.data;
            if (data.errorMsg) {
                if (modalErrorContainer.length > 0) {
                    jQuery(modalErrorContainer)
                        .html(data.errorMsg)
                        .slideDown();
                } else {
                    jQuery.growl.warning({title: data.errorMsgTitle, message: data.errorMsg});
                }
            } else if (data.data.body) {
                jQuery(modalBody).html(data.body);
            } else {
                jQuery(modalBody).html(genericErrorMsg);
            }
        } else {
            jQuery(modalBody).html(genericErrorMsg);
        }
        jQuery('#modalAjax .loader').fadeOut();
    }).always(function () {
        btn.removeClass('disabled');
    });
}

function updateAjaxModal(data) {
    if (data.reloadPage) {
        if (typeof data.reloadPage === 'string') {
            window.location = data.reloadPage;
        } else {
            window.location.reload();
        }
        return;
    }
    if (data.successDataTable) {
        WHMCS.ui.dataTable.getTableById(data.successDataTable, undefined).ajax.reload();
    }
    if (data.redirect) {
        window.location = data.redirect;
    }
    if (data.successWindow && typeof window[data.successWindow] === "function") {
        window[data.successWindow]();
    }
    if (data.dismiss) {
        dialogClose();
    }
    if (data.successMsg) {
        jQuery.growl.notice({ title: data.successMsgTitle, message: data.successMsg });
    }
    if (data.errorMsg) {
        var inModalErrorContainer = jQuery('#modalAjax .modal-body .admin-modal-error');

        if (inModalErrorContainer.length > 0 && !data.dismiss) {
            jQuery(inModalErrorContainer)
                .html(data.errorMsg)
                .slideDown();
        } else {
            jQuery.growl.warning({title: data.errorMsgTitle, message: data.errorMsg});
        }
    }
    if (data.title) {
        jQuery('#modalAjax .modal-title').html(data.title);
    }
    if (data.body) {
        jQuery('#modalAjax .modal-body').html(data.body);
    } else {
        if (data.url) {
            WHMCS.http.jqClient.post(data.url, '', function(data2) {
                jQuery('#modalAjax').find('.modal-body').html(data2.body);
            }, 'json').fail(function() {
                jQuery('#modalAjax').find('.modal-body').html('An error occurred while communicating with the server. Please try again.');
                jQuery('#modalAjax').find('.loader').fadeOut();
            });
        }
    }
    if (data.submitlabel) {
        jQuery('#modalAjax .modal-submit').html(data.submitlabel).show();
        if (data.submitId) {
            jQuery('#modalAjax').find('.modal-submit').attr('id', data.submitId);
        }
    }

    if (data.submitId) {
        /**
         * Reloading ajax modal multiple times on the same page can add
         * multiple "on" click events which submits the same form over
         * and over.
         * Remove the on click event with "off" to avoid multiple growl
         * and save events being run.
         *
         * @see http://api.jquery.com/off/
         */
        var submitButton = jQuery('#' + data.submitId);
        submitButton.off('click');
        submitButton.on('click', submitIdAjaxModalClickEvent);
    }

    if (data.disableSubmit) {
        disableSubmit();
    } else {
        enableSubmit();
    }

    if (data.hideSubmit) {
        ajaxModalHideSubmit();
    }
}

// backwards compat for older dialog implementations

function dialogSubmit() {
    jQuery('#modalAjax .modal-submit').prop("disabled", true);
    jQuery('#modalAjax .loader').show();
    var postUrl = jQuery('#modalAjax').find('form').attr('action');
    WHMCS.http.jqClient.post(postUrl, jQuery('#modalAjax').find('form').serialize(),
        function(data) {
            updateAjaxModal(data);
        }, 'json').fail(function() {
            jQuery('#modalAjax .modal-body').html('An error occurred while communicating with the server. Please try again.');
            jQuery('#modalAjax .loader').fadeOut();
        });
}

function dialogClose() {
    jQuery('#modalAjax').modal('hide');
}

function addAjaxModalSubmitEvents(functionName) {
    if (functionName) {
        ajaxModalSubmitEvents.push(functionName);
    }
}

function removeAjaxModalSubmitEvents(functionName) {
    if (functionName) {
        var index = ajaxModalSubmitEvents.indexOf(functionName);
        if (index >= 0) {
            ajaxModalSubmitEvents.splice(index, 1);
        }
    }
}

function addAjaxModalPostSubmitEvents(functionName) {
    if (functionName) {
        ajaxModalPostSubmitEvents.push(functionName);
    }
}

function removeAjaxModalPostSubmitEvents(functionName) {
    if (functionName) {
        var index = ajaxModalPostSubmitEvents.indexOf(functionName);
        if (index >= 0) {
            ajaxModalPostSubmitEvents.splice(index, 1);
        }
    }
}

function disableSubmit()
{
    jQuery('#modalAjax .modal-submit').prop("disabled", true);
    jQuery('#modalAjax .loader').show();
}

function enableSubmit()
{
    jQuery('#modalAjax .loader').fadeOut();
    jQuery('#modalAjax .modal-submit').removeProp('disabled');
}

function ajaxModalHideSubmit()
{
    jQuery('#modalAjax .modal-submit').hide();
}
