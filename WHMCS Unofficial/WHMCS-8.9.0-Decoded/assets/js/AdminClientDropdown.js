/*!
 * WHMCS Dynamic Client Dropdown Library
 *
 * Based upon Selectize.js
 *
 * @copyright Copyright (c) WHMCS Limited 2005-2015
 * @license http://www.whmcs.com/license/ WHMCS Eula
 */

$(document).ready(function(){
    if (typeof WHMCS.selectize !== "undefined") {
        jQuery('.selectize-client-search').data('search-url', getClientSearchPostUrl());
        WHMCS.selectize.clientSearch();
    } else {
        var clientDropdown = jQuery(".selectize-client-search");

        var clientSearchSelectize = clientDropdown.selectize(
            {
                plugins: ['whmcs_no_results'],
                valueField: clientDropdown.data('value-field'),
                labelField: 'name',
                searchField: ['name', 'email', 'companyname'],
                create: false,
                maxItems: 1,
                preload: 'focus',
                optgroupField: 'status',
                optgroupLabelField: 'name',
                optgroupValueField: 'id',
                optgroups: [
                    {$order: 1, id: 'active', name: clientDropdown.data('active-label')},
                    {$order: 2, id: 'inactive', name: clientDropdown.data('inactive-label')}
                ],
                render: {
                    item: function (item, escape) {
                        if (typeof dropdownSelectClient == "function") {
                            dropdownSelectClient(
                                escape(item.id),
                                escape(item.name) + (item.companyname ? ' (' + escape(item.companyname) + ')' : '') +
                                (item.id > 0 ? ' - #' + escape(item.id) : ''),
                                escape(item.email)
                            );
                        }
                        return '<div><span class="name">' + escape(item.name) +
                            (item.companyname ? ' (' + escape(item.companyname) + ')' : '') +
                            (item.id > 0 ? ' - #' + escape(item.id) : '') + '</span></div>';
                    },
                    option: function (item, escape) {
                        return '<div><span class="name">'
                            + escape(item.name) + (item.companyname ? ' (' + escape(item.companyname) + ')' : '')
                            + (item.id > 0 ? ' - #' + escape(item.id) : '') + '</span>' +
                            (item.email ? '<span class="email">' + escape(item.email) + '</span>' : '') + '</div>';
                    }
                },
                load: function (query, callback) {
                    jQuery.ajax({
                        url: getClientSearchPostUrl(),
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            dropdownsearchq: query,
                            clientId: currentValue
                        },
                        error: function () {
                            callback();
                        },
                        success: function (res) {
                            callback(res);
                        }
                    });
                },
                score: function(search) {
                    var score = this.getScoreFunction(search);
                    return function(item) {
                        var thisScore = score(item);
                        if (thisScore && item.status === 'inactive') {
                            thisScore = 0.0000001;
                        }
                        return thisScore;
                    };
                },
                onChange: function (value) {
                    if (jQuery('#goButton').length) {
                        if (value.length && value != currentValue) {
                            jQuery('#goButton').click();
                        }
                    }
                },
                onFocus: function () {
                    currentValue = clientSearchSelectize.getValue();
                    clientSearchSelectize.clear();
                },
                onBlur: function () {
                    if (clientSearchSelectize.getValue() == '' || clientSearchSelectize.getValue() < 1) {
                        clientSearchSelectize.setValue(currentValue);
                    }
                }
            });
        var currentValue = '';

        if (clientSearchSelectize.length) {
            /**
             * selectize assigns any items to an array. In order to be able to run additional
             * functions on this (like auto-submit and clear).
             *
             * @link https://github.com/brianreavis/selectize.js/blob/master/examples/api.html
             */
            clientSearchSelectize = clientSearchSelectize[0].selectize;
        }
    }
});
