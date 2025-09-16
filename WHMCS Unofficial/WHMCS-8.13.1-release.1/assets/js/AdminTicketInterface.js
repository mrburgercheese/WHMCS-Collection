$(document).ready(function(){
    $("#replymessage,#replynote").focus(function () {
        var gotValidResponse = false;
        WHMCS.http.jqClient.post("supporttickets.php", { action: "makingreply", id: ticketid, token: csrfToken },
        function(data){
            gotValidResponse = true;
            if (data.isReplying) {
                $("#replyingAdminMsg").html(data.replyingMsg);
                $("#replyingAdminMsg").removeClass('alert-warning').addClass('alert-info');
                if (!$("#replyingAdminMsg").is(":visible")) {
                    $("#replyingAdminMsg").hide().removeClass('hidden').slideDown();
                }
            } else {
                $("#replyingAdminMsg").slideUp();
            }
        }, "json")
        .always(function() {
            if (!gotValidResponse) {
                $("#replyingAdminMsg").html('Session Expired. Please <a href="javascript:location.reload()" class="alert-link">reload the page</a> before continuing.');
                $("#replyingAdminMsg").removeClass('alert-info').addClass('alert-warning');
                if (!$("#replyingAdminMsg").is(":visible")) {
                    $("#replyingAdminMsg").hide().removeClass('hidden').slideDown();
                }
            } else if ($("#replyingAdminMsg").hasClass('alert-warning')) {
                $("#replyingAdminMsg").slideUp();
            }
        });
        return false;
    });

    loadTicketCcs();

    $('#selectUserid').on('change', function() {
        loadTicketCcs();
    });

    $("#frmAddTicketReply").submit(function (e, options) {
        options = options || {};

        var formSubmitButton = $('#btnPostReply'),
            thisElement = jQuery(this),
            swapClass = 'fa-reply';

        formSubmitButton.attr("disabled", "disabled");
        formSubmitButton.find('i').removeClass(swapClass).addClass("fa-spinner fa-spin").end();

        if (options.skipValidation) {
            return true;
        }

        e.preventDefault();

        post_validate_changes_and_submit(
            thisElement,
            formSubmitButton,
            swapClass
        );
    });

    $('#frmTicketOptions').submit(function(e, options) {
        options = options || {};

        var formSubmitButton = $('#btnSaveChanges'),
            thisElement = $(this),
            swapClass = 'fa-save';

        formSubmitButton.attr('disabled', 'disabled');
        formSubmitButton.find('i').removeClass(swapClass).addClass('fa-spinner fa-spin').end();

        if (options.skipValidation) {
            return true;
        }

        e.preventDefault();

        post_validate_changes_and_submit(
            thisElement,
            formSubmitButton,
            swapClass
        );


    });

    $("#frmAddTicketNote").submit(function (e, options) {
        options = options || {};

        var formSubmitButton = $('#btnAddNote'),
            thisElement = $(this),
            swapClass = 'fa-reply';

        formSubmitButton.attr('disabled', 'disabled');
        formSubmitButton.find('i').removeClass(swapClass).addClass('fa-spinner fa-spin').end();

        if (options.skipValidation) {
            return true;
        }

        e.preventDefault();

        post_validate_changes_and_submit(
            thisElement,
            formSubmitButton,
            swapClass
        );
    });

    $(window).unload( function () {
        WHMCS.http.jqClient.post("supporttickets.php", { action: "endreply", id: ticketid, token: csrfToken });
    });
    $("#insertpredef, #btnInsertPredefinedReply").click(function () {
        $("#prerepliescontainer, #ticketPredefinedReplies").fadeToggle();
        return false;
    });
    /**
     * The following is in place for custom admin themes to facilitate migration.
     * Deprecated - will be removed in a future version
     */
    $("#addfileupload").click(function () {
        $("#fileuploads").append("<input type=\"file\" name=\"attachments[]\" class=\"form-control top-margin-5\">");
        return false;
    });
    $('.add-file-upload').click(function () {
        var moreId = $(this).data('more-id');
        $('#' + moreId).append("<input type=\"file\" name=\"attachments[]\" class=\"form-control top-margin-5\">");
        return false;
    });
    $('#btnAttachFiles').click(function () {
        $('#ticketReplyAttachments').fadeToggle();
    });
    $('#btnNoteAttachFiles').click(function () {
        $('#ticketNoteAttachments').fadeToggle();
    });
    $('#btnAddBillingEntry').click(function (e) {
        e.preventDefault();
        $('#ticketReplyBillingEntry').fadeToggle();
    });
    $('#btnInsertKbArticle').click(function (e) {
        e.preventDefault();
        window.open('supportticketskbarticle.php','kbartwnd','width=500,height=400,scrollbars=yes');
    });
    $("#ticketstatus").change(function (e, options) {
        var currentStatus = $('#currentStatus'),
            skip = 0;

        options = options || {};

        if (options.skipValidation) {
            skip = 1;
        }

        post_validate_and_change(
            {
                action: "changestatus",
                id: ticketid,
                status: this.options[this.selectedIndex].text,
                currentStatus: currentStatus.val(),
                lastReplyId: $('#lastReplyId').val(),
                currentSubject: $('#currentSubject').val(),
                currentCc: $('#currentCc').val(),
                currentUserId: $('#currentUserId').val(),
                currentDepartmentId: $('#currentdeptid').val(),
                currentFlag: $('#currentflagto').val(),
                currentPriority: $('#currentpriority').val(),
                skip: skip,
                token: csrfToken
            },
            currentStatus,
            this.options[this.selectedIndex].text,
            $(this)
        );
    });
    $("#predefq").keypress(function(e){
        // Stop form submit
        if(e.which === 13){
            return false;
        }
    });
    $("#predefq").keyup(function () {
        var intellisearchlength = $("#predefq").val().length;
        if (intellisearchlength>2) {
        WHMCS.http.jqClient.post("supporttickets.php", { action: "loadpredefinedreplies", predefq: $("#predefq").val(), token: csrfToken },
            function(data){
                $("#prerepliescontent").html(data);
            });
        }
    });

    jQuery("#watch-ticket").click(function() {
        var ticketId = jQuery(this).data('ticket-id'),
            adminId = jQuery(this).data('admin-id'),
            adminFullName = jQuery(this).data('admin-full-name'),
            type = jQuery(this).attr('data-type');

        WHMCS.http.jqClient.post(
            'supporttickets.php', {
                action: 'watcher_update',
                ticket_id: ticketId,
                type: type,
                token: csrfToken
            },
            function (data) {
                var self = jQuery("#watch-ticket");
                var adminElementId = 'ticket-watcher-' + adminId;
                var $ticketWatcher = jQuery('#' + adminElementId);

                if (data == 1 && type == 'watch') {
                    jQuery(self).attr('data-type', 'unwatch');
                    jQuery(self).addClass('btn-danger').removeClass('btn-info');
                    jQuery(self).html(unwatch_ticket);

                    // Hide the 'None' watcher.
                    jQuery('#ticket-watcher-0').hide();

                    if ($ticketWatcher.length > 0) {
                        $ticketWatcher.show();
                    } else {
                        jQuery('#ticketWatchers').append(
                            jQuery('<li>')
                                .attr('id', adminElementId)
                                .text(adminFullName)
                        );
                    }
                }
                if (data == 1 && type == 'unwatch') {
                    jQuery(self).attr('data-type', 'watch');
                    jQuery(self).addClass('btn-info').removeClass('btn-danger');
                    jQuery(self).html(watch_ticket);

                    $ticketWatcher.hide();

                    // Remove any empty list items.
                    jQuery('#ticketWatchers li:empty').remove();

                    // Display 'None' is nothing is visible under Ticket Watchers.
                    if (jQuery("#ticketWatchers").children(":visible").length === 0) {
                        jQuery('#ticket-watcher-0').removeClass('hidden')
                            .show();
                    }
                }
            }
        );
    });


    jQuery(".sidebar-ticket-ajax").on('change', function(e, options) {
        var self = $(this),
            val = self.data('update-type'),
            currentValue = $('#current' + val),
            skip = 0;

        options = options || {};

        if (options.skipValidation) {
            skip = 1;
        }

        post_validate_and_change(
            {
                action: "viewticket",
                id: ticketid,
                updateticket: val,
                value: self.val(),
                currentValue: currentValue.val(),
                lastReplyId: $('#lastReplyId').val(),
                currentSubject: $('#currentSubject').val(),
                currentCc: $('#currentCc').val(),
                currentUserId: $('#currentUserId').val(),
                currentDepartmentId: $('#currentdeptid').val(),
                currentFlag: $('#currentflagto').val(),
                currentPriority: $('#currentpriority').val(),
                currentStatus: $('#currentStatus').val(),
                skip: skip,
                token: csrfToken
            },
            currentValue,
            self.val(),
            self
        );
    });

    jQuery('#btnSelectRelatedService').on('click', function() {
        var expandable = jQuery(this).data('expandable');
        jQuery(this).addClass('disabled').prop('disabled', true);
        expandRelServices(function() {
            jQuery('#relatedservicestbl').find('.related-service').removeClass('hidden');
            jQuery('#btnSelectRelatedService').hide();
            jQuery('#btnSelectRelatedServiceSave').removeClass('hidden').show().removeClass('disabled').prop('disabled', false);
            jQuery('#btnSelectRelatedServiceCancel').removeClass('hidden').show().removeClass('disabled').prop('disabled', false);
        });
    });

    jQuery('#btnRelatedServiceExpand').on('click', function() {
        if (jQuery(this).prop('disabled')) {
            return;
        }
        expandRelServices();
    });

    jQuery('#btnSelectRelatedServiceSave').on('click', function() {
        var table = jQuery('#relatedservicestbl'),
            selectedService = table.find('input[name="related_service[]"]:checked'),
            type = null,
            id = 0;

        if (selectedService.length === 0) {
            jQuery.growl.warning(
                {
                    title: '',
                    message: 'You must select a service'
                }
            );
            return false;
        }

        type = selectedService.data('type');
        id = selectedService.val();

        jQuery(this).prop('disabled', true).addClass('disabled');
        jQuery('#btnSelectRelatedServiceCancel').prop('disabled', true).addClass('disabled');

        let saveRequestedService = () => {
            let dfd = jQuery.Deferred();

            WHMCS.http.jqClient.jsonPost(
                {
                    url: WHMCS.adminUtils.getAdminRouteUrl(
                        `/support/ticket/${ticketid}/client/${userid}/services/save`
                    ),
                    data: {
                        token: csrfToken,
                        type: type,
                        id: id
                    },
                    success: function (data) {
                        if (data.success) {
                            dfd.resolve(data);
                        } else {
                            dfd.fail(data);
                        }
                    }
                }
            );

            return dfd.promise();
        }

        let getDisplayServices = () => {
            let dfd = jQuery.Deferred();

            WHMCS.http.jqClient.jsonPost(
                {
                    url: WHMCS.adminUtils.getAdminRouteUrl(
                        `/support/ticket/${ticketid}/client/${userid}/services`
                    ),
                    data: {
                        token: csrfToken,
                        type: type,
                        skipTen: false,
                        showTen: true
                    },
                    success: function (data) {
                        dfd.resolve(data);
                    }
                }
            );

            return dfd.promise();
        }

        jQuery.when(
            saveRequestedService()
        ).then(
            data => {
                jQuery.growl.notice({title: '', message: data.successMessage});

                let tableRow = selectedService.closest('tr');
                table.find('.rowhighlight').removeClass('rowhighlight');
                table.find('th').closest('tr').after(tableRow);
                tableRow.attr('data-original', 'true').addClass('rowhighlight');

                return getDisplayServices();
            },
            data => {
                jQuery.growl.warning({title: '', message: data.errorMessage});
            }
        ).then(
            data => {
                table.find('.related-service').addClass('hidden');
                table.find('tr')
                    .splice(2)
                    .forEach(row => row.remove());

                jQuery('#btnSelectRelatedServiceSave').hide();
                jQuery('#btnSelectRelatedServiceCancel').hide();
                jQuery('#btnSelectRelatedService').prop('disabled', false).show()
                    .removeClass('disabled hidden');
                jQuery('#btnRelatedServiceExpand').prop('disabled', false).removeClass('disabled');

                table.find('tbody').append(data.body);
            }
        );
    });

    jQuery('#btnSelectRelatedServiceCancel').on('click', function() {
        var table = jQuery('#relatedservicestbl');
        table.find('.related-service').addClass('hidden');
        jQuery(this).hide();
        jQuery('#btnSelectRelatedServiceSave').hide().addClass('hidden');
        jQuery('#btnSelectRelatedService').show().prop('disabled', false).removeClass('disabled');;
        if (!jQuery('#btnRelatedServiceExpand').hasClass('disabled')) {
            table.find('tr[data-original!="true"]').remove();
            jQuery('#btnRelatedServiceExpand').prop('disabled', false).removeClass('disabled');
        }
    });

    jQuery(document).on('click', '#relatedservicestbl tr', function() {
        if(!jQuery('#relatedservicestbl .related-service').hasClass('hidden')) {
            jQuery(this).find('input').prop('checked', true);
        }
    });

    jQuery(document).on('click', '#relatedservicestbl tr a', function(e) {
        e.stopPropagation();
    });

    jQuery(document).on('click', '.btn-scheduled-actions-manage', function(e) {
        let delay = 0;
        let controlButtons = ['discard', 'save'];

        e.preventDefault();
        scheduledActionsUI.setTargetDiv(this);
        if (scheduledActionsUI.isAddReplyTab(this)) {
            controlButtons = ['discard'];
            jQuery('#ticketReplyScheduledActions').fadeToggle();
        }
        if (scheduledActionsUI.getPanelModeAttr() === 'create') {
            scheduledActionsUI.hideScheduledActionManagementPanel()
                .deselectToggleManageButton()
                .resetPanel();
        } else {
            switch (scheduledActionsUI.getPanelModeAttr()) {
                case 'view':
                    scheduledActionsUI.hideScheduledActionManagementPanel();
                    delay = 600;
                    break;
            }
            setTimeout(function () {
                scheduledActionsUI.resetPanel()
                    .discardUnsavedActions()
                    .setPanelModeAttr('create')
                    .showPanelTitle('generic')
                    .showControlButtons(controlButtons)
                    .showAddActionElements()
                    .selectToggleManageButton()
                    .enableInputs()
                    .showScheduledActionManagementPanel();
            }, delay);
        }
    });
    jQuery(document).on('click', '.btn-scheduled-action-add', function(e) {
        let selectedAction = scheduledActionsUI.setTargetDiv(this)
            .getManagementPanel()
            .find('.select-scheduled-actions-action-type *:selected');
        let actionType = selectedAction.val();
        let actionText = selectedAction.text();
        const customFieldOptionValue = 'divCustomFieldValue';
        e.preventDefault();
        scheduledActionsUI.addUnsavedActionRow(actionType, actionText);

        if (actionType !== customFieldOptionValue ) {
            scheduledActionsUI.removeActionOption(actionType)
                .updateAddActionDisplay();
        }
    });
    jQuery(document).on('click', '.btn-scheduled-action-cancel', function(e) {
        let actionRow = jQuery(this).closest('.container-item');

        e.preventDefault();
        scheduledActionsUI
            .setTargetDiv(this)
            .removeUnsavedActionRow(actionRow)
            .addActionOption(
                actionRow.attr('data-value'),
                actionRow.find('.container-scheduled-action-text').text(),
                actionRow.attr('data-order')
            )
            .updateAddActionDisplay();
    });
    jQuery(document).on('click', '.btn-scheduled-actions-discard', function(e) {
        e.preventDefault();
        scheduledActionsUI.setTargetDiv(this)
            .enableDiscardModal('discard')
            .show();
    });
    jQuery(document).on('click', '.btn-scheduled-actions-discard-modal-continue', function (e) {
        let triggerElement = jQuery(this);
        let modalInitiator = scheduledActionsUI.modalInitiator;
        let modalActionId = scheduledActionsUI.modalActionId;

        e.preventDefault();
        scheduledActionsUI.setTargetDiv(this)
            .enableDiscardModal('discard')
            .hide();
        if (scheduledActionsUI.isAddReplyTab(triggerElement)) {
            jQuery('#ticketReplyScheduledActions').fadeToggle();
        }
        scheduledActionsUI.hideScheduledActionManagementPanel()
            .deselectToggleManageButton();
        setTimeout(function () {
            switch (modalInitiator) {
                case 'discard':
                    scheduledActionsUI.setPanelModeAttr('')
                        .discardUnsavedActions();
                    break;
                case 'view':
                    scheduledActionsUI.populateViewPanel(modalActionId);
                    break;
            }
        }, 600);
        scheduledActionsUI.setPanelModeAttr('')
            .resetModal();
    });
    jQuery(document).on('click', '.btn-scheduled-actions-cancel-modal-continue', function (e) {
        e.preventDefault();
        scheduledActionsUI.activeModal.hide();
        WHMCS.http.jqClient.jsonPost({
            url:  WHMCS.adminUtils.getAdminRouteUrl(
                `/support/ticket/${ticketid}/actions/${scheduledActionsUI.modalActionId}/cancel`
            ),
            data: {
                token: csrfToken,
            },
            success: function(data, jqXHR) {
                refreshScheduledActionList();
                setScheduledActionTabCount(data.upcomingCount);
                scheduledActionsUI.setPanelId('')
                    .setPanelModeAttr('')
                    .hideScheduledActionManagementPanel();
                jQuery.growl.notice({message: data.resultMessage ?? ''});
            },
            error: function (errorText, jsonResponse, jqXHR) {
                jQuery.growl.error({message: errorText ?? ''});
            },
            warning: function (warningText, jsonResponse, jqXHR) {
                jQuery.growl.warning({message: warningText ?? ''});
            },
            fail: function(jqResponseType, jsonResponse, jqXHR) {
                let msg = (jsonResponse.error ?? null)
                    ?? (jsonResponse.errorMessage ?? null);
                jQuery.growl.error({message: msg ?? ''});
            }
        });
        scheduledActionsUI.resetModal();
    });
    jQuery(document).on('click', '.btn-scheduled-actions-save', function(e) {
        let triggerElement = jQuery(this);
        let actionId = jQuery(e.target).data('actionid') ?? -1;
        let postUrl = WHMCS.adminUtils.getAdminRouteUrl('/support/ticket/' + ticketid + '/actions/create');
        if (actionId > 0) {
            postUrl = WHMCS.adminUtils.getAdminRouteUrl('/support/ticket/' + ticketid + '/actions/' + actionId + '/update');
        }

        e.preventDefault();
        WHMCS.http.jqClient.jsonPost({
            url:  postUrl,
            data: jQuery(this).closest('form').serialize(),
            success: function(data) {
                let results = {
                    title: '',
                    message: data.resultMessage,
                };
                if (data.result === 'success') {
                    refreshScheduledActionList();
                    setScheduledActionTabCount(data.upcomingCount);
                    scheduledActionsUI.hideScheduledActionManagementPanel();
                    setTimeout(function () {
                        scheduledActionsUI
                            .setTargetDiv(triggerElement)
                            .setPanelModeAttr('')
                            .discardUnsavedActions()
                            .deselectToggleManageButton()
                            .resetPanel();
                    }, 600);
                    jQuery.growl.notice(results);
                } else if (data.result === 'error') {
                    jQuery.growl.warning(results);
                }
            },
            error: function (errorText) {
                jQuery.growl.error({message: errorText ?? ''});
            },
            warning: function (warningText) {
                jQuery.growl.warning({message: warningText ?? ''});
            },
            fail: function(jqResponseType, jsonResponse) {
                let msg = (jsonResponse.error ?? null)
                    ?? (jsonResponse.errorMessage ?? null);
                jQuery.growl.error({message: msg ?? ''});
            }
        });
    });
    jQuery(document).on('click', '#scheduledActionsList a', function(e) {
        let actionId = jQuery(this).attr('data-action-id');

        e.preventDefault();
        scheduledActionsUI.setTargetDiv(this);
        if (scheduledActionsUI.getPanelModeAttr() === 'create') {
            scheduledActionsUI.enableDiscardModal('view', actionId)
                .show();
        } else if (actionId !== scheduledActionsUI.panelId) {
            scheduledActionsUI.listSelect(actionId);
            scheduledActionsUI.populateViewPanel(actionId);
        }
    });
    jQuery(document).on('click', '.btn-scheduled-actions-close', function(e) {
        e.preventDefault();
        scheduledActionsUI
            .setTargetDiv(this)
            .setPanelId('')
            .setPanelModeAttr('')
            .hideScheduledActionManagementPanel();
    });
    jQuery(document).on('click', '.btn-scheduled-actions-cancel', function(e) {
        e.preventDefault();
        let actionId = jQuery(e.target).data('actionid') ?? -1;
        if (actionId < 1) {
            return;
        }
        scheduledActionsUI.setTargetDiv(this)
            .enableCancelModal('cancel', actionId)
            .show();
    });
    jQuery(document).on('change', '.select-scheduled-actions-when-to-action', function() {
        scheduledActionsUI.updateTimeElements(jQuery(this).val());
    });
});

