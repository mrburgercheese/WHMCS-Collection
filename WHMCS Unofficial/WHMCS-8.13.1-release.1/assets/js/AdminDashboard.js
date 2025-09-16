$(document).ready(function(){
    var minimisedWidgets = null;
    if(typeof(Storage) !== "undefined") {
        minimisedWidgets = JSON.parse(localStorage.getItem("minimisedWidgets"));
    }
    if (!minimisedWidgets) {
        minimisedWidgets = [];
    }
    $(".widget-minimise").click(function(e) {
        e.preventDefault();
        var obj = $(this);
        var icon = obj.find('i'),
            widget = obj.closest('.panel').data('widget');
        if (icon.hasClass('fa-chevron-up')) {
            obj.closest('.panel').find('.panel-body').slideUp('fast', function() {
                icon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
                packery.shiftLayout();
            });
            if (minimisedWidgets.indexOf(widget) == -1) {
                minimisedWidgets.push(widget);
            }
        } else {
            obj.closest('.panel').find('.panel-body').slideDown('fast', function(e) {
                icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
                packery.fit(this);
                packery.shiftLayout();
            });
            minimisedWidgets.splice(minimisedWidgets.indexOf(widget), 1);
        }
        if(typeof(Storage) !== "undefined") {
            localStorage.setItem("minimisedWidgets", JSON.stringify(minimisedWidgets));
        }
    });
    $(".widget-refresh").click(function(e) {
        e.preventDefault();
        var obj = $(this);
        var icon = obj.find('i');
        var widget = obj.closest('.panel').data('widget');
        var panelBody = obj.closest('.panel').find('.panel-body');
        icon.addClass('fa-spin');
        refreshWidget(widget, 'refresh=1');
    });
    var completedToggle = false;
    $(".widget-hide").click(function(e) {
        e.preventDefault();
        var obj = $(this),
            widget = obj.closest('.panel').data('widget');
        completedToggle = true;

        $('#panel' + widget).slideUp('fast', function() {
            $(this).addClass('hidden');
            WHMCS.http.jqClient.post(WHMCS.adminUtils.getAdminRouteUrl('/widget/display/toggle/' + widget)).always(function() {
                $('input[data-widget="' + widget + '"]').iCheck('uncheck');
                completedToggle = false;
            });
            $('.home-widgets-container').masonry().masonry('reloadItems');
        });
    });

    $(document).on('ifToggled', '.display-widget', function(event) {
        var self = $(this),
            widget = $(this).data('widget'),
            widgetPanel = $('#panel' + widget);

        if (completedToggle) {
            return;
        }

        self.iCheck('disable');
        if (self.prop('checked')) {
            if (widgetPanel.hasClass('hidden')) {
                self.parent('div').parent('label').parent('li').addClass('active');
                widgetPanel.hide().removeClass('hidden').slideDown('fast', function() {
                    WHMCS.http.jqClient.post(WHMCS.adminUtils.getAdminRouteUrl('/widget/display/toggle/' + widget))
                    .always(function() {
                        $('.home-widgets-container').masonry().masonry('reloadItems');
                        widgetPanel.find('.widget-refresh').click();
                        if ($('#widgetSettingsDropdown').hasClass('open') === false) {
                            $('#widgetSettings').dropdown('toggle');
                        }
                        self.iCheck('enable');
                    });
                });
            }
        } else {
            if (widgetPanel.hasClass('hidden') === false) {
                self.parent('div').parent('label').parent('li').removeClass('active');
                widgetPanel.slideUp('fast', function() {
                    $(this).addClass('hidden');
                    $('.home-widgets-container').masonry().masonry('reloadItems');
                    WHMCS.http.jqClient.post(WHMCS.adminUtils.getAdminRouteUrl('/widget/display/toggle/' + widget), function() {
                        if ($('#widgetSettingsDropdown').hasClass('open') === false) {
                            $('#widgetSettings').dropdown('toggle');
                        }
                    }, 'json').always(function() {
                        self.iCheck('enable');
                    });
                });
            }
        }
    });

    $('input.display-widget').each(function(){
        var self = $(this),
            label = self.next(),
            label_text = label.text();

        label.remove();
        self.iCheck({
            inheritID: true,
            checkboxClass: 'icheckbox_flat-blue',
            increaseArea: '20%'
        });
    });

    if ($('.home-widgets-container').length) {
        minimisedWidgets.forEach(function(currentValue) {
            $('#panel' + currentValue).find('.panel-body').hide().end()
                .find('i.fa-chevron-up').removeClass('fa-chevron-up').addClass('fa-chevron-down');
        });

        Packery.prototype.getPositions = function() {
            return this.items.map(function(item) {
                return item.element.getAttribute("data-widget")
            });
        };

        // init Packery
        grid = document.querySelector('.home-widgets-container'),
        packery = new Packery(grid, {
            itemSelector: '.dashboard-panel-item',
            columnWidth: '.dashboard-panel-sizer',
            percentPosition: true
        });

        packery.stamp(document.querySelector('.dashboard-panel-static-item'));

        // init draggable
        var items = grid.querySelectorAll('.dashboard-panel-item');
        for (var i=0; i < items.length; i++) {
            var itemElem = items[i],
                draggie = new Draggabilly(itemElem, {handle: '.panel-title'} );
            packery.bindDraggabillyEvents(draggie);
        }

        // Listeners

        packery.on('removeComplete', function() {
            packery.shiftLayout();
        });

        var isSaving = false;
        packery.on('dragItemPositioned', function(items) {
            packery.shiftLayout();
            if (!$(".home-widgets-container").children("div.dashboard-panel-item").hasClass('is-dragging')){
                if (!isSaving) {
                    isSaving = true;
                    setTimeout(function () {
                        saveWidgetPosition();
                    }, 1000);
                }
            }
        });
    }

    function saveWidgetPosition() {
        WHMCS.http.jqClient.post(WHMCS.adminUtils.getAdminRouteUrl('/widget/order'),
            {
                token: csrfToken,
                order: packery.getPositions()
            },
            function(data) {
                //do nothing
            },
            'json'
        ).always(function() {
            isSaving = false;
            packery.shiftLayout();
        });
    }

    jQuery('.admin-dashboard-carousel button.close').on(
        'click',
        dismissAdminDashboardCarouselItem
    );
    jQuery(window).on(
        'load resize orientationchange',
        normalizeAdminDashboardCarouselContent
    );
    function normalizeAdminDashboardCarouselContent() {
        let carouselContent = jQuery('.admin-dashboard-carousel .promotion-content');
        carouselContent.css('min-height', 0);
        let maxHeight = Math.max
            .apply(
                null,
                carouselContent.map(getCarouselItemOuterHeight).get()
            );
        carouselContent.css('min-height', maxHeight + 'px');
    }
    function getCarouselItemOuterHeight() {
        let element = jQuery(this);
        let item = element.closest('.item');
        let outerHeight = 0;
        if (item.hasClass('active')) {
            return element.outerHeight();
        }
        item.addClass('active');
        outerHeight = element.outerHeight();
        item.removeClass('active');
        return outerHeight;
    }
    function removeAdminDashboardSpecificPromotion(carousel, identifier) {
        let carouselItems = carousel.find('.item');
        let carouselIndicators = carousel.find('.carousel-indicators li');
        let targetIndex = 0;
        carouselItems.removeClass('active');
        carouselItems.each(function(index, item) {
            if (jQuery(item).find('[data-identifier="' + identifier + '"]').length > 0) {
                let nextIndex = parseInt(index) + 1;
                if (nextIndex >= carouselItems.length) {
                    nextIndex = 0;
                }
                targetIndex = nextIndex;
                jQuery(item).remove();
                jQuery(carouselItems[nextIndex]).addClass('active');
            }
        });
        if (carouselItems.length <= 2) {
            jQuery('.admin-dashboard-carousel-controls').remove();
            return false;
        }
        if (targetIndex !== 0) {
            targetIndex--;
        }
        carouselIndicators.removeClass('active');
        carouselIndicators.each(function(index, indicator) {
            if (index === targetIndex) {
                jQuery(indicator).addClass('active');
            }
        });
        carouselIndicators.last().remove();
    }
    function dismissAdminDashboardCarouselItem() {
        let identifier = jQuery(this).closest('.alert')
            .data('identifier');
        let carousel = jQuery('.admin-dashboard-carousel');
        if (carousel.find('.item').length <= 1) {
            carousel.remove();
        } else {
            removeAdminDashboardSpecificPromotion(carousel, identifier);
        }
        WHMCS.http.jqClient.post(
            WHMCS.adminUtils.getAdminRouteUrl('/promotions/dismiss/' + identifier),
            {
                token: csrfToken,
            }
        );
    }

    //end of $(document).ready
});

