/**
 * reCaptcha module
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
                if (typeof recaptchaSiteKey === 'undefined') {
                    console.log('Recaptcha site key not defined');
                    return;
                }
                recaptchaCount += 1;
                var frm = jQuery(el),
                    btnRecaptcha = frm.find(".btn-recaptcha"),
                    required = (typeof requiredText !== 'undefined') ? requiredText : 'Required',
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


                // alter form to work around JS behavior on .submit() when there
                // there is an input with the name 'submit'
                var btnSubmit = frm.find("input[name='submit']");
                if (btnSubmit.length) {
                    var action = frm.prop('action');
                    frm.prop('action', action + '&submit=1');
                    btnSubmit.remove();
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
                        if (!grecaptcha.getResponse(recaptchaId).trim()) {
                            event.preventDefault();
                            grecaptcha.execute(recaptchaId);
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
                            sitekey: recaptchaSiteKey,
                            size: (btn.hasClass('btn-recaptcha-invisible')) ? 'invisible' : 'normal',
                            callback: idToUse + 'Callback'
                        }
                    );
                    element.data('recaptcha-id', recaptchaId);
                });
            }

            // fetch/invoke the grecaptcha lib
            if (recaptchaForms.length) {
                var gUrl = "https://www.google.com/recaptcha/api.js?onload=recaptchaLoadCallback&render=explicit";
                jQuery.getScript(gUrl, function () {
                    for(var i = postLoad.length - 1; i >= 0 ; i--){
                        postLoad[i]();
                    }
                });
            }
            recaptchaLoadComplete = true;
        };

        return this;
    });