var replyingAdminMessage = $("#replyingAdminMsg");

function doDeleteReply(id) {
    if (confirm(langdelreplysure)) {
        window.location='supporttickets.php?action=viewticket&id='+ticketid+'&sub=del&idsd='+id+'&token='+csrfToken;
    }
}
function doDeleteTicket() {
    if (confirm(langdelticketsure)) {
        window.location='supporttickets.php?sub=deleteticket&id='+ticketid+'&token='+csrfToken;
    }
}
function doDeleteNote(id) {
    if (confirm(langdelnotesure)) {
        window.location='supporttickets.php?action=viewticket&id='+ticketid+'&sub=delnote&idsd='+id+'&token='+csrfToken;
    }
}
function loadTab(target,type,offset) {
    WHMCS.http.jqClient.post("supporttickets.php", { action: "get" + type, id: ticketid, userid: userid, target: target, offset: offset, token: csrfToken },
    function (data) {
        if ($("#tab" + target + "box #tab_content").length > 0) {
            $("#tab" + target + "box #tab_content").html(data);
        } else {
            $("#tab" + target).html(data);
        }
    });
    WHMCS.ui.markdownEditor.register();
}
function expandRelServices(completeFunction) {
    var button = jQuery('#btnRelatedServiceExpand');
    if (button.hasClass('disabled')) {
        if (completeFunction instanceof Function) {
            completeFunction();
        }
        return;
    }

    button.addClass('disabled').prop('disabled', true).find('span').toggleClass('hidden');
    WHMCS.http.jqClient.jsonPost(
        {
            url: WHMCS.adminUtils.getAdminRouteUrl('/support/ticket/' + ticketid + '/client/' + userid + '/services'),
            data: {
                token: csrfToken
            },
            success: function(data) {
                jQuery('#relatedservicestbl').find('tbody').append(data.body);
            },
            always: function() {
                button.find('span').toggleClass('hidden');
                if (completeFunction instanceof Function) {
                    completeFunction();
                }
            }
        }
    );
}

