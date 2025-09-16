var blendClientLimits = {
    refs: {
        primary: '#clientLimitNotification',
        form: '#clientLimitNotification form',
        dismiss: '#btnClientLimitNotificationDismiss',
        dontshow: '#btnClientLimitNotificationDontShowAgain',
    },

    init: function() {
        var self = blendClientLimits;

        $(self.refs.form).submit(function(e) {
            e.preventDefault();
            self.go($(this));
        });

        $(self.refs.dismiss).click(function(e) {
            e.preventDefault();
            self.dismiss('clientlimitdismiss');
        });

        $(self.refs.dontshow).click(function(e) {
            e.preventDefault();
            self.dismiss('clientlimitdontshowagain');
        });
    },

    dismiss: function(dismissType) {
        $(this.refs.primary).fadeOut();
        WHMCS.http.jqClient.post(window.location.href, dismissType + '=1&name=' + $(this.refs.primary).find('.panel-title span').html());
    },

    go: function(el) {
        var $fetchUrl = el.data('fetchUrl');
        var $submit = el.find('button[type="submit"]');
        var $submitLabel = $submit.html();
        $submit.css('width', $submit.css('width')).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
        WHMCS.http.jqClient.post($fetchUrl, el.serialize(),
            function(data) {
                el.find('.input-license-key').val(data.license_key);
                el.find('.input-member-data').val(data.member_data);
                el.off('submit').submit();
                $submit.html($submitLabel).removeProp('disabled');
            }, 'json');
    }
};

$(document).ready(blendClientLimits.init);
