/**
 * Selectize module
 *
 * Most basic usage:
 *  `WHMCS.selectize.register('#mySelect');`
 *    - This will selectize the <select id="mySelect"></select>.  See
 *      .register() for more specifics.
 *
 * Pre-made usage:
 *  `WHMCS.selectize.clientSearch();`
 *    - selectize all '.selectize-client-search'
 *
 *  `WHMCS.selectize.users(selector, options)`
 *    - selectize a given selector with a static array of options (user objects)
 *
 */
(function(module) {
    if (!WHMCS.hasModule('selectize')) {
        WHMCS.loadModule('selectize', module);
    }
})(
function () {
    /**
     * Search-on-type client select & click "#goButton" on 'change' event
     * - will bind to <select> with '.selectize-client-search'
     * - <select> needs data-search-url attribute for 'load' event
     *
     * @returns {Selectize}
     */
    this.clientSearch = function () {
        var itemDecorator = function(item, escape) {
            if (typeof dropdownSelectClient === "function") {
                if (jQuery(".selectize-dropdown-content > div").length === 0) {
                    // updates DOM for admin/supporttickets.php
                    dropdownSelectClient(
                        escape(item.id),
                        escape(item.name)
                        + (item.companyname ? ' (' + escape(item.companyname) + ')' : '')
                        + (item.id > 0 ? ' - #' + escape(item.id) : ''),
                        escape(item.email)
                    );
                }
            }
            return '<div class="client-name"><span class="name">' + escape(item.name) +
                (item.companyname ? ' (' + escape(item.companyname) + ')' : '')  +
                (item.id > 0 ? ' - #' + escape(item.id) : '') + '</span></div>';
        };

        var selector ='.selectize-client-search';
        var selectElement = jQuery(selector);

        var module = this;
        var selectized = [];
        selectElement.each(function (){
            var element = $(this);
            var configuration = {
                'valueField': element.data('value-field'),
                allowEmptyOption: (element.data('allow-empty-option') === 1),
                'labelField': 'name', //legacy? shouldn't be required with render
                'render': {
                    item: itemDecorator
                },
                optgroupField: 'status',
                optgroupLabelField: 'name',
                optgroupValueField: 'id',
                optgroups: [
                    {$order: 1, id: 'active', name: element.data('active-label')},
                    {$order: 2, id: 'inactive', name: element.data('inactive-label')}
                ],
                'load': module.builder.onLoadEvent(
                    element.data('search-url'),
                    function (query) {
                        return {
                            dropdownsearchq: query,
                            clientId: instance.currentValue,
                            showNoneOption: (element.data('allow-empty-option') === 1),
                        };
                    }
                ),
                'onChange': function(value) {
                    // Updates DOM for admin/supporttickets.php
                    if (value && typeof dropdownSelectClient === 'function') {
                        value = parseInt(value);
                        var newSelection = jQuery(".selectize-dropdown-content div[data-value|='" + value + "']");
                        dropdownSelectClient(
                            value,
                            newSelection.children("span.name").text(),
                            newSelection.children("span.email").text()
                        );
                    }
                }
            };

            var instance = module.clients(element, undefined, configuration);

            instance.on('change', module.builder.onChangeEvent(instance, '#goButton'));

            return selectized.push(instance);
        });

        if (selectized.length > 1) {
            return selectized;
        }

        return selectized[0];

    };

    this.userSearch = function () {
        var itemDecorator = function(item, escape) {
            var idAppend = '',
                isNumeric = !isNaN(item.id);

            if (isNumeric && item.id > 0) {
                idAppend = ' - #' + escape(item.id);
            }
            return '<div><span class="name">' + escape(item.name) + idAppend + '</span></div>';
        };

        var selector ='.selectize-user-search';
        var selectElement = jQuery(selector);

        var module = this;
        var selectized = [];
        selectElement.each(function (){
            var element = $(this);
            var configuration = {
                'valueField': element.data('value-field'),
                'labelField': 'name',
                'render': {
                    item: itemDecorator
                },
                'preload': false,
                'load': module.builder.onLoadEvent(
                    element.data('search-url'),
                    function (query) {
                        return {
                            token: csrfToken,
                            search: query
                        };
                    }
                )
            };

            var instance = module.users(selector, undefined, configuration);

            return selectized.push(instance);
        });

        if (selectized.length > 1) {
            return selectized;
        }

        return selectized[0];

    };

    this.serviceSearch = function () {
        var itemDecorator = function(item) {
            var newDiv = $('<div>');
            if (item.color) {
                newDiv.css('background-color', item.color);
            }
            newDiv.append(
                $('<span>').attr('class', 'name').text(item.name)
            )
            return newDiv;
        };

        var selector ='.selectize-service-search';
        var selectElement = jQuery(selector);

        var module = this;
        var selectized = [];
        selectElement.each(function (){
            var element = $(this);
            var configuration = {
                'valueField': 'id',
                'labelField': 'name',
                'render': {
                    item: itemDecorator
                },
                'preload': true,
                'load': module.builder.onLoadEvent(
                    element.data('search-url'),
                    function (query) {
                        return {
                            token: csrfToken,
                            search: query
                        };
                    }
                )
            };

            var instance = module.services(selector, undefined, configuration);

            return selectized.push(instance);
        });

        if (selectized.length > 1) {
            return selectized;
        }

        return selectized[0];
    };

    this.productSearch = function() {
        var selector = '.selectize-product-search',
            selectElement = jQuery(selector),
            module = this,
            selectized = [],
            itemDecorator = function(data, escape) {
                var newDiv = jQuery('<div>'),
                    newSpan = jQuery('<span>').attr('class', 'name').text(escape(data.name));
                newDiv.append(newSpan);
                return newDiv;
            };

        selectElement.each(function() {
            var element = jQuery(this),
                configuration = {
                    'valueField': 'id',
                    'labelField': 'name',
                    'render': {
                        item: itemDecorator
                    },
                    optgroupField: 'groupid',
                    optgroupLabelField: 'name',
                    optgroupValueField: 'id',
                    'preload': true,
                    'load': module.builder.onLoadEvent(
                        element.data('search-url'),
                        function (query) {
                            return {
                                token: csrfToken,
                                search: query,
                            };
                        }
                    ),
                    'onLoad': function(data) {
                        var instance = this,
                            listItems = jQuery('.product-recommendations-wrapper li');
                        data.forEach(function(item) {
                            if (listItems.find('input[value="' + item.id + '"]').length) {
                                instance.removeOption(item.id);
                                return;
                            }
                            instance.addOptionGroup(item.groupid, {
                                $order: item.order,
                                name: item.group,
                            });
                        });
                    },
                    'onBlur': function() {
                        this.clear();
                    },
                    'onItemAdd': function(value) {
                        var listItems = jQuery('.product-recommendations-wrapper li'),
                            existingItems = listItems.find('input[value="' + value + '"]').length,
                            recommendationAlert = jQuery('div.recommendation-alert'),
                            isChanged = false;
                        if (value && existingItems < 1) {
                            var newSelection = jQuery(".selectize-dropdown-content div[data-value|='" + value + "']"),
                                clonableItem = jQuery('.product-recommendations-wrapper .clonable-item'),
                                parentList = clonableItem.closest('ul'),
                                clonedItem = clonableItem.clone().removeClass('hidden clonable-item');
                            clonedItem.find('a span.recommendation-name').text(
                                newSelection.siblings('div.optgroup-header').text() +
                                ' - ' +
                                newSelection.children("span.name").text()
                            );
                            jQuery('<input>').attr({
                                type: 'hidden',
                                name: 'productRecommendations[]',
                                value: value
                            }).appendTo(clonedItem);
                            clonedItem.find('input').val(value);
                            clonedItem.appendTo(parentList);
                            instance.removeOption(value);
                            isChanged = true;
                        }
                        if (listItems.length > 0) {
                            jQuery('.product-recommendations-wrapper .placeholder-list-item').addClass('hidden');
                            isChanged = true;
                        }
                        if (isChanged && recommendationAlert.not(':visible')) {
                            jQuery('.recommendation-alert').removeClass('hidden');
                        }
                    }
                },
                instance = module.products(selector, undefined, configuration);

            return selectized.push(instance);
        });

        if (selectized.length > 1) {
            return selectized;
        }

        return selectized[0];
    };

    /**
     * Generic selectize of users
     *  - no 'change' or 'load' events
     *
     * @param selector
     * @param options
     * @param configuration
     * @returns {Selectize}
     */
    this.clients = function (selector, options, configuration) {
        var instance = this.register(
            selector,
            options,
            WHMCS.selectize.optionDecorator.client,
            configuration
        );

        instance.settings.searchField = ['name', 'email', 'companyname'];

        return instance;
    };

    this.users = function (selector, options, configuration) {
        var instance = this.register(
            selector,
            options,
            WHMCS.selectize.optionDecorator.user,
            configuration
        );

        instance.settings.searchField = ['name', 'email'];

        return instance;
    };

    this.services = function (selector, options, configuration) {
        var instance = this.register(
            selector,
            options,
            WHMCS.selectize.optionDecorator.service,
            configuration
        );

        instance.settings.searchField = ['name', 'noResults'];

        return instance;
    };

    this.billingContacts = function (selector, options, configuration) {
        var instance = this.register(
            selector,
            options,
            WHMCS.selectize.optionDecorator.billingContact,
            configuration
        );

        instance.settings.searchField = ['name', 'email', 'companyname', 'address'];

        return instance;
    };

    this.payMethods = function (selector, options, configuration) {
        var instance = this.register(
            selector,
            options,
            WHMCS.selectize.optionDecorator.payMethod,
            configuration
        );

        instance.settings.searchField = ['description', 'shortAccountNumber', 'type', 'payMethodType'];

        return instance;
    };

    this.products = function (selector, options, configuration) {
        var instance = this.register(
            selector,
            options,
            WHMCS.selectize.optionDecorator.product,
            configuration
        );

        instance.settings.searchField = ['id', 'name', 'noResults'];

        return instance;
    };

    this.html = function (selector, options, configuration) {
        var instance = this.register(
            selector,
            options,
            function(item, escape) {
                return '<div class="item">' + item.html + '</div>';
            },
            configuration
        );

        instance.settings.searchField = ['html'];

        return instance;
    };

    this.simple = function (selector, options, configuration) {
        var instance = this.register(
            selector,
            options,
            function(item, escape) {
                return '<div class="item">' + item.value + '</div>';
            },
            configuration
        );

        instance.settings.searchField = ['value'];

        return instance;
    };
    /**
     * Arguments:
     * selector
     *   CSS selector of the <select> element to selectize
     *
     * options
     *   The second argument is a JS array of objects that will be decorated
     *   into <option>s.
     *
     * decorator
     *   The third argument is the option decorator. By default, it will
     *   decorate using the userDecorator.  Value can be a global function,
     *   lambda, or fq function.  This argument will _not_ be applied when
     *   configuration supplies the .render.item or .render.option properties
     *
     * configuration
     *   configuration settings to use during Selectize initialization
     *
     *
     * Some Assumptions & Default settings:
     * settings.valueField and settings.labelField
     *   These are set to 'id' by default; change as needed
     *
     * settings.searchField
     *   Is empty by default; change as needed
     *
     * option and item decoration
     *   this.optionDecorator.user will be applied by default if nothing is
     *   supplied (by means of the decorator arg or within the configuration arg)
     *
     * @copyright Copyright (c) WHMCS Limited 2005-2018
     * @license http://www.whmcs.com/license/ WHMCS Eula
     */
    this.register = function (selector, options, decorator, configuration) {
        var self = this;
        var element = jQuery(selector);

        var instance = self.builder.init(element, configuration);

        // add item & option decorator if not provided in configuration
        var itemDecorator = self.builder.itemDecorator(decorator);
        if (typeof configuration === "undefined") {
            instance.settings.render.item = itemDecorator;
            instance.settings.render.option = itemDecorator;
        } else if (typeof configuration.render === "undefined") {
            instance.settings.render.item = itemDecorator;
            instance.settings.render.option = itemDecorator;
        } else {
            if (typeof configuration.render.item === "undefined") {
                instance.settings.render.item = itemDecorator;
            }
            if (typeof configuration.render.option === "undefined") {
                instance.settings.render.option = itemDecorator;
            }
        }

        this.builder.addOptions(instance, options);


        return instance;
    };

    this.optionDecorator = {
        client: function(item, escape) {
            var name = escape(item.name),
                companyname = '',
                descriptor = '',
                email = '';

            if (item.companyname) {
                companyname = ' (' + escape(item.companyname) + ')';
            }

            if (typeof item.descriptor === "undefined") {
                descriptor = (item.id > 0 ? ' - #' + escape(item.id) : '');
            } else {
                descriptor = escape(item.descriptor);
            }

            if (item.email) {
                email = '<span class="email">' + escape(item.email) + '</span>';
            }

            return '<div>'
                + '<span class="name">' + name + companyname + descriptor + '</span>'
                + email
                + '</div>';
        },
        user: function(item, escape) {
            var name = escape(item.name),
                descriptor = '',
                email = '',
                isNumericId = !isNaN(item.id);

            if (typeof item.descriptor === "undefined") {
                descriptor = (isNumericId && item.id > 0 ? ' - #' + escape(item.id) : '');
            } else {
                descriptor = escape(item.descriptor);
            }

            if (isNumericId && item.id > 0 && item.email) {
                email = '<span class="email">' + escape(item.email) + '</span>';
            }

            return '<div>'
                + '<span class="name">' + name + descriptor + '</span>'
                + email
                + '</div>';
        },
        billingContact: function(item, escape) {
            var name = escape(item.name),
                companyname = '',
                descriptor = '',
                email = '',
                address = '';

            if (item.companyname) {
                companyname = ' (' + escape(item.companyname) + ')';
            }

            if (typeof item.descriptor === "undefined") {
                descriptor = (item.id > 0 ? ' - #' + escape(item.id) : '');
            } else {
                descriptor = escape(item.descriptor);
            }

            if (item.email) {
                email = '<span class="email">' + escape(item.email) + '</span>';
            }

            if (item.address) {
                address = '<span class="email">' + escape(item.address) + '</span>';
            }

            return '<div>'
                + '<span class="name">' + name + companyname + descriptor + '</span>'
                + email
                + address
                + '</div>';
        },
        payMethod: function(item, escape) {
            var brandIcon = '',
                description = '',
                isDefault = '',
                shortAccountNumber = '',
                detail1 = '';

            if (item.brandIcon) {
                brandIcon = '<i class="' + item.brandIcon + '"></i>';
            }
            if (item.isDefault) {
                isDefault = '&nbsp;&nbsp;<i class="fal fa-user-check"></i>';
            }

            if (item.description) {
                description = item.description;
            }
            if (item.shortAccountNumber) {
                if (description.indexOf(item.shortAccountNumber) === -1) {
                    shortAccountNumber = '(' + escape(item.shortAccountNumber) + ')';
                }
            }

            if (item.detail1) {
                detail1 = '<span class="mouse">' + escape(item.detail1) + '</span>';
            }

            return '<div>'
                + '<span class="name"> '
                + brandIcon + '&nbsp;'
                + description + '&nbsp;'
                + shortAccountNumber + '&nbsp;'
                + '&nbsp;&nbsp;' + detail1 + '&nbsp;&nbsp;'
                + isDefault
                + '</span>'
                + '</div>';
        },
        service: function (item, escape) {
            var color = '';
            if (item.color) {
                color = ' style="background-color: ' + item.color + ';"';
            }
            return '<div' + color + '><span class="name">' + escape(item.name) + '</span>'
                 + (item.noResults ? '<span class="email">' + escape(item.noResults) + '</span>' : '') +
                '</div>';
        },
        product: function (item, escape) {
            return '<div><span class="name">' + escape(item.name) + '</span>'
                + (item.noResults ? '<span class="email">' + escape(item.noResults) + '</span>' : '') +
                '</div>';
        }
    };
    this.builder = {
        init: function (element, configuration)
        {
            var merged,
                defaults = {
                    plugins: ['whmcs_no_results'],
                    valueField: 'id',
                    labelField: 'id',
                    create: false,
                    maxItems: 1,
                    preload: 'focus'
                };

            if (typeof configuration === "undefined") {
                configuration = {};
            }
            merged = jQuery.extend({}, defaults, configuration);

            var thisSelectize = element.selectize(merged);
            /**
             * selectize assigns any items to an array. In order to be able to
             * run additional functions on this (like auto-submit and clear).
             *
             * @link https://github.com/brianreavis/selectize.js/blob/master/examples/api.html
             */
            thisSelectize = thisSelectize[0].selectize;

            thisSelectize.currentValue = '';

            thisSelectize.on('focus', function () {
                thisSelectize.currentValue = thisSelectize.getValue();
                thisSelectize.clear();
            });
            thisSelectize.on('blur', function () {
                var thisValue = thisSelectize.getValue(),
                    isNumeric = !(isNaN(thisValue)),
                    minValue = 1;
                if (element.data('allow-empty-option') === 1) {
                    minValue = 0;
                }
                if (
                    thisValue === ''
                    || (isNumeric && (thisValue < minValue))
                ) {
                    thisSelectize.setValue(thisSelectize.currentValue);
                }
            });

            return thisSelectize;
        },
        addOptions: function (selectize, options) {
            if (typeof options !== "undefined" && options.length) {
                selectize.addOption(options);
            }
        },
        itemDecorator: function (decorator) {
            if (typeof decorator === "function") {
                return decorator;
            } else if (typeof decorator === "undefined") {
                return WHMCS.selectize.optionDecorator.user;
            }
        },
        onLoadEvent: function (searchUrl, dataCallback) {
            return function (query, callback) {
                jQuery.ajax({
                    url: searchUrl,
                    type: 'POST',
                    dataType: 'json',
                    data: dataCallback(query),
                    error: function () {
                        callback();
                    },
                    success: function (res) {
                        callback(res);
                    }
                });
            };
        },
        onChangeEvent: function (instance, onChangeSelector) {
            var onChange;
            if (typeof onChangeSelector !== "undefined") {
                onChange = function (value) {
                    var changeSelector = jQuery(onChangeSelector);
                    if (changeSelector.length) {
                        if (
                            !(isNaN(instance.currentValue))
                            && instance.currentValue > 0
                            && (value.length && value !== instance.currentValue)
                        ) {
                            changeSelector.click();
                        }
                    }
                }
            }

            return onChange;
        }
    };

    return this;
});
