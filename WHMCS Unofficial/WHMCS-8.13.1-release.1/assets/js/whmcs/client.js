/**
 * WHMCS client module
 *
 * @copyright Copyright (c) WHMCS Limited 2005-2017
 * @license http://www.whmcs.com/license/ WHMCS Eula
 */
(function(module) {
    if (!WHMCS.hasModule('client')) {
        WHMCS.loadModule('client', module);
    }
})({
registration: function () {
    this.prefillPassword = function (params) {
        params = params || {};
        if (typeof params.hideContainer === 'undefined') {
            var id = (jQuery('#inputSecurityQId').attr('id')) ? '#containerPassword' : '#containerNewUserSecurity';
            params.hideContainer = jQuery(id);
            params.hideInputs = true;
        } else if (typeof params.hideContainer === 'string' && params.hideContainer.length) {
            params.hideContainer = jQuery(params.hideContainer);
        }

        if (typeof params.form === 'undefined') {
            params.form = {
                password: [
                    {id: 'inputNewPassword1'},
                    {id: 'inputNewPassword2'}
                ]
            };
        }

        var prefillFunc = function () {
            var $randomPasswd = WHMCS.utils.simpleRNG();
            for (var i = 0, len = params.form.password.length; i < len; i++) {
                jQuery('#' + params.form.password[i].id)
                    .val($randomPasswd).trigger('keyup');
            }
        };

        if (params.hideInputs) {
            params.hideContainer.slideUp('fast', prefillFunc);
        } else {
            prefillFunc();
        }
    };

    return this;
},

tokenProcessor: function () {
    this.hostOrigin = window.location.origin;
    this.postForm = null;

    /**
     * @return Object A jQuery instance of auto-POST form
     */
    this.getAutoPostForm = function () {
        if (!this.postForm) {
            this.postForm = jQuery('<form>')
                .attr('id', 'whmcsAutoPostForm')
                .attr('target', '_self')
                .attr('method', 'POST')
                .append(
                    jQuery('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'token')
                        .attr('value', csrfToken)
                );

            jQuery('body').append(this.postForm);
        }

        return this.postForm;
    },

    /**
     * @param {URL} url
     * @return boolean
     */
    this.isSameOrigin = function (url) {
        return url.origin && (url.origin === this.hostOrigin);
    },

    /**
     * @param {URL} url
     * @return boolean
     */
    this.isClientModopCustom = function (url) {
        if (!url.pathname || !url.pathname.match(/\/clientarea.php$/)) {
            return false;
        }

        if (!url.searchParams || (url.searchParams.get('modop') !== 'custom')) {
            return false;
        }

        return true;
    },

    /**
     * Normalizes a string URL by converting it to a URL object and appending origin as necessary
     *
     * @param {string} urlString
     * @return URL
     */
    this.getFqUrl = function(urlString) {
        try {
            if (!urlString.match(/[a-z]+:\/\//i)) {
                // URLs without origin will not parse

                if (urlString.indexOf('/') !== 0) {
                    const whmcsPath = window.location.pathname.split('/').slice(0, -1).join('/');

                    urlString = `${whmcsPath}/${urlString}`;
                }

                urlString = `${this.hostOrigin}${urlString}`;
            }

            return url = new URL(urlString);
        } catch (e) {
            return null;
        }
    }

    /**
     * @param {URL|string} url
     * @return boolean
     */
    this.isUrlEligibleForToken = function (url) {
        if (typeof url === 'string') {
            url = this.getFqUrl(url);

            if (!url) {
                return false;
            }
        }

        if ((typeof url !== 'object')) {
            return false;
        }

        if (!this.isSameOrigin(url)) {
            return false;
        }

        return this.isClientModopCustom(url);
    },

    /**
     * @param {string} urlString
     * @param {string|null} target
     * @return void
     */
    this.submitUrlViaPost = function (urlString, target) {
        jQuery(this.getAutoPostForm())
            .attr('target', target || '_self')
            .attr('action', urlString)
            .submit();
    };

    /**
     * @return void
     */
    this.processTokenSubmitters = function () {
        jQuery('a').each((index, link) => {
            const urlString = jQuery(link).attr('href');

            if (!urlString) {
                return;
            }

            if (!this.isUrlEligibleForToken(urlString)) {
                return;
            }

            if (!jQuery(link).data('whmcs-tokenized')) {
                jQuery(link).data('whmcs-tokenized', true);

                jQuery(link).attr('href', '#');

                jQuery(link).on('click', (e) => {
                    let target = jQuery(link).attr('target');

                    if (e.metaKey || e.ctrlKey) {
                        target = '_blank';
                    }

                    e.preventDefault();
                    this.submitUrlViaPost(urlString, target);
                });

                jQuery(link).on('contextmenu', (e) => {
                    e.preventDefault();
                    return false;
                });
            }
        });
    }
}
});
