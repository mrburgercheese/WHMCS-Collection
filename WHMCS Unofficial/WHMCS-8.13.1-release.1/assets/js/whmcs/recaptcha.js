/**
 * reCaptcha module - used for captcha apis compatible with the google recaptcha api
 *
 * @copyright Copyright (c) WHMCS Limited 2005-2020
 * @license http://www.whmcs.com/license/ WHMCS Eula
 */
var recaptchaLoadComplete = false,
    recaptchaCount = 0,
    recaptchaType = 'recaptcha',
    recaptchaValidationComplete = false;

(function(module) {
    if (!WHMCS.hasModule('recaptcha')) {
        WHMCS.loadModule('recaptcha', module);
    }
})(
    function () {

        this.register = function () {
            if (recaptchaLoadComplete) {
                return;
            }
            var postLoad = [],
                recaptchaForms = jQuery(".btn-recaptcha").parents('form'),
                isInvisible = false;
            recaptchaForms.each(function (i, el){
                if (typeof recaptcha.siteKey === 'undefined') {
                    console.error('Recaptcha site key not defined');
                    return;
                }
                if (typeof recaptcha.libUrl === 'undefined') {
                    console.error('Recaptcha client js url not defined');
                    return;
                }
                if (typeof recaptcha.apiObject === 'undefined') {
                    console.error('Recaptcha client js api object name not defined');
                    return;
                }
                recaptchaCount += 1;
                var frm = jQuery(el),
                    btnRecaptcha = frm.find(".btn-recaptcha"),
                    required = (typeof recaptcha.requiredText !== 'undefined')
                        ? recaptcha.requiredText
                        : 'Required',
                    recaptchaId = 'divDynamicRecaptcha' + recaptchaCount;

                isInvisible = btnRecaptcha.hasClass('btn-recaptcha-invisible')

                // if no recaptcha element, make one
                var recaptchaContent = frm.find('#' + recaptchaId + ' .g-recaptcha'),
                    recaptchaElement = frm.find('.recaptcha-container'),
                    appendElement = frm;

                if (recaptchaElement.length) {
                    recaptchaElement.attr('id', recaptchaElement.attr('id') + recaptchaCount);
                    appendElement = recaptchaElement;
                }
                if (!recaptchaContent.length) {
                    appendElement.append('<div id="#' + recaptchaId + '" class="g-recaptcha"></div>');
                    recaptchaContent = appendElement.find('#' + recaptchaId);
                }
                // propagate invisible recaptcha if necessary
                if (!isInvisible) {
                    recaptchaContent.data('toggle', 'tooltip')
                        .data('placement', 'bottom')
                        .data('trigger', 'manual')
                        .attr('title', required)
                        .hide();
                }

                // make callback for grecaptcha to invoke after
                // injecting token & make it known via data-callback
                var funcName = recaptchaId + 'Callback';
                window[funcName] = function () {
                    if (isInvisible) {
                        frm.submit();
                    }
                };

                // setup an on form submit event to ensure that we
                // are allowing required field validation to occur before
                // we do the invisible recaptcha checking
                if (isInvisible) {
                    recaptchaType = 'invisible';
                    frm.on('submit.recaptcha', function (event) {
                        var recaptchaId = frm.find('.g-recaptcha').data('recaptcha-id');
                        if (!window[recaptcha.apiObject].getResponse(recaptchaId).trim()) {
                            event.preventDefault();
                            window[recaptcha.apiObject].execute(recaptchaId);
                            recaptchaValidationComplete = false;
                        } else {
                            recaptchaValidationComplete = true;
                        }
                    });
                } else {
                    postLoad.push(function () {
                        recaptchaContent.slideDown('fast', function() {
                            // just in case there's a delay in DOM; rare
                            recaptchaContent.find(':first').addClass('center-block');
                        });
                    });
                    postLoad.push(function() {
                        recaptchaContent.find(':first').addClass('center-block');
                    });
                }
            });

            window.recaptchaLoadCallback = function() {
                jQuery('.g-recaptcha').each(function(i, el) {
                    var element = jQuery(el),
                        frm = element.closest('form'),
                        btn = frm.find('.btn-recaptcha'),
                        idToUse = element.attr('id').substring(1);
                    var recaptchaId = grecaptcha.render(
                        el,
                        {
                            sitekey: recaptcha.siteKey,
                            size: (btn.hasClass('btn-recaptcha-invisible')) ? 'invisible' : 'normal',
                            callback: idToUse + 'Callback'
                        }
                    );
                    element.data('recaptcha-id', recaptchaId);
                });
            }

            // fetch/invoke the remote library
            if (recaptchaForms.length) {
                jQuery.getScript(recaptcha.libUrl, function () {
                    for(var i = postLoad.length - 1; i >= 0 ; i--){
                        postLoad[i]();
                    }
                });
            }

            // captcha overlay badge
            let captchaOverlayBadge = jQuery('.captcha-overlay-badge'),
                captchaOverlayPopup = jQuery('.captcha-overlay-popup');
            if (recaptchaForms.length && captchaOverlayBadge.length) {
                captchaOverlayBadge.show();
                if (captchaOverlayPopup.length) {
                    let captchaOverlayTimer;
                    function captchaPopupHide() {
                        captchaOverlayPopup.hide();
                    }
                    function debounce(func, delay) {
                        return function() {
                            const context = this;
                            const args = arguments;
                            clearTimeout(captchaOverlayTimer);
                            captchaOverlayTimer = setTimeout(function() {
                                func.apply(context, args);
                            }, delay);
                        };
                    }
                    const debouncedCaptchaPopupHide = debounce(captchaPopupHide, 3000);
                    captchaOverlayBadge.bind('mouseenter', function() {
                        captchaOverlayPopup.show();
                        clearTimeout(captchaOverlayTimer);
                    });
                    captchaOverlayBadge.bind('mouseleave', debouncedCaptchaPopupHide);
                    captchaOverlayBadge.bind('touchstart', function() {
                        captchaOverlayPopup.show();
                        clearTimeout(captchaOverlayTimer);
                        captchaOverlayTimer = setTimeout(captchaPopupHide, 3000);
                    });

                }
            }
            recaptchaLoadComplete = true;
        };

        this.setupCallback = (callback) => {
            if (typeof callback !== 'function') {
                return;
            }

            jQuery('.g-recaptcha').each(function(i, el) {
                const idToUse = jQuery(el).attr('id').substring(1);
                const originalCallbackName = idToUse + 'Callback';
                const backupCallbackName = originalCallbackName + 'Original';


                if (typeof window[backupCallbackName] === 'undefined') {
                    window[backupCallbackName] = window[originalCallbackName];
                }

                window[originalCallbackName] = callback;
            });
        }

        this.restoreDefaultCallback = () => {
            jQuery('.g-recaptcha').each(function(i, el) {
                const idToUse = jQuery(el).attr('id').substring(1);
                const originalCallbackName = idToUse + 'Callback';
                const backupCallbackName = originalCallbackName + 'Original';

                if (typeof window[backupCallbackName] !== 'undefined') {
                    window[originalCallbackName] = window[backupCallbackName];
                    delete window[backupCallbackName];
                }
            });
        }

        return this;
    });