function editTicket(id) {
    $(".editbtns"+id+" input[type=button]").prop('disabled', true);
    $(".editbtns"+id+" img.saveSpinner").show();
    WHMCS.http.jqClient.post("supporttickets.php", { action: "getmsg", ref: id, token: csrfToken })
        .done(function(data){
            $(".editbtns"+id).toggle();
            $("#content"+id+" div.message").hide();
            $("#content"+id+" div.message").after('<textarea rows="15" style="width:99%" id="ticketedit'+id+'">'+langloading+'</textarea>');
            $("#ticketedit"+id).val(data);
        })
        .always(function(){
            $(".editbtns"+id+" img.saveSpinner").hide();
            $(".editbtns"+id+" input[type=button]").removeProp('disabled');
        });
}
function editTicketCancel(id) {
    $("#ticketedit"+id).hide();
    $("#content"+id+" div.message").show();
    $(".editbtns"+id+" input[type=button]").prop('disabled', false);
    $(".editbtns"+id).toggle();
}
function editTicketSave(id) {
    $(".editbtns"+id+" input[type=button]").prop('disabled', true);
    $("#ticketedit"+id).prop('disabled', true);
    $(".editbtns"+id+" img.saveSpinner").show();
    WHMCS.http.jqClient.post("supporttickets.php", { action: "updatereply", ref: id, text: $("#ticketedit"+id).val(), token: csrfToken })
        .done(function(data){
            $("#content"+id+" div.message").html(data);
        })
        .always(function(){
            $(".editbtns"+id+" img.saveSpinner").hide();
            editTicketCancel(id);
        });
}
function quoteTicket(id,ids) {
    $(".tab").removeClass("tabselected");
    $("#tab0").addClass("tabselected");
    $(".tabbox").hide();
    $("#tab0box").show();
    WHMCS.http.jqClient.post("supporttickets.php", { action: "getquotedtext", id: id, ids: ids, token: csrfToken },
    function(data){
        $("#replymessage").val(data+"\n\n"+$("#replymessage").val());
    });
    return false;
}
function selectpredefcat(catid) {
    WHMCS.http.jqClient.post("supporttickets.php", { action: "loadpredefinedreplies", cat: catid, token: csrfToken },
    function(data){
        $("#prerepliescontent").html(data);
    });
}
function selectpredefreply(artid) {
    WHMCS.http.jqClient.post("supporttickets.php", { action: "getpredefinedreply", id: artid, token: csrfToken },
    function(data){
        $("#replymessage").addToReply(data);
    });
    $("#prerepliescontainer, #ticketPredefinedReplies").fadeOut();
}

