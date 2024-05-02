function doEmailCreate() {
    jQuery("#btnCreateLoader").addClass('fa-spinner fa-spin').removeClass('fa-plus');
    jQuery("#emailCreateSuccess").slideUp();
    jQuery("#emailCreateFailed").slideUp();
    WHMCS.http.jqClient.post(
        "clientarea.php",
        "action=productdetails&modop=custom&a=CreateEmailAccount&" + jQuery("#frmCreateEmailAccount").serialize(),
        function( data ) {
            jQuery("#btnCreateLoader").removeClass('fa-spinner fa-spin').addClass('fa-plus');
            if (data.success) {
                jQuery('#cpanel-email-prefix').val('');
                jQuery('#cpanel-email-password').val('');
                jQuery("#emailCreateSuccess").hide().removeClass('hidden')
                    .slideDown();
            } else {
                jQuery("#emailCreateFailedErrorMsg").html(data.errorMsg);
                jQuery("#emailCreateFailed").hide().removeClass('hidden')
                    .slideDown();
            }
        }
    );
}

(function ($) {
    $(document).ready(function() {
        $('#btnInstallWordpress').click(function() {
            var icon = $(this).find('i');

            icon.removeClass('fa-plus').addClass('fa-spinner fa-spin');

            $('#wordPressInstallResultRow').slideUp(function() {
                $('#wordPressInstallResultRow').find('.alert').hide();
            });

            $('#btnInstallWordpress').attr('disabled', 'disabled');

            WHMCS.http.jqClient.jsonPost({
                url: 'clientarea.php',
                data: {
                    action: 'installWordpress',
                    serviceId: $('#cPanelWordPress').data('service-id'),
                    token: csrfToken,
                    blog_title: $('#wpNewBlogTitle').val(),
                    path: $('#wpNewPath').val(),
                    admin_pass: $('#wpAdminPass').val()
                },
                success: function(data) {
                    $('#wordPressInstances').append(
                        $('<option>')
                            .attr('value', data.instanceUrl)
                            .text(
                                data.blogTitle
                                + (data.path ? ' (' + data.path + ')' : '')
                            )
                    );

                    $('#newWordPressLink').attr('href', data.instanceUrl);
                    $('#newWordPressAdminLink').attr('href', data.instanceUrl + '/wp-login.php');

                    $('#wordpressInstanceRow').slideDown();

                    $('#wordPressInstallResultRow').find('.alert-success').show();
                    $('#wordPressInstallResultRow').slideDown();

                    $('#wpNewBlogTitle').val('');
                    $('#wpAdminPass').val('');
                    $('#wpNewPath').val('').trigger('keyup');
                },
                error: function(data) {
                    $('#wordPressInstallResultRow').find('.alert-danger').text(data).show();
                    $('#wordPressInstallResultRow').slideDown();
                },
                always: function() {
                    icon.removeClass('fa-spinner fa-spin').addClass('fa-plus');
                    $('#btnInstallWordpress').removeAttr('disabled');
                }
            });
        });

        $('#btnGoToWordPressHome').click(function() {
            window.open($('#wordPressInstances').val());
        });

        $('#btnGoToWordPressAdmin').click(function() {
            window.open($('#wordPressInstances').val() + '/wp-login.php');
        });

        var wpDomain = $('#cPanelWordPress').data('wp-domain');

        $('#wpNewPath').keyup(function() {
            let path = $('#wpNewPath').val().trim().replace(/^\//, '').replace(/\/$/, '');
            let patterns = [
                /[^a-z\d\-_\/]/i,
                /^\//i,
                /\/$/i,
                /\/{2,}/i,
            ];

            let isValidPath = patterns.every(function (pattern){
                return !path.match(pattern);
            });

            $('#newWordPressFullUrlPreview')
                .toggleClass('text-danger', !isValidPath)
                .text('https://' + wpDomain + '/' + path + (path.length ? '/' : '') );
        });
    });

})(jQuery);

// Sitejet

function fallbackSitejetPreview(e) {
    const image = jQuery(e.currentTarget);

    if (image.data('is-placeholder')) {
        return;
    }

    image
        .data('is-placeholder', true)
        .attr('src', whmcsBaseUrl + '/assets/img/sitejet/preview_placeholder.png');
}

function sitejetPreviewLoadComplete(e) {
    const image = jQuery(e.currentTarget);

    if (!image.data('publish-in-progress')) {
        image.css('opacity', 1);
    }
}

(function ($) {
    $(document).ready(function () {
        var btnEditSitejet = $('#sitejetEditBtn');

        var publishSitejet = function() {
            var currentUrl = new URL(window.location.href);
            if (!currentUrl.searchParams.has('sitejet_action', 'publish')) {
                return;
            }

            var serviceId = btnEditSitejet.data('serviceid');
            if (!serviceId) {
                return;
            }

            var sitejetPublishProgressBarWrapper = $('#sitejetPublishProgressBarWrapper');
            var sitejetPublishProgressBar = sitejetPublishProgressBarWrapper.find('.progress-bar');
            var sitejetPublishPreview = $('#sitejetPublishPreview');
            var sitejetAlert = $('#sitejetAlert');
            var sitejetPublishProgressBarPollInterval = 2000;

            function sitejetPublishErrorHandler(errorMessage)
            {
                sitejetAlert
                    .removeClass('alert-success alert-info')
                    .addClass('alert-danger')
                    .html(errorMessage);

                sitejetPublishProgressBar
                    .removeClass('progress-bar-striped progress-bar-animated')
                    .addClass('bg-danger');

                sitejetEndPublish(false);
            }

            function sitejetStartPublish()
            {
                btnEditSitejet.attr('disabled', 'disabled');
                $('#sitejetViewLink').addClass('disabled');

                sitejetPublishPreview.css('opacity', 0.3).data('publish-in-progress', true);
            }

            function sitejetEndPublish(success)
            {
                btnEditSitejet.removeAttr('disabled');
                $('#sitejetViewLink').removeClass('disabled');

                if (success) {
                    var sitejetPreviewUrl = new URL(
                        sitejetPublishPreview.data('src')
                    );

                    // need to force refresh new preview image
                    sitejetPreviewUrl.searchParams.append('refresh', 1);
                    sitejetPreviewUrl.searchParams.append('nocache', Date.now());

                    sitejetPublishPreview
                        .css('opacity', 0.3)
                        .data('publish-in-progress', false)
                        .data('is-placeholder', false)
                        .attr('src', sitejetPreviewUrl.toString());
                } else {
                    sitejetPublishPreview.css('opacity', 1).data('publish-in-progress', false);
                }
            }

            function sitejetPublishUpdateProgress(progressUrl)
            {
                WHMCS.http.jqClient.post({
                    url: progressUrl,
                    data: {
                        token: csrfToken
                    },
                    success: function (responseData) {
                        if (responseData.error) {
                            sitejetPublishErrorHandler(responseData.error);
                            return;
                        }
                        if (responseData.success === false) {
                            sitejetPublishErrorHandler(sitejetAlert.data('error-text'));
                            return;
                        }


                        if (responseData.completed) {
                            sitejetEndPublish(true);

                            sitejetPublishProgressBar
                                .css('width', '100%')
                                .removeClass('progress-bar-striped progress-bar-animated')
                                .addClass('bg-success');

                            sitejetAlert
                                .removeClass('alert-danger alert-info')
                                .addClass('alert-success')
                                .html(
                                    sitejetAlert.data('success-text')
                                );

                            return;
                        }

                        if (responseData.progress > 5) {
                            sitejetPublishProgressBar.css('width', responseData.progress + '%');
                        }

                        setTimeout(sitejetPublishUpdateProgress, sitejetPublishProgressBarPollInterval, progressUrl)
                    },
                    error: function (data) {
                        sitejetPublishErrorHandler(sitejetAlert.data('error-text'));
                    },
                });
            }

            var sitejetPublishUrl = WHMCS.utils.getRouteUrl(
                '/clientarea/sitejet/service/' + serviceId + '/publish'
            );

            sitejetPublishProgressBar
                .removeClass('bg-success')
                .css('width', '5%')
                .addClass('progress-bar-striped progress-bar-animated');

            sitejetPublishProgressBarWrapper.show();

            sitejetAlert
                .removeClass('alert-success alert-danger')
                .addClass('alert-info')
                .html(
                    sitejetAlert.data('progress-text')
                )
                .show();

            sitejetStartPublish();

            WHMCS.http.jqClient.post({
                url: sitejetPublishUrl,
                data: {
                    token: csrfToken
                },
                success: function (responseData) {
                    if (responseData.error) {
                        sitejetEndPublish(false);
                        sitejetPublishErrorHandler(responseData.error);
                        return;
                    }

                    if (!responseData.progress_url) {
                        sitejetEndPublish(false);
                        sitejetPublishErrorHandler(sitejetAlert.data('error-text'));
                        return;
                    }

                    sitejetPublishUpdateProgress(responseData.progress_url);
                },
                error: function (data) {
                    sitejetEndPublish(false);
                    sitejetPublishErrorHandler(sitejetAlert.data('error-text'));
                },
            });
        }

        if (btnEditSitejet.data('do-publish')) {
            publishSitejet();
        }
    });
})(jQuery);
