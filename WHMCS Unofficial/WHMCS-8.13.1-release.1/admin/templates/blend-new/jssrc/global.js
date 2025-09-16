var blendGlobal = {
    refs: {
        frmNotes: '#frmMyNotes',
        modalNotes: '#modalMyNotes',
    },

    init: function() {
        var self = blendGlobal;

        // My Notes
        $(self.refs.frmNotes).submit(function(e) {
            e.preventDefault();
            $(self.refs.modalNotes).modal('hide');
            WHMCS.http.jqClient.post(
                $(this).attr('action'),
                $(this).serialize()
            );
        });

        // Modal auto focus on submit or first visible input
        $('div.modal').on('shown.bs.modal', function() {
            var inputs = jQuery(this).find('input:not(input[type=checkbox],' +
                'input[type=radio],input[type=hidden]),button.btn-primary');

            if (inputs.length > 0) {
                $(inputs).first().focus();
            }
        });

        // Init Lightbox2
        lightbox.init();
    }
};

$(document).ready(blendGlobal.init);