function post_validate_and_change(vars, updateElement, newValue, self)
{
    var gotValidResponse = false,
        responseMsg = '',
        done = false;
    WHMCS.http.jqClient.post(
        "supporttickets.php",
        vars,
        function(data){
            gotValidResponse = true;
            if (typeof data.changes !== 'undefined') {
                if (data.changes === true) {
                    // there have been changes
                    swal({
                            title: changesTitle,
                            text: changes + "\r\n\r\n" + data.changeList,
                            icon: 'info',
                            dangerMode: true,
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: continueText
                        },
                        function(){
                            replyingAdminMessage.slideUp();
                            self.trigger('change', { 'skipValidation': true });
                        }
                    )
                } else {
                    done = true;
                    updateElement.val(newValue);
                    jQuery('#frmTicketOptions').find('[name=' + self.data('update-type') + ']').val(newValue);
                    jQuery.growl.notice({ title: "", message: "Saved successfully!" });
                }
            } else {
                // access denied
                responseMsg = 'Access Denied. Please try again.';
            }
        },
        "json"
    )
    .always(function()
        {
            if (!gotValidResponse) {
                responseMsg = 'Session Expired. Please <a href="javascript:location.reload()" class="alert-link">reload the page</a> before continuing.';
            }

            if (responseMsg) {
                replyingAdminMessage.html(responseMsg);
                replyingAdminMessage.removeClass('alert-info').addClass('alert-warning');
                if (!replyingAdminMessage.is(":visible")) {
                    $("#replyingAdminMsg").hide().removeClass('hidden').slideDown();
                }
                $('html, body').animate({
                    scrollTop: replyingAdminMessage.offset().top - 15
                }, 400);
            } else {
                replyingAdminMessage.slideUp();
            }
        }
    );
    return done;
}

