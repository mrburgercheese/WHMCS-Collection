/*!
 * DateRangePicker Javascript.
 *
 * @copyright Copyright (c) WHMCS Limited 2005-2019
 * @license http://www.whmcs.com/license/ WHMCS Eula
 */
function initDateRangePicker()
{
    jQuery(document).ready(function () {
        // Date range picker.

        jQuery('.date-picker-search').each(function (index) {
            var self = jQuery(this),
                opens = self.data('opens'),
                drops = self.data('drops'),
                range = adminJsVars.dateRangePicker.defaultRanges,
                format = adminJsVars.dateRangeFormat;
            if (!opens || typeof opens === "undefined") {
                opens = 'center';
            }
            if (!drops || typeof drops === "undefined") {
                drops = 'down';
            }
            if (self.hasClass('future')) {
                range = adminJsVars.dateRangePicker.futureRanges;
            }
            self.daterangepicker({
                autoUpdateInput: false,
                ranges: range,
                alwaysShowCalendars: true,
                opens: opens,
                drops: drops,
                showDropdowns: true,
                minYear: adminJsVars.minYear,
                maxYear: adminJsVars.maxYear,
                locale: {
                    format: format,
                    applyLabel: adminJsVars.dateRangePicker.applyLabel,
                    cancelLabel: adminJsVars.dateRangePicker.cancelLabel,
                    customRangeLabel: adminJsVars.dateRangePicker.customRangeLabel,
                    monthNames: adminJsVars.dateRangePicker.months,
                    daysOfWeek: adminJsVars.dateRangePicker.daysOfWeek
                }
            }).on('apply.daterangepicker', function (ev, picker) {
                jQuery(this).val(picker.startDate.format(adminJsVars.dateRangeFormat)
                    + ' - ' + picker.endDate.format(adminJsVars.dateRangeFormat));
            }).on('cancel.daterangepicker', function (ev, picker) {
                jQuery(this).val('');
            });
        });

        jQuery('.datepick,.date-picker,.date-picker-single').each(function (index) {
            var self = jQuery(this),
                opens = self.data('opens'),
                drops = self.data('drops'),
                range = adminJsVars.dateRangePicker.defaultSingleRanges,
                format = adminJsVars.dateRangeFormat,
                time = false;
            if (!opens || typeof opens === "undefined") {
                opens = 'center';
            }
            if (!drops || typeof drops === "undefined") {
                drops = 'down';
            }
            if (self.hasClass('future')) {
                range = adminJsVars.dateRangePicker.futureSingleRanges;
            }
            if (self.hasClass('time')) {
                time = true;
                format = adminJsVars.dateTimeRangeFormat;
                if (self.hasClass('future')) {
                    range = adminJsVars.dateRangePicker.futureTimeSingleRanges;
                }
            }
            /**
             * Use Date to check if valid; if valid, make sure to transform it
             * using UTC timezone and set it as Start Date for date picker.
             * If not (when date is empty or is 0000-00-00), use today's date instead.
             * This requires the use of the "data-original-value" param
             * within the input tag and leave its mysql date format intact
             */
            var startDate;
            try {
                startDate = new Date(self.data('original-value'));
                if (startDate instanceof Date && !isNaN(startDate.getTime())) {
                    /**
                     * Using UTC timezone to override date to make sure date like 07/17/2015
                     * does not show as 07/16/2015 due to timezone different
                     */
                    startDate.setDate(startDate.getUTCDate());
                } else {
                    throw new Error("Date is Invalid");
                }
            } catch (err) {
                startDate = new Date();
            }

            self.daterangepicker({
                singleDatePicker: true,
                autoUpdateInput: false,
                ranges: range,
                alwaysShowCalendars: true,
                opens: opens,
                drops: drops,
                showDropdowns: true,
                minYear: adminJsVars.minYear,
                maxYear: adminJsVars.maxYear,
                timePicker: time,
                startDate: startDate,
                timePickerSeconds: false,
                locale: {
                    format: format,
                    customRangeLabel: adminJsVars.dateRangePicker.customRangeLabel,
                    monthNames: adminJsVars.dateRangePicker.months,
                    daysOfWeek: adminJsVars.dateRangePicker.daysOfWeek
                }
            }).on('apply.daterangepicker', function (ev, picker) {
                jQuery(this).data(
                    'original-value',
                    picker.startDate.format(format)
                )
                    .val(picker.startDate.format(format));
            }).on('cancel.daterangepicker', function (ev, picker) {
                jQuery(this).val(jQuery(this).data('original-value'));
            });
        });
    });
}
initDateRangePicker();
