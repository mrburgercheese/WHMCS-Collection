$(document).ready(function(){
    (function() {
            var fieldSelection = {
                addToReply: function() {
                    var url = arguments[0] || '',
                    title = arguments[1] || '',
                    e = this.jquery ? this[0] : this,
                        text = '';

                    if (title !== '') {
                        text = '[' + title + '](' + url + ')';
                    } else {
                        text = url;
                    }

                return (
                    ('selectionStart' in e && function() {
                        if (e.value === "\n\n" + openTicketSignature) {
                            e.selectionStart=0;
                            e.selectionEnd=0;
                        }
                        e.value = e.value.substr(0, e.selectionStart) + text + e.value.substr(e.selectionEnd, e.value.length);
                        e.focus();
                        return this;
                    }) ||
                    (document.selection && function() {
                        e.focus();
                        document.selection.createRange().text = text;
                        return this;
                    }) ||
                    function() {
                        e.value += text;
                        return this;
                    }
                )();
            }
        };
        $.each(fieldSelection, function(i) { $.fn[i] = this; });
    })();
    $("#addfileupload").click(function () {
        $("#fileuploads").append("<input type=\"file\" name=\"attachments[]\" class=\"form-control top-margin-5\">");
        return false;
    });
    $("#predefq").keyup(function () {
        var intellisearchlength = $(this).val().length;
        if (intellisearchlength>2) {
            WHMCS.http.jqClient.post(
                "supporttickets.php",
                {
                    action: "loadpredefinedreplies",
                    predefq: $("#predefq").val(),
                    token: csrfToken
                },
                function(data) {
                    $("#prerepliescontent").html(data);
                }
            );
        }
    });
    $("#frmOpenTicket").submit(function (e, options) {
        options = options || {};

        $("#btnOpenTicket").attr("disabled", "disabled");
        $("#btnOpenTicket i").removeClass("fa-plus").addClass("fa-spinner fa-spin");

        if (options.skipValidation) {
            return true;
        }

        e.preventDefault();

        var gotValidResponse = false,
            postReply = false,
            responseMsg = '',
        thisElement = $(this);

        WHMCS.http.jqClient.post(
            "supporttickets.php",
            {
                action: "validatereply",
                id: 0,
                status: 'new',
                token: csrfToken
            },
            function(data){
                gotValidResponse = true;
                if (data.valid) {
                    postReply = true;
                } else {
                    // access denied
                    responseMsg = 'Access Denied. Please try again.';
                }
            },
            "json"
        )
            .always(function() {
                var adminMessage = $("#replyingAdminMsg");
                if (!gotValidResponse) {
                    responseMsg = 'Session Expired. Please <a href="javascript:location.reload()" class="alert-link">reload the page</a> before continuing.';
                }

                if (responseMsg) {
                    postReply = false;
                    adminMessage.html(responseMsg);
                    adminMessage.removeClass('alert-info').addClass('alert-warning');
                    if (!adminMessage.is(":visible")) {
                        adminMessage.hide().removeClass('hidden').slideDown();
                    }
                    $('html, body').animate({
                    scrollTop: adminMessage.offset().top - 15
                }, 400);
            }

            if (postReply) {
                adminMessage.slideUp();
                thisElement.attr('data-no-clear', 'false');
                $("#frmOpenTicket").trigger('submit', { 'skipValidation': true });
            } else {
                $("#btnOpenTicket").removeAttr("disabled");
                $("#btnOpenTicket i").removeClass("fa-spinner fa-spin").addClass("fa-plus");
            }
        });
    });

    $(document).on('change', 'input[name="related_service[]"]', function () {
        var id = $(this).val(),
            type = $(this).data('type');
        if (!id || id === 0) {
            type = '';
        }
        $('#inputRelatedServiceType').val(type);
    })

    jQuery(document).on('click', '#relatedservicestbl tr', function() {
        if(!jQuery('#relatedservicestbl .related-service').hasClass('hidden')) {
            jQuery(this).find('input').prop('checked', true);
        }
    });

    jQuery(document).on('click', '#relatedservicestbl tr a', function(e) {
        e.stopPropagation();
    });
});