function post_validate_changes_and_submit(form, submitButton, swapClass)
{
    var gotValidResponse = false,
        allowPost = false,
        responseMsg = '';

    replyingAdminMessage = $("#replyingAdminMsg");

    WHMCS.http.jqClient.post(
        'supporttickets.php',
        {
            action: 'validatereply',
            id: ticketid,
            status: $("#ticketstatus").val(),
            lastReplyId: $('#lastReplyId').val(),
            currentSubject: $('#currentSubject').val(),
            currentCc: $('#currentCc').val(),
            currentUserId: $('#currentUserId').val(),
            currentDepartmentId: $('#currentdeptid').val(),
            currentFlag: $('#currentflagto').val(),
            currentPriority: $('#currentpriority').val(),
            currentStatus: $('#currentStatus').val(),
            token: csrfToken
        },
        function(data){
            gotValidResponse = true;
            if (data.valid) {
                if (data.changes) {
                    // there have been ticket changes
                    allowPost = false;
                    swal({
                        title: changesTitle,
                        text: changes + "\r\n\r\n" + data.changeList,
                        icon: 'info',
                        dangerMode: true,
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: continueText
                    },
                        function(){
                            replyingAdminMessage.slideUp();
                            form.attr('data-no-clear', 'false');
                            form.trigger('submit', { 'skipValidation': true });
                        }
                    )
                } else {
                    allowPost = true;
                }
            } else {
                // access denied
                responseMsg = 'Access Denied. Please try again.';
            }
        }, "json")
    .always(function() {
        if (!gotValidResponse) {
            responseMsg = 'Session Expired. Please <a href="javascript:location.reload()" class="alert-link">reload the page</a> before continuing.';
        }

        if (responseMsg) {
            allowPost = false;
            replyingAdminMessage.html(responseMsg);
            replyingAdminMessage.removeClass('alert-info').addClass('alert-warning');
            if (!replyingAdminMessage.is(':visible')) {
                $("#replyingAdminMsg").hide().removeClass('hidden').slideDown();
            }
            $('html, body').animate({
                scrollTop: replyingAdminMessage.offset().top - 15
            }, 400);
        }

        if (allowPost) {
            replyingAdminMessage.slideUp();
            form.attr('data-no-clear', 'false');
            form.trigger('submit', { 'skipValidation': true });
        } else {
            submitButton.removeAttr('disabled');
            submitButton.find('i').removeClass('fa-spinner fa-spin').addClass(swapClass).end();
        }
    });
}

function loadTicketCcs()
{
    var userId = jQuery('#selectUserid').val(),
        currentCcs = jQuery('#inputTicketCc').val().split(',');
    if (!userId) {
        userId = 0;
    }
    WHMCS.http.jqClient.jsonPost(
        {
            url: WHMCS.adminUtils.getAdminRouteUrl(
                '/support/ticket/open/client/' + userId + '/additional/data'
            ),
            data: {
                token: csrfToken,
                showTen: true
            },
            success: function(data) {
                var ccs = jQuery(".selectize-ticketCc")[0].selectize;
                if (typeof ccs !== 'undefined') {
                    ccs.clearOptions();
                    if (data.ccs.length) {
                        var i, n, ccIndex;
                        ccs.addOption(data.ccs);
                        for (i = 0, n = data.ccs.length; i < n; i++) {
                            var ccData = data.ccs[i];
                            ccIndex = currentCcs.findIndex(function(checkValue){
                                return checkValue === ccData.text;
                            });
                            if (ccIndex !== -1) {
                                ccs.addItem(ccData.text, true);
                                currentCcs.splice(ccIndex, 1);
                            }
                        }
                    }
                    if (currentCcs.length) {
                        currentCcs.forEach(function (value) {
                            if (value) {
                                ccs.addOption(
                                    {
                                        name: value,
                                        text: value
                                    }
                                );
                            }
                        })
                        ccs.addItems(currentCcs, true);
                    }
                }
            }
        }
    );
}

