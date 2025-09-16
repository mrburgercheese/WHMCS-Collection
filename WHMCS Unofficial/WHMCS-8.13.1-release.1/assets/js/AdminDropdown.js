/*!
 * WHMCS Dynamic Dropdown Library
 *
 * Based upon Selectize.js
 *
 * @copyright Copyright (c) WHMCS Limited 2005-2016
 * @license http://www.whmcs.com/license/ WHMCS Eula
 */

jQuery(document).ready(
    function()
    {
        var multiSelectize = jQuery('.selectize-multi-select'),
            standardSelectize = jQuery('.selectize-select'),
            promoSelectize = jQuery('.selectize-promo'),
            tags = jQuery('.selectize-tags'),
            newTicketCC = jQuery('.selectize-newTicketCc,.selectize-ticketCc');

        jQuery(multiSelectize).selectize(
            {
                plugins: ['remove_button'],
                valueField: jQuery(multiSelectize).attr('data-value-field'),
                labelField: 'name',
                searchField: 'name',
                allowEmptyOption: true,
                create: false,
                maxItems: null,
                render: {
                    item: function(item, escape) {
                        return '<div><span class="name">' + escape(item.name) + '</span></div>';
                    },
                    option: function(item, escape) {
                        return '<div><span class="name">' + escape(item.name) + '</span></div>';
                    }
                },
                onItemRemove: function(value) {
                    if (jQuery(this)[0].$input[0].id == 'multi-view' && value != 'any' && value != 'flagged') {
                        jQuery(this)[0].removeItem('any', true);
                    }
                }
            }
        );

        jQuery(standardSelectize).selectize(
            {
                valueField: jQuery(standardSelectize).attr('data-value-field'),
                labelField: 'name',
                searchField: 'name',
                allowEmptyOption: jQuery(standardSelectize).attr('data-allow-empty-option'),
                create: false,
                maxItems: 1,
                render: {
                    item: function(item, escape) {
                        var colour = '';
                        if (typeof item.colour !== 'undefined' && item.colour !== '#FFF') {
                            colour = ' style="background-color: ' + escape(item.colour) + ';"';
                        }
                        return '<div' + colour + '><span class="name">' + escape(item.name) + '</span></div>';
                    },
                    option: function(item, escape) {
                        var colour = '';
                        if (typeof item.colour !== 'undefined' && item.colour !== '#FFF') {
                            colour = ' style="background-color: ' + escape(item.colour) + ';"';
                        }
                        return '<div' + colour + '><span class="name">' + escape(item.name) + '</span></div>';
                    }
                },
                onInitialize: function () {
                    this.currentValue = '';
                },
                onFocus: function() {
                    this.currentValue = this.getValue();
                    this.clear();
                },
                onChange: function() {
                    if (this.getValue() === '') {
                        return;
                    }

                    if (this.currentValue === this.getValue()) {
                        return;
                    }

                    this.currentValue = this.getValue();

                    if (jQuery(standardSelectize).hasClass('selectize-auto-submit')) {
                        jQuery(standardSelectize).parent('form').submit();
                    }
                },
                onBlur: function() {
                    this.setValue(this.currentValue);
                }
            }
        );

        jQuery(promoSelectize).selectize(
            {
                valueField: jQuery(promoSelectize).attr('data-value-field'),
                labelField: 'name',
                searchField: 'name',
                allowEmptyOption: jQuery(promoSelectize).attr('data-allow-empty-option'),
                create: false,
                maxItems: 1,
                render: {
                    item: function(item, escape) {
                        var colour = '';
                        var promo = item.name.split(' - ');
                        if (typeof item.colour !== 'undefined' && item.colour !== '#FFF' && item.colour !== '') {
                            colour = ' style="background-color: ' + escape(item.colour) + ';"';
                        }
                        if (typeof otherPromos !== 'undefined'
                            && item.optgroup === otherPromos
                            && this.currentValue !== ''
                        ) {
                            jQuery('#nonApplicablePromoWarning').show();
                        } else {
                            jQuery('#nonApplicablePromoWarning').hide();
                        }
                        if (promo[1]) {
                            return '<div' + colour + '>'
                                + '<strong>' + escape(promo[0]) + '</strong>'
                                + '<small style="overflow: hidden"> - ' + escape(promo[1]) + '</small>'
                                + '</div>';
                        } else {
                            return '<div' + colour + '>'
                                + escape(promo[0])
                                + '</div>';
                        }
                    },
                    option: function(item, escape) {
                        var colour = '';
                        var promo = item.name.split(' - ');
                        if (typeof item.colour !== 'undefined' && item.colour !== '#FFF' && item.colour !== '') {
                            colour = ' style="background-color: ' + escape(item.colour) + ';"';
                        }
                        if (promo[1]) {
                            return '<div' + colour + '>'
                                + '<strong>' + escape(promo[0]) + '</strong><br />'
                                + escape(promo[1])
                                + '</div>';
                        } else {
                            return '<div' + colour + '>'
                                + escape(promo[0])
                                + '</div>';
                        }
                    }
                },
                onInitialize: function () {
                    this.currentValue = '';
                },
                onFocus: function() {
                    this.$control.parent('div').css('overflow', 'visible');
                    this.currentValue = this.getValue();
                    this.clear();
                },
                onChange: function() {
                    if (this.getValue() === '') {
                        return;
                    }

                    if (this.currentValue === this.getValue()) {
                        return;
                    }

                    this.currentValue = this.getValue();

                    if (jQuery(promoSelectize).hasClass('selectize-auto-submit')) {
                        jQuery(promoSelectize).parent('form').submit();
                    }
                },
                onBlur: function() {
                    this.$control.parent('div').css('overflow', 'hidden');
                    this.setValue(this.currentValue);
                }
            }
        );

        jQuery(tags).selectize(
            {
                plugins: ['remove_button'],
                valueField: 'text',
                searchField: ['text'],
                delimiter: ',',
                persist: false,
                create: function(input) {
                    return {
                        value: input,
                        text: input
                    }
                },
                render: {
                    item: function(item, escape) {
                        return '<div><span class="item">' + escape(item.text) + '</span></div>';
                    },
                    option: function(item, escape) {
                        return '<div><span class="item">' + escape(item.text) + '</span></div>';
                    }
                },
                load: function(query, callback) {
                    if (!query.length) return callback();
                    jQuery.ajax({
                        url: window.location.href,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            action: 'gettags',
                            q: query,
                            token: csrfToken
                        },
                        error: function() {
                            callback();
                        },
                        success: function(res) {
                            callback(res);
                        }
                    });
                },
                onItemAdd: function (value)
                {
                    jQuery.ajax({
                        url: window.location.href,
                        type: 'POST',
                        data: {
                            action: 'addTag',
                            newTag: value,
                            token: csrfToken
                        }
                    }).success(function() {
                        jQuery.growl.notice({ title: "", message: "Saved successfully!" });
                    });
                },
                onItemRemove: function(value)
                {
                    jQuery.ajax({
                        url: window.location.href,
                        type: 'POST',
                        data: {
                            action: 'removeTag',
                            removeTag: value,
                            token: csrfToken
                        }
                    }).success(function() {
                        jQuery.growl.notice({ title: "", message: "Saved successfully!" });
                    });
                }
            }
        );

        jQuery(newTicketCC).selectize(
            {
                plugins: ['remove_button'],
                valueField: 'text',
                searchField: ['text'],
                delimiter: ',',
                persist: true,
                create: function(input) {
                    input = input.toLowerCase();
                    return {
                        value: input,
                        text: input,
                        name: input,
                        iconclass: ''
                    }
                },
                render: {
                    item: function(item, escape) {
                        var name = '';
                        if (typeof item.iconclass !== 'undefined' && item.iconclass.length > 0) {
                            name = '<span style="padding-right: 8px"><i class="' + escape(item.iconclass) + '"></i></span>'
                            + escape(item.name);
                        } else {
                            name = escape(item.name);
                        }
                        return '<div class="selectize">'
                            + '<span class="name">' + name + '</span>'
                            + '</div>';
                    },
                    option: function(item, escape) {
                        var name = '';
                        if (typeof item.iconclass !== 'undefined' && item.iconclass.length > 0) {
                            name = '<span style="padding-right: 8px"><i class="' + escape(item.iconclass) + '"></i></span>'
                                + escape(item.name);
                        } else {
                            name = escape(item.name);
                        }
                        return '<div class="selectize">'
                            + '<span class="name">' + name + '</span>'
                            + '<span class="email">' + escape(item.text) + '</span>'
                            + '</div>';
                    }
                }
            }
        );
    }
);
