jQuery(document).ready(function() {
    jQuery('#main-body').on('click', '.product-recommendations .product-recommendation .header', function(e) {
        if (jQuery(e.target).is('.btn, .btn span, .btn .fa')) {
            return;
        }
        e.preventDefault();
        if (jQuery('.fa-square', this).length > 0) {
            return;
        }
        jQuery(this).parent().find('.rotate').toggleClass('down');
        jQuery(this).parent().find('.body').slideToggle('fast');
    }).on('click', '.product-recommendations .product-recommendation .btn-add', function() {
        jQuery(this).attr('disabled', 'disabled')
            .find('span.arrow i')
            .removeClass('fa-chevron-right')
            .addClass('fa-spinner fa-spin');
    }).on('click', '.order-button, .order-btn, .btn-order-now', function(e) {
        if (jQuery(this).data('hasRecommendations') == 1) {
            e.preventDefault();
            var href = jQuery(this).attr('href');
            jQuery('i', this).removeClass().addClass('fas fa-spinner fa-spin');
            displayRecommendations(
                href,
                'addproductajax=1',
                true
            ).done(function() {
                window.location = href;
            });
        }
    });
    setRecommendationColors();
    if (document.URL.includes('cart.php?a=checkout') || document.URL.includes('cart.php?a=view')) {
        if (jQuery('#recommendationsModal .product-recommendation:not(.clonable)').length > 0) {
            jQuery('#recommendationsModal').modal('toggle');
        }
    }
});

function getRecommendationColors(hex, percentage) {
    var primary = tinycolor(hex),
        secondary,
        text = tinycolor('fff'),
        brightness = Math.round(Math.min(primary.getBrightness()/255) * 100),
        baseBrightnessPercent = 25;
    if (brightness < baseBrightnessPercent) {
        primary.lighten(baseBrightnessPercent - brightness);
    } else if (brightness > (100 - baseBrightnessPercent)) {
        primary.darken(brightness - (100 - baseBrightnessPercent));
    }
    secondary = primary.clone().darken(percentage);
    if (secondary.isLight()) {
        text = tinycolor('000');
    }
    return [primary.toHexString(), secondary.toHexString(), text.toHexString()];
};

function setRecommendationColors() {
    var colors,
        defaultColor = '#9abb3a';
    jQuery('.product-recommendations .product-recommendation').each(function() {
        var element = jQuery(this),
            primaryColor = element.data('color');
        if (!(primaryColor.length > 0) || (primaryColor.match(/^#[0-9A-Fa-f]{3,6}$/gi) == undefined)) {
            primaryColor = defaultColor;
        }
        colors = getRecommendationColors(primaryColor, 15);
        element.css('border-color', colors[0]);
        jQuery('.btn-add', element).css('background-color', colors[0]);
        jQuery('.expander', element).css('color', colors[0]);
        jQuery('.price', element).css('color', colors[1]);
        jQuery('.text', element).css({'color': colors[2]});
        jQuery('.arrow', element).css({'background-color': colors[1], 'color': colors[2]});
    });
}

function displayRecommendations(postUrl, postData, postForce) {
    var deferredObject = jQuery.Deferred(),
        hasRecommendations = jQuery('#divProductHasRecommendations').data('value'),
        modal = jQuery('#recommendationsModal'),
        shoppingCartBtn = jQuery('.cart-btn .badge');
    if (postForce || hasRecommendations) {
        jQuery('.cart-body button[type="submit"] i')
            .removeClass('fa-arrow-circle-right')
            .addClass('fa-spinner fa-spin');
        WHMCS.http.jqClient.jsonPost({
            url: postUrl,
            data: postData,
            success: function(data) {
                if (data.success && data.href) {
                    modal.on('hide.bs.modal', function() {
                        window.location = data.href;
                        return false;
                    });
                    jQuery('#btnContinueRecommendationsModal', modal)
                        .attr('href', data.href)
                        .click(function () {
                            jQuery('span', this).removeClass('w-hidden hidden');
                        });
                    jQuery('.modal-body', modal).html('').html(data.html);
                    setRecommendationColors();
                    modal.modal('show');
                    jQuery('i.fa-spinner.fa-spin:visible').removeClass('fa-spinner fa-spin').addClass('fa-check-circle');
                    shoppingCartBtn.text(data.count);
                } else if (!data.success && data.href) {
                    window.location = data.href;
                } else {
                    deferredObject.resolve(false);
                }
            },
            error: function() {
                deferredObject.resolve(false);
            }
        });
    } else {
        deferredObject.resolve(false);
    }
    return deferredObject.promise();
}