const scheduledActionsUI = {
    panelId: '',
    modalInitiator: '',
    modalActionId: '',
    targetDiv: '',
    activeRow: null,
    resetPanel: function () {
        this.setPanelModeAttr('')
            .setPanelId('');
        this.getManagementPanel()
            .find('.visible')
            .removeClass('visible');
        return this;
    },
    resetScheduledActions: function () {
        this.clearLocalStorage()
            .getManagementPanel()
            .find('.container-created-actions .container-item')
            .not('.container-heading, .container-add-action')
            .each(function() {
                let actionRow = jQuery(this);
                let actionType = actionRow.attr('data-value');
                let actionOrder = actionRow.attr('data-order');
                let actionString = actionRow.find('.container-scheduled-action-text').text();

                scheduledActionsUI.removeUnsavedActionRow(actionRow)
                    .addActionOption(actionType, actionString, actionOrder);
            });
        return this;
    },
    resetTimeElements: function () {
        let timeSelect = this.getManagementPanel()
            .find('.select-scheduled-actions-when-to-action');

        timeSelect.val(
            timeSelect.find('option')
                .first()
                .val()
        ).change();
        this.getManagementPanel()
            .find('.container-delay-inputs input')
            .val('0');
        this.getManagementPanel()
            .find('.container-exact-date-time input')
            .val('');
        return this;
    },
    showScheduledActionManagementPanel: function () {
        this.getManagementPanel()
            .not(':visible')
            .fadeIn();
        return this;
    },
    showPanelTitle: function (titleType) {
        this.getManagementPanel()
            .find('.panel-title-area > .panel-title-' + titleType)
            .addClass('visible');
        return this;
    },
    selectorControlButton: function (buttonType) {
        return '.panel-control-area > .btn-scheduled-actions-' + buttonType;
    },
    showControlButton: function (buttonType) {
        jQuery(this.selectorControlButton(buttonType)).addClass('visible');
        return this;
    },
    showControlButtons: function (buttonTypes) {
        buttonTypes.forEach(function (buttonType) {
            buttonType = new String(buttonType);
            let buttonHandler = 'showControlButton'
                + buttonType.charAt(0).toUpperCase()
                + buttonType.slice(1);
            if (this.hasOwnProperty(buttonHandler)) {
                this[buttonHandler]();
            }
            this.showControlButton(buttonType.valueOf());
        }, this);
        return this;
    },
    showControlButtonCancel: function () {
        jQuery(this.selectorControlButton('cancel'))
            .data('ticketid', ticketid)
            .data('actionid', this.panelId);
        return this;
    },
    showControlButtonSave: function () {
        jQuery(this.selectorControlButton('save'))
            .data('ticketid', ticketid)
            .data('actionid', this.panelId);
    },
    showAddActionElements: function () {
        this.getManagementPanel()
            .find('.container-add-action')
            .addClass('visible');
        return this;
    },
    showTimeElements: function (element) {
        element.show()
            .find('input')
            .removeAttr('disabled');
        return this;
    },
    hideScheduledActionManagementPanel: function () {
        this.getManagementPanel()
            .fadeOut()
            .removeClass('visible');
        return this;
    },
    hideAddActionElements: function () {
        this.getManagementPanel()
            .find('.container-add-action')
            .removeClass('visible');
        return this;
    },
    hideTimeElements: function (element) {
        element.hide()
            .find('input')
            .attr('disabled', 'disabled');
        return this;
    },
    hideCancelButton: function () {
        this.getManagementPanel()
            .find('.container-created-actions .btn-scheduled-action-cancel')
            .hide();
        return this;
    },
    updateAddActionDisplay: function () {
        let dropdownOptions = this.getManagementPanel()
            .find('.select-scheduled-actions-action-type option');

        if (dropdownOptions.length <= 0) {
            this.hideAddActionElements();
        } else {
            this.showAddActionElements();
        }
        return this;
    },
    updateTimeElements: function (inputType) {
        let containerTimeFromNow = this.getManagementPanel()
            .find('.container-delay-inputs');
        let containerExactDateTime = this.getManagementPanel()
            .find('.container-exact-date-time');

        if (inputType === 'delay') {
            this.hideTimeElements(containerExactDateTime)
                .showTimeElements(containerTimeFromNow);
        } else {
            this.hideTimeElements(containerTimeFromNow)
                .showTimeElements(containerExactDateTime);
        }
        return this;
    },
    performRegistrationsForClone: function (cloned) {
        let clonedWithMDE = cloned.find('.container-markdown-editor');
        if (clonedWithMDE.length > 0) {
            WHMCS.adminUtils.ensureElementHasId(clonedWithMDE);
            WHMCS.ui.markdownEditor.register();
        }
        return this;
    },
    clearLocalStorage: function () {
        console.log('clearing local storage');
        jQuery('.container-scheduled-action')
        .find('.local-storage')
        .each(function (i, el) {
            WHMCS.adminUtils.clearLocalStorage($(el));
        });
        return this;
    },
    addUnsavedActionRow: function (actionType, actionText) {
        let containerAddAction = this.getManagementPanel()
            .find('.container-add-action');
        let cloneableRow = this.targetDiv.find('.container-item.cloneable.' + actionType);
        let clonedRow;

        clonedRow = cloneableRow.clone()
            .removeClass('cloneable');
        clonedRow.find('.container-scheduled-action-text')
            .text(actionText);
        clonedRow.find('*[disabled]')
            .removeAttr('disabled');

        let otherUnsavedActionRows = containerAddAction.parent().find('.container-item.container-scheduled-action');
        if (otherUnsavedActionRows.length === 0) {
            containerAddAction.before(clonedRow);
            this.performRegistrationsForClone(clonedRow);
            return clonedRow;
        }

        let firstLowerOrder = otherUnsavedActionRows.filter(function () {
            return $(this).attr('data-order') > clonedRow.attr('data-order');
        });

        if (firstLowerOrder.length > 0) {
            clonedRow.insertBefore(firstLowerOrder.first());
        } else {
            containerAddAction.before(clonedRow);
        }
        this.performRegistrationsForClone(clonedRow);
        return clonedRow;
    },
    addActionOption: function (actionType, actionText, actionOrder) {
        let actionSelect = this.getManagementPanel()
            .find('.select-scheduled-actions-action-type');

        if (actionSelect.find('option[value="' + actionType + '"]').length <= 0) {
            let newEl = jQuery('<option>').attr('value', actionType)
                .attr('data-order', actionOrder)
                .text(actionText);

            let firstLowerOrder = actionSelect.find('option').filter(function () {
                return $(this).attr('data-order') > actionOrder;
            }).first();

            if (firstLowerOrder.length > 0) {
                newEl.insertBefore(firstLowerOrder);
                actionSelect.children('option').first().prop('selected', true);
            } else {
                actionSelect.append(newEl);
            }
        }
        return this;
    },
    removeUnsavedActionRow: function (actionRow) {
        actionRow.remove();
        return this;
    },
    removeActionOption: function (actionType) {
        this.getManagementPanel()
            .find('.select-scheduled-actions-action-type option[value="' + actionType + '"]')
            .remove();
        return this;
    },
    discardUnsavedActions: function () {
        this.resetScheduledActions()
            .resetTimeElements()
            .updateAddActionDisplay()
            .resetPanel();
        return this;
    },
    disableInputs: function () {
        this.disableCreatedActionsInputs()
            .disableTimeSelectionInputs();
        return this;
    },
    disableCreatedActionsInputs: function () {
        this.getManagementPanel()
            .find('.container-created-actions')
            .find('select, input, textarea')
            .attr('disabled', 'disabled');
        return this;
    },
    disableTimeSelectionInputs: function () {
        this.getManagementPanel()
            .find('.container-time-selection')
            .find('select, input, textarea')
            .attr('disabled', 'disabled');
        return this;
    },
    enableInputs: function () {
        this.getManagementPanel()
            .find('.select-scheduled-actions-action-type, .select-scheduled-actions-when-to-action')
            .removeAttr('disabled');
        return this;
    },
    selectToggleManageButton: function () {
        this.targetDiv.find('.btn-scheduled-actions-manage')
            .addClass('btn-scheduled-actions-primary');
        return this;
    },
    deselectToggleManageButton: function () {
        this.targetDiv.find('.btn-scheduled-actions-manage')
            .removeClass('btn-scheduled-actions-primary');
        return this;
    },
    applyInputParameters: function ($actionRow, actionName, actionSkip, actionParameters) {
        if ('customField' in actionParameters && typeof actionParameters.customField === 'object' && actionParameters.customField !== null) {
            this.applyCustomFields($actionRow, actionName, actionParameters.customField, actionSkip);
        } else {
            Object.keys(actionParameters).forEach(function (key) {
                let input = $actionRow.find('[name="parameters[' + actionName + '][' + key + ']"]');
                switch (input.prop('tagName').toLowerCase()) {
                    case 'select':
                        input.find('option').prop('selected', false);
                        input.find('option[value="' + actionParameters[key] + '"]').prop('selected', true);
                        break;
                    case 'textarea':
                        input.html(actionParameters[key]);
                }
            });
        }

        let input = $actionRow.find('[name="skip[' + actionName + ']"]');
        input.find('option[value="' + actionSkip + '"]').prop('selected', true);
        return this;
    },
    applyCustomFields: function ($actionRow, actionName, customFields, actionSkip) {
        Object.entries(customFields).forEach(([fieldId, fieldValue]) => {
            if (fieldValue === null) return;

            const selectElement = $actionRow
                .closest('.container-scheduled-action:not(.cloneable)')
                .find(`select[name="parameters[${actionName}][customField]"]`);

            if (!selectElement.length) return;

            selectElement.val(fieldId).change();

            const selectedOption = selectElement.find(`option[value="${fieldId}"]`);
            const fieldType = selectedOption.attr("data-type");
            const fieldOptions = selectedOption.attr("data-options");

            if (!fieldType) return;

            const container = $actionRow.find('.field-container');
            if (!container.length) return;

            container.find(".field-block").attr("hidden", "");

            const fieldBlock = container.find(`.field-${fieldType}`);
            if (!fieldBlock.length) return;

            fieldBlock.removeAttr("hidden");

            if (fieldType === "dropdown" && fieldOptions) {
                try {
                    const dropdown = fieldBlock.find("select");
                    dropdown.empty().append('<option value="None">None</option>');

                    JSON.parse(fieldOptions).forEach(option => {
                        dropdown.append($("<option>").val(option).text(option));
                    });

                    dropdown.val(fieldValue).change();
                } catch (e) {
                    console.error("Error parsing dropdown options", e);
                }
            } else {
                const inputField = fieldBlock.find(".field-input");
                if (!inputField.length) return;

                if (fieldType === "tickbox") {
                    inputField.prop("checked", fieldValue !== "off");
                } else {
                    inputField.val(fieldValue);
                }
            }

            let input = $actionRow.find('[name^="skip[' + actionName + '_' + fieldId + ']"]');
            input.find('option[value="' + actionSkip + '"]').prop('selected', true);
        });
    },
    populateViewPanel: function (actionId) {
        WHMCS.http.jqClient.jsonGet({
            url: WHMCS.adminUtils.getAdminRouteUrl('/support/ticket/' + ticketid + '/actions/' + actionId),
            success: function(data) {
                let delay = 0;
                switch (scheduledActionsUI.getPanelModeAttr()) {
                    case 'create':
                        scheduledActionsUI.deselectToggleManageButton()
                    case 'view':
                        delay = 600;
                        scheduledActionsUI.hideScheduledActionManagementPanel();
                        break;
                }
                setTimeout(function () {
                    if (data.result === 'success') {
                        let timeType = 'exact';
                        let actionName = data.result_data.action;
                        let actionText = data.result_data.name;
                        let actionScheduled = data.result_data.scheduled;
                        let actionSkip = data.result_data.skip;
                        let actionParameters = data.result_data.parameters;
                        let actionStatus = data.result_data.status;
                        let cancelStatuses = ['scheduled', 'in_progress', 'failed'];
                        let saveStatuses = ['scheduled'];

                        scheduledActionsUI.discardUnsavedActions()
                            .setPanelModeAttr('view')
                            .setPanelId(actionId)
                            .showPanelTitle('detailed')
                            .showControlButtons(['close']);

                        if (cancelStatuses.includes(actionStatus)) {
                            scheduledActionsUI.showControlButtons(['cancel']);
                        }

                        let actionRow = scheduledActionsUI.addUnsavedActionRow(
                            'div' + actionName,
                            actionText
                        );
                        scheduledActionsUI.applyInputParameters(actionRow, actionName, actionSkip, actionParameters)
                            .hideCancelButton()
                            .updateTimeElements(timeType);
                        if (saveStatuses.includes(actionStatus)) {
                            scheduledActionsUI.showControlButtons(['save'])
                                .disableTimeSelectionInputs();
                        } else {
                            scheduledActionsUI.disableInputs();
                        }
                        scheduledActionsUI.setDetailedTitle(data.result_data.statusFriendly, data.result_data.statusAt)
                            .showScheduledActionManagementPanel();

                        scheduledActionsUI.getManagementPanel()
                            .find('.select-scheduled-actions-when-to-action')
                            .val(timeType);
                        scheduledActionsUI.getManagementPanel()
                            .find('.container-exact-date-time input')
                            .val(actionScheduled);
                        scheduledActionsUI.getManagementPanel()
                            .find('.scheduled-action-panel-mode-view')
                            .hide();
                    } else if (data.result === 'error') {
                        jQuery.growl
                            .warning({title: '', message: data.resultMessage});
                    }
                }, delay);
            }
        });
        return this;
    },
    isAddReplyTab: function (triggerElement) {
        return (jQuery(triggerElement).parents('.ticket-reply-submit-options').length > 0);
    },
    setDetailedTitle: function (status, dateTime) {
        this.getManagementPanel()
            .find('span.title-scheduled-action-status')
            .text(status.toLowerCase());
        this.getManagementPanel()
            .find('span.title-scheduled-action-datetime')
            .text(dateTime);
        return this;
    },
    setPanelModeAttr: function (mode) {
        this.getManagementPanel().data('panel-mode', mode);
        return this;
    },
    setPanelId: function (id) {
        this.panelId = id;
        return this;
    },
    activeModal: {
        targetModal: null,
        show: function () {
            this.targetModal.modal('show');
            return this;
        },
        hide: function () {
            this.targetModal.modal('hide');
            return this;
        }
    },
    enableModal: function (initiator, actionId = null) {
        this.modalInitiator = initiator;
        this.modalActionId = actionId;
        return this;
    },
    resetModal: function () {
        this.modalInitiator = '';
        this.modalActionId = '';
        this.activeModal.targetModal = null;
    },
    enableDiscardModal: function (initiator, actionId = null) {
        this.enableModal(initiator, actionId);
        this.activeModal.targetModal = this.targetDiv.find('.modal-scheduled-action-discard-confirm');
        return this.activeModal;
    },
    enableCancelModal: function (initiator, actionId = null) {
        this.enableModal(initiator, actionId);
        this.activeModal.targetModal = this.targetDiv.find('.modal-scheduled-action-cancel-confirm');
        return this.activeModal;
    },
    listRow: function () {
        return jQuery(`#scheduledAction${this.activeRow}`);
    },
    listSelect: function (actionId) {
        if (this.activeRow !== null) {
            this.listDeselect();
        }
        this.activeRow = actionId;
        this.listRow().addClass('selected');
    },
    listDeselect: function () {
        this.listRow().removeClass('selected');
        this.activeRow = null;
    },
    setTargetDiv: function (triggerElement) {
        this.targetDiv = jQuery(triggerElement)
            .closest('div.ticket-reply-submit-options, div.container-scheduled-actions-tab');
        return this;
    },
    getPanelModeAttr: function () {
        return this.getManagementPanel().data('panel-mode');
    },
    getManagementPanel: function ()  {
        return this.targetDiv.find('.panel-scheduled-actions-management');
    }
}

