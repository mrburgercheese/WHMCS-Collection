/**
 * WHMCS Telephone Country Code Dropdown
 *
 * Using https://github.com/jackocnr/intl-tel-input
 *
 * @copyright Copyright (c) WHMCS Limited 2005-2019
 * @license https://www.whmcs.com/license/ WHMCS Eula
 */

jQuery(document).ready(function() {
    const telephoneSharedCountries = new Map([
        ['um', 'us'], // United States Outlying Islands shares dialing code with the US
        ['ic', 'es'], // Canary Islands shares dialing code with Spain
        ['gs', 'fk'], // South Georgia and Sandwich Islands shares dialing code with Falkland Islands
        ['aq', 'nf'], // Antarctica shares dialing code with Norfolk Island
        ['tf', 're'], // French Southern Territories shares dialing code with Réunion (La Réunion)
        ['hm', 'nf'], // Heard Island and Mcdonald Islands shares dialing code with Norfolk Island
        ['an', 'bq'], // Netherlands Antilles shares dialing code with Caribbean Netherlands
        ['pn', 'nz'], // Pitcairn shares dialing code with New Zealand
    ]);

    function assertTelephoneCountry(country) {
        country = country.toLowerCase();
        if (telephoneSharedCountries.has(country)) {
            return telephoneSharedCountries.get(country);
        }
        return country;
    }

    if (typeof customCountryData !== "undefined") {
        var teleCountryData = $.fn['intlTelInput'].getCountryData();
        for (var code in customCountryData) {
            if (customCountryData.hasOwnProperty(code)) {
                var countryDetails = customCountryData[code];
                codeLower = code.toLowerCase();
                if (countryDetails === false) {
                    for (var i = 0; i < teleCountryData.length; i++) {
                        if (codeLower === teleCountryData[i].iso2) {
                            teleCountryData.splice(i, 1);
                            break;
                        }
                    }
                } else {
                    teleCountryData.push(
                        {
                            name: countryDetails.name,
                            iso2: codeLower,
                            dialCode: countryDetails.callingCode,
                            priority: 0,
                            areaCodes: null
                        }
                    );
                }
            }
        }
    }

    if (jQuery('body').data('phone-cc-input')) {
        var phoneInput = jQuery('input[name^="phone"], input[name$="phone"], input[name="domaincontactphonenumber"]').not('input[type="hidden"]');
        if (phoneInput.length) {
            var countryInput = jQuery('[name^="country"], [name$="country"]'),
                initialCountry = 'us';
            if (countryInput.length) {
                initialCountry = assertTelephoneCountry(countryInput.val());
            }

            phoneInput.each(function(){
                var thisInput = jQuery(this),
                    inputName = thisInput.attr('name');
                if (inputName === 'domaincontactphonenumber') {
                    initialCountry = jQuery('[name="domaincontactcountry"]').val().toLowerCase();
                }
                jQuery(this).before(
                    '<input id="populatedCountryCode' + inputName + '" type="hidden" name="country-calling-code-' + inputName + '" value="" />'
                );
                try {
                    thisInput.intlTelInput({
                        preferredCountries: [initialCountry, "us", "gb"].filter(function (value, index, self) {
                            return self.indexOf(value) === index;
                        }),
                        initialCountry: initialCountry,
                        autoPlaceholder: 'polite', //always show the helper placeholder
                        separateDialCode: true
                    });
                } catch (error) {
                    console.log(error.message);
                    return false;
                }

                thisInput.on('countrychange', function (e, countryData) {
                    jQuery('#populatedCountryCode' + inputName).val(countryData.dialCode);
                    if (jQuery(this).val() === '+' + countryData.dialCode) {
                        jQuery(this).val('');
                    }
                });
                thisInput.on('blur keydown', function (e) {
                    if (e.type === 'blur' || (e.type === 'keydown' && e.keyCode === 13)) {
                        var number = jQuery(this).intlTelInput("getNumber"),
                            countryData = jQuery(this).intlTelInput("getSelectedCountryData"),
                            countryPrefix = '+' + countryData.dialCode;

                        if (number.indexOf(countryPrefix) === 0 && (number.match(/\+/g) || []).length > 1) {
                            number = number.substr(countryPrefix.length);
                        }
                        jQuery(this).intlTelInput("setNumber", number);
                    }
                });
                jQuery('#populatedCountryCode' + inputName).val(thisInput.intlTelInput('getSelectedCountryData').dialCode);

                countryInput.on('change', function() {
                    if (thisInput.val() === '') {
                        var country = assertTelephoneCountry(jQuery(this).val());
                        try {
                            phoneInput.intlTelInput('setCountry', country);
                        } catch (error) {
                            console.log(error.message);
                            return false;
                        }
                    }
                });

                // this must be .attr (not .data) in order for it to be found by [data-initial-value] selector
                thisInput.attr('data-initial-value', $(thisInput).val());

                thisInput.parents('form').find('input[type=reset]').each(function() {
                    var resetButton = this;
                    var form = $(resetButton).parents('form');

                    if (!$(resetButton).data('phone-handler')) {
                        $(resetButton).data('phone-handler', true);

                        $(resetButton).click(function(e) {
                            e.stopPropagation();

                            $(form).trigger('reset');

                            $(form).find('input[data-initial-value]').each(function() {
                                var inputToReset = this;

                                $(inputToReset).val(
                                    $(inputToReset).attr('data-initial-value')
                                );
                            });

                            return false;
                        });
                    }
                });
            });

            /**
             * In places where a form icon is present, hide it.
             * Where the input has a class of field, remove that and add form-control in place.
             */
            phoneInput.parents('div.form-group').find('.field-icon').hide().end();
            phoneInput.removeClass('field').addClass('form-control');
        }

        var registrarPhoneInput = jQuery('input[name$="][Phone Number]"], input[name$="][Phone]"]').not('input[type="hidden"]');
        if (registrarPhoneInput.length) {
            jQuery.each(registrarPhoneInput, function(index, input) {
                var thisInput = jQuery(this),
                    inputName = thisInput.attr('name');
                inputName = inputName.replace('contactdetails[', '').replace('][Phone Number]', '').replace('][Phone]', '');

                var countryInput = jQuery('[name$="' + inputName + '][Country]"]'),
                    initialCountry = assertTelephoneCountry(countryInput.val());

                thisInput.before('<input id="populated' + inputName + 'CountryCode" class="' + inputName + 'customwhois" type="hidden" name="contactdetails[' + inputName + '][Phone Country Code]" value="" />');
                thisInput.intlTelInput({
                    preferredCountries: [initialCountry, "us", "gb"].filter(function(value, index, self) {
                        return self.indexOf(value) === index;
                    }),
                    initialCountry: initialCountry,
                    autoPlaceholder: 'polite', //always show the helper placeholder
                    separateDialCode: true
                });

                thisInput.on('countrychange', function (e, countryData) {
                    jQuery('#populated' + inputName + 'CountryCode').val(countryData.dialCode);
                    if (jQuery(this).val() === '+' + countryData.dialCode) {
                        jQuery(this).val('');
                    }
                });
                thisInput.on('blur keydown', function (e) {
                    if (e.type === 'blur' || (e.type === 'keydown' && e.keyCode === 13)) {
                        var number = jQuery(this).intlTelInput("getNumber"),
                            countryData = jQuery(this).intlTelInput("getSelectedCountryData"),
                            countryPrefix = '+' + countryData.dialCode;

                        if (number.indexOf(countryPrefix) === 0 && (number.match(/\+/g) || []).length > 1) {
                            number = number.substr(countryPrefix.length);
                        }
                        jQuery(this).intlTelInput("setNumber", number);
                    }
                });
                jQuery('#populated' + inputName + 'CountryCode').val(thisInput.intlTelInput('getSelectedCountryData').dialCode);

                countryInput.on('blur', function() {
                    if (thisInput.val() === '') {
                        var country = assertTelephoneCountry(jQuery(this).val());
                        thisInput.intlTelInput('setCountry', country);
                    }
                });

            });
        }
    }
});