var grid, packery;

function refreshWidget(widgetName, requestString) {
    var obj = $('.panel[data-widget="' + widgetName + '"]');
    var panelBody = obj.find('.panel-body');
    var icon = obj.find('i.fa-sync');
    panelBody.addClass('panel-loading');
    var jqxhr = WHMCS.http.jqClient.post(
        WHMCS.adminUtils.getAdminRouteUrl('/widget/refresh&widget=' + widgetName + '&' + requestString),
        {
            'token': csrfToken
        },
        function(data) {
            panelBody.html(data.widgetOutput);
            panelBody.removeClass('panel-loading');
        }, 'json')
        .always(function() {
            icon.removeClass('fa-spin');
        });
}

jQuery(document).ready(function () {
    let mixpanelModal = jQuery("#mixpanelOptInModal");
    let setupWizardModal = jQuery(".whmcs-modal.modal-setup-wizard.in");
    const dataAdminIdBlock = document.querySelector('[data-user-id]');
    const authAdminId = dataAdminIdBlock ? dataAdminIdBlock.getAttribute('data-user-id') : null;

    if (!authAdminId) {
        return;
    }

    if (document.cookie.indexOf(`trackingOptInDismissed_${authAdminId}=true;`) !== -1) {
        return;
    }

    function dismissOptIn(isDismissedForYear) {
        mixpanelModal.removeClass("mixpanel-shown");

        const whmcsPath = window.location.pathname.split('/')[1] || '';
        const dataAdminIdBlock = document.querySelector('input.adminUserId') || document.getElementById('mixpanelOptInModal');
        const authAdminId = dataAdminIdBlock && dataAdminIdBlock.hasAttribute('data-user-id')
            ? dataAdminIdBlock.getAttribute('data-user-id')
            : null;

        if (!authAdminId) {
            return;
        }

        let cookieSettings = `trackingOptInDismissed_${authAdminId}=true; path=/${whmcsPath}; SameSite=Lax`;

        if (window.location.protocol === "https:") {
            cookieSettings += "; Secure";
        }

        if (isDismissedForYear) {
            cookieSettings += `; max-age=${365 * 24 * 60 * 60}`;
        }

        document.cookie = cookieSettings;
    }

    if (setupWizardModal.length) {
        return;
    }

    mixpanelModal.addClass("mixpanel-shown");

    const observer = new MutationObserver(() => {
        let updatedGswModal = jQuery(".whmcs-modal.modal-setup-wizard.in");
        if (updatedGswModal.length) {
            dismissOptIn(false);
            observer.disconnect();
        }
    });

    observer.observe(document.body, { childList: true, subtree: true });

    jQuery("#optInAccept").on("click", function () {
        saveMixPanelTrackingData(true);
        dismissOptIn(false);
        jQuery("#optInAccept").hide();
        observer.disconnect();
    });
    jQuery("#optInDismiss").on("click", function () {
        dismissOptIn(true);
        jQuery("#optInDismiss").hide();
        observer.disconnect();
    });
    jQuery("#optInClose").on("click", function() {
        dismissOptIn(false);
        observer.disconnect();
    });

    function saveMixPanelTrackingData(status) {
        WHMCS.http.jqClient.post(
            WHMCS.adminUtils.getAdminRouteUrl('/mixpanel/config/set'),
            {
                token: csrfToken,
                MixPanelTrackingEnabled: status
            }
        );
    }

    const checkbox = document.querySelector("input[name='mixpaneltrackingenabled']");
    const saveButton = document.querySelector('input[type="submit"].btn.btn-primary');

    if (!checkbox || !saveButton) return;

    let wasChecked = checkbox.checked;

    saveButton.addEventListener("click", function () {
        if (wasChecked && !checkbox.checked) {
            dismissOptIn(false);
        }
    });
});
