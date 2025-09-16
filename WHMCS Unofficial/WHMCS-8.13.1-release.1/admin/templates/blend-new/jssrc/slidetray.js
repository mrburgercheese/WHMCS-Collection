var blendSlidetray = {
    refs: {
        opener: '*[data-toggle="slide-tray"]',
        close: 'button[data-dismiss="slide-tray"]',
        backdrop: 'slide-tray-backdrop',
        tray: '.slide-tray',
    },

    init: function() {
        var self = blendSlidetray;

        $(self.refs.opener).click(function(e) {
            e.preventDefault();
            var $target = $(this).data('target');
            if (!$('#' + self.refs.backdrop).length) {
                $(document.createElement('div'))
                    .attr('id', self.refs.backdrop)
                    .addClass('modal-backdrop nav-modal-backdrop')
                    .css('opacity', '0.5')
                    .css('position', 'absolute')
                    .css('top', 0)
                    .appendTo('body');
            }
            $('#' + self.refs.backdrop).fadeIn();
            $('html, body').css('overflow', 'hidden');
            $($target).show();
            if ($($target).hasClass('right')) {
                $($target).css('right', $($target).outerWidth() * -1);
                $($target).animate({ right: 0 }, 200);
            } else {
                $($target).css('left', $($target).outerWidth() * -1);
                $($target).animate({ left: 0 }, 200);
            }
        });

        $(self.refs.close).click(function(e) {
            e.preventDefault();
            var $target = $(this).closest(self.refs.tray);
            if ($($target).hasClass('right')) {
                $($target).animate({ right: $($target).outerWidth() * -1 }, 200, function() {
                    $($target).hide();
                    $('#' + self.refs.backdrop).fadeOut('', function() {
                        $('html, body').css('overflow', 'auto');
                    });
                });
            } else {
                $($target).animate({ left: $($target).outerWidth() * -1 }, 200, function() {
                    $($target).hide();
                    $('#' + self.refs.backdrop).fadeOut('', function() {
                        $('html, body').css('overflow', 'auto');
                    });
                });
            }
        });
    }
};

$(document).ready(blendSlidetray.init);