function refreshScheduledActionList()
{
    WHMCS.ui.dataTable.getTableById('scheduledActionsList').ajax.reload();
}

function setScheduledActionTabCount(count)
{
    jQuery('.ticket-actions-count').text(count);
}

function updateInputName(input, actionName, fieldId) {
    input.setAttribute("name", `parameters[${actionName}_${fieldId}][customField][${fieldId}]`);
}

function updateActionAndSkip(containerActions, actionName, fieldId) {
    const actionInput = containerActions.querySelector('input[name="actions[]"]');
    const skipInput = containerActions.querySelector('select[name^="skip[CustomFieldValue"]');

    if (actionInput) {
        actionInput.value = `${actionName}_${fieldId}`;
    }
    if (skipInput) {
        skipInput.setAttribute('name', `skip[CustomFieldValue_${fieldId}]`);
    }
}

function showCustomField(selectElement) {
    const container = selectElement.closest(".field-container");
    if (!container || container.classList.contains("cloneable")) return;

    const selectedOption = selectElement.options[selectElement.selectedIndex || 0];
    const fieldType = selectedOption.getAttribute("data-type");
    const fieldId = selectedOption.value;
    const actionName = selectedOption.getAttribute("data-action-name");
    const fieldOptions = selectedOption.getAttribute("data-options");

    container.querySelectorAll(".field-block").forEach(block => {
        block.hidden = true;
        block.querySelectorAll(".field-input").forEach(input => input.removeAttribute("name"));
    });

    const fieldBlock = container.querySelector(`.field-${fieldType}`);
    if (!fieldBlock) return;

    fieldBlock.hidden = false;
    fieldBlock.querySelectorAll(".field-input").forEach(input =>
        updateInputName(input, actionName, fieldId)
    );

    const containerActions = fieldBlock.closest('.divCustomFieldValue');
    updateActionAndSkip(containerActions, actionName, fieldId);

    if (fieldType === "dropdown" && fieldOptions) {
        try {
            const dropdown = fieldBlock.querySelector("select");
            dropdown.innerHTML = '<option value="None">None</option>' +
                JSON.parse(fieldOptions).map(option => `<option value="${option}">${option}</option>`).join("");
        } catch (e) {
            console.error("Error parsing dropdown options", e);
        }
    }
}

document.addEventListener("DOMContentLoaded", function () {
    function triggerCustomField() {
        setTimeout(() => {
            document.querySelectorAll('.custom-field-selector').forEach(select => {
                if (!select.dataset.processed && !select.closest('.cloneable')) {
                    showCustomField(select);
                    select.dataset.processed = "true";
                }
            });
        }, 10);
    }

    const container = document.querySelector('.container-fluid.container-created-actions');

    if (container) {
        const observer = new MutationObserver(() => {
            triggerCustomField();
        });

        observer.observe(container, { childList: true, subtree: true });
    }

    document.body.addEventListener("click", function (event) {
        if (event.target.closest('.btn-scheduled-action-add')) {
            triggerCustomField();
        }
    });
});