function insertKBLink(url, title) {
    $("#replymessage").addToReply(url, title);
}
function selectpredefcat(catid) {
    WHMCS.http.jqClient.post(
        "supporttickets.php",
        {
            action: "loadpredefinedreplies",
            cat: catid,
            token: csrfToken
        },
        function(data){
            $("#prerepliescontent").html(data);
        });
}
function loadpredef(catid) {
    $("#prerepliescontainer").slideToggle();
    $("#prerepliescontent").html('<img src="images/loading.gif" align="top" /> ' + loadingText);
    WHMCS.http.jqClient.post(
        "supporttickets.php",
        {
            action: "loadpredefinedreplies",
            cat: catid,
            token: csrfToken
        },
        function(data){
            $("#prerepliescontent").html(data);
        });
}
function selectpredefreply(artid) {
    WHMCS.http.jqClient.post(
        "supporttickets.php",
        {
            action: "getpredefinedreply",
            id: artid,
            token: csrfToken
        },
        function(data){
            $("#replymessage").addToReply(data);
        });
    $("#prerepliescontainer").slideToggle();
}
function dropdownSelectClient(userId, name, email) {
    var rowSelectInfo = $('#rowSelectInfo'),
        relatedServicesTable = $('#relatedservicestbl'),
        relatedServiceBtn = jQuery('#btnRelatedServiceExpand');
    $("#clientinput").val(userId);
    $("#name").val(name).prop("disabled", true);
    if (email === "undefined") {
        $("#email").prop("disabled", true);
    } else {
        $("#email").val(email).prop("disabled", true);
    }

    if (rowSelectInfo.hasClass('hidden')) {
        relatedServicesTable.find('tr')
            .not("[data-original='true']")
            .remove();
    }
    relatedServicesTable.find('tr')
        .not(":first-child")
        .hide();
    rowSelectInfo.after(
        '<tr id="rowLoading" class="fieldlabel text-center"><td colspan="7">' +
            '<img src="images/loading.gif" align="top" /> ' + loadingText + '</td></tr>'
    );

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
                var ccs = jQuery(".selectize-newTicketCc")[0].selectize;
                if (typeof ccs !== 'undefined') {
                    ccs.clear();
                    ccs.clearOptions();
                    if (data.ccs.length) {
                        ccs.addOption(data.ccs);
                    }
                }

                if (data.services && relatedServiceBtn.length) {
                    relatedServiceBtn.prop('disabled', false);
                }

                relatedServicesTable.find('tbody').append(data.services);
                relatedServicesTable.find('td.hidden').removeClass('hidden');
                relatedServicesTable.find('tr.hidden').removeClass('hidden');
                relatedServicesTable.find('tr').not("[id='rowSelectInfo']").show();
                rowSelectInfo.addClass('hidden');
                if (relatedServiceType) {
                    $('input[name="related_service[]"][data-type="' + relatedServiceType + '"][value="' + relatedService + '"]')
                        .prop('checked', true);
                    $('#inputRelatedServiceType').val(relatedServiceType);
                    relatedServiceType = undefined;
                } else {
                    $('input[name="related_service[]"]').first().prop('checked', true);
                    $('#inputRelatedServiceType').removeAttr('value');
                }
            },
            always: function() {
                $('#rowLoading').remove();
            }
        }
    );
}

function openTicketExpandRelServices() {
    var rowSelectInfo = jQuery('#rowSelectInfo'),
        relatedServicesTable = jQuery('#relatedservicestbl'),
        relatedServiceBtn = jQuery('#btnRelatedServiceExpand'),
        clientId = jQuery('#clientinput').val();

    relatedServiceBtn.prop('disabled', true).find('span').toggleClass('hidden');
    WHMCS.http.jqClient.jsonPost(
        {
            url: WHMCS.adminUtils.getAdminRouteUrl(
                '/support/ticket/open/client/' + clientId + '/additional/data'
            ),
            data: {
                token: csrfToken
            },
            success: function (data) {
                if (data.services) {
                    relatedServicesTable.find('tbody').children().not('#relatedServiceNone').remove();
                    relatedServicesTable.find('tbody').append(data.services);
                    if (rowSelectInfo.hasClass('hidden')) {
                        relatedServicesTable.find('td.hidden').removeClass('hidden');
                        relatedServicesTable.find('tr.hidden').removeClass('hidden');
                        rowSelectInfo.addClass('hidden');
                    }
                    if (relatedServiceType) {
                        jQuery('input[name="related_service[]"][data-type="' + relatedServiceType + '"][value="' + relatedService + '"]')
                            .prop('checked', true);
                        jQuery('#inputRelatedServiceType').val(relatedServiceType);
                    }
                }
            },
            always: function () {
                relatedServiceBtn.find('span').toggleClass('hidden');
            }
        }
    );
}
