/**
 * WHMCS client area checkout and invoice payment UX module integration interface.
 * Stability: alpha - no guarantees are made against the stability of this interface.
 * @copyright Copyright (c) WHMCS Limited 2005-2023
 * @license http://www.whmcs.com/license/ WHMCS Eula
 */
(function(module) {
    if (!WHMCS.hasModule('payment')) {
        WHMCS.loadModule('payment', module);
    }
})({

internal: function () {

    this.isRenderSource = function (source) {
        return [
            'checkout',
            'invoice-pay',
            'admin-payment-method-add',
            'admin-payment-method-edit',
            'payment-method-add',
            'payment-method-edit',
        ].includes(source);
    }

    this.reportUnknownSource = function (source) {
        if (!WHMCS.payment.internal.isRenderSource(source)) {
            WHMCS.payment.internal.logError('unknown source: ' + source);
            return true;
        }
        return false;
    }

    this.logError = function (error) {
        console.error('[WHMCS.payment] ' + error);
    }
},

handler: function () {
    this.make = function (moduleName) {
        function Handler(moduleName) {
            this.module = moduleName;

            this.onGatewayInit = function (fn, options = {}) {
                var eventOptions = {...WHMCS.payment.register.defaultEventOpts(), ...options};
                WHMCS.payment.register.onGatewayInit(this.module, fn, eventOptions);
                return this;
            }

            this.onGatewayOptionInit = function (fn, options = {}) {
                var eventOptions = {...WHMCS.payment.register.defaultEventOpts(), ...options};
                WHMCS.payment.register.onGatewayOptionInit(this.module, fn, eventOptions);
                return this;
            }

            this.onGatewaySelected = function (fn, options = {}) {
                var eventOptions = {...WHMCS.payment.register.defaultEventOpts(), ...options};
                WHMCS.payment.register.onGatewaySelected(this.module, fn, eventOptions);
                return this;
            }

            this.onGatewayUnselected = function (fn, options = {}) {
                var eventOptions = {...WHMCS.payment.register.defaultEventOpts(), ...options};
                WHMCS.payment.register.onGatewayUnselected(this.module, fn, eventOptions);
                return this;
            }

            this.onCheckoutFormSubmit = function (fn, options = {}) {
                var eventOptions = {...WHMCS.payment.register.defaultEventOpts(), ...options};
                WHMCS.payment.register.onCheckoutFormSubmit(this.module, fn, eventOptions);
                return this;
            }
            this.onAddPayMethodFormSubmit = function (fn, options = {}) {
                var eventOptions = {...WHMCS.payment.register.defaultEventOpts(), ...options};
                WHMCS.payment.register.onAddPayMethodFormSubmit(this.module, fn, eventOptions);
                return this;
            }

            this.manageInputsContainer = function (selector, options = {}) {
                var eventOptions = {
                    ...WHMCS.payment.register.defaultEventOpts(),
                    ...{priority: 1},
                    ...options
                };
                this.onGatewayInit(function (metadata, element) {
                    if (metadata._source != 'invoice-pay') return;
                    WHMCS.payment.display.reset();
                    WHMCS.payment.display.show(jQuery(selector));
                }, eventOptions);
                this.onGatewaySelected(function (metadata, element) {
                    if (metadata._source == 'payment-method-add') {
                        WHMCS.payment.display.reset();
                        jQuery('div.fieldgroup-creditcard'
                            + ',div.fieldgroup-bankaccount'
                            + ',div.fieldgroup-auxfields').hide();
                    }
                    WHMCS.payment.display.show(jQuery(selector));
                }, eventOptions);
                this.onGatewayUnselected(function (metadata, element) {
                    WHMCS.payment.display.hide(jQuery(selector));
                }, eventOptions);
                return this;
            }
        }
        return new Handler(moduleName);
    }
},

register: function () {

    this.onGatewayInit = function (module, fn, options) {
        if (!this.isFunction('register.gatewayInit', fn)) return this;
        this.registerForEvent(
            WHMCS.payment.event.observersGatewayInit,
            module,
            fn,
            options
        )
        return this;
    }

    this.onGatewayOptionInit = function (module, fn, options) {
        if (!this.isFunction('register.gatewayOptionInit', fn)) return this;
        this.registerForEvent(
            WHMCS.payment.event.observersGatewayOptionInit,
            module,
            fn,
            options
        )
        return this;
    }

    this.onGatewaySelected = function (module, fn, options) {
        if (!this.isFunction('register.onGatewaySelected', fn)) return this;
        this.registerForEvent(
            WHMCS.payment.event.observersGatewaySelected,
            module,
            fn,
            options
        )
        return this;
    }

    this.onGatewayUnselected = function (module, fn, options) {
        if (!this.isFunction('register.onGatewayUnselected', fn)) return this;
        this.registerForEvent(
            WHMCS.payment.event.observersGatewayUnselected,
            module,
            fn,
            options
        )
        return this;
    }

    this.onCheckoutFormSubmit = function (module, fn, options) {
        if (!this.isFunction('register.onCheckoutFormSubmit', fn)) return this;
        this.registerForEvent(
            WHMCS.payment.event.observersCheckoutFormSubmit,
            module,
            fn,
            options
        )
        return this;
    }

    this.onAddPayMethodFormSubmit = function (module, fn, options) {
        if (!this.isFunction('register.onAddPayMethodFormSubmit', fn)) return this;
        this.registerForEvent(
            WHMCS.payment.event.observersAddPayMethodFormSubmit,
            module,
            fn,
            options
        )
        return this;
    }

    this.defaultEventOpts = function () {
        return {
            priority: 100,
            once: false,
        };
    }

    this.registerForEvent = function (observerMap, module, fn, options) {
        if (!observerMap.has(module)) {
            observerMap.set(module, new Map);
        }
        observerMap.get(module).set(options.priority, {
            _fn: fn,
            ...options,
        });
        return this;
    }

    this.isFunction = function (label, fn) {
        if (typeof fn != 'function') {
            console.error('[register.' + label + '] Expecting a function, got ' + fn);
            return false;
        }
        return true;
    }
},

event: function () {
    this.observersGatewayInit = new Map;
    this.observersGatewayOptionInit = new Map;
    this.observersGatewaySelected = new Map;
    this.observersGatewayUnselected = new Map;
    this.observersCheckoutFormSubmit = new Map;
    this.observersAddPayMethodFormSubmit = new Map;
    this.previouslySelected = null;

    this.gatewayInit = function (metadata, module) {
        this.notifyEvent(
            'gatewayInit',
            this.observersGatewayInit,
            module,
            metadata
        );
    }

    this.gatewayOptionInit = function (metadata, module, formElement) {
        this.notifyEvent(
            'gatewayOptionInit',
            this.observersGatewayOptionInit,
            module,
            metadata,
            formElement
        );
    }

    this.gatewaySelected = function (metadata, module, formElement) {
        this.previouslySelected = {
            formElement: formElement,
            module: module,
        };
        this.notifyEvent(
            'gatewaySelected',
            this.observersGatewaySelected,
            module,
            metadata,
            formElement
        );
    }

    this.gatewayUnselected = function (metadata) {
        if (this.previouslySelected == null) return;
        this.notifyEvent(
            'gatewayUnselected',
            this.observersGatewayUnselected,
            this.previouslySelected.module,
            metadata,
            this.previouslySelected.formElement
        );
    }

    this.checkoutFormSubmit = function (metadata, module, formElement) {
        this.notifyEvent(
            'checkoutFormSubmit',
            this.observersCheckoutFormSubmit,
            module,
            metadata,
            formElement
        );
    }

    this.addPayMethodFormSubmit = function (metadata, module, formElement) {
        this.notifyEvent(
            'addPayMethodFormSubmit',
            this.observersAddPayMethodFormSubmit,
            module,
            metadata,
            formElement
        );
    }

    this.notifyEvent = function (eventName, observersMap, module, metadata, formElement) {
        if (!observersMap.has(module)) {
            return;
        }
        var observers = observersMap.get(module);
        var destruct = [];
        this.notifyOrdered(observers, function (observer, priority) {
            observer._fn(metadata, formElement);
            if (observer.once) {
                destruct.push(priority);
            }
        });
        destruct.forEach(function (k) {
            observers.delete(k);
        })
    }

    this.notifyOrdered = function (observersMap, fn) {
        (new Map([...observersMap.entries()].sort())).forEach(fn);
    }
},

query: function () {

    this.isGatewaySelected = function (module) {
        return (
            WHMCS.payment.event.previouslySelected != null
            && WHMCS.payment.event.previouslySelected.module == module
        );
    }

},

behavior: function () {

    this.disableDefaultCardValidation = function (source) {
        if (source == 'invoice-pay') {
            if (typeof validateCreditCardInput === 'function') {
                jQuery('#frmPayment').off('submit', validateCreditCardInput);
            }
        } else if (source == 'checkout') {
            if (typeof validateCheckoutCreditCardInput === 'function') {
                jQuery('#frmCheckout').off('submit', validateCheckoutCreditCardInput);
            }
        } else {
            WHMCS.payment.internal.reportUnknownSource(source);
        }
    }

    this.enableDefaultCardValidation = function (source) {
        if (source == 'invoice-pay') {
            if (typeof validateCreditCardInput === 'function') {
                jQuery('#frmPayment').on('submit', validateCreditCardInput);
            }
        } else if (source == 'checkout') {
            if (typeof validateCheckoutCreditCardInput === 'function') {
                jQuery('#frmCheckout').on('submit', validateCheckoutCreditCardInput);
            }
        } else {
            WHMCS.payment.internal.reportUnknownSource(source);
        }
    }

},

display: function () {

    this.reset = function () {
        var container = jQuery('#paymentGatewayInput');
        if (container.length == 0) return;
        var existing = container.children();
        existing.hide();
        jQuery('body').append(existing);
        return this;
    }

    this.show = function (inputContainer) {
        var container = jQuery('#paymentGatewayInput');
        if (container.length == 0) return;
        container.append(inputContainer);
        inputContainer.slideDown();
        return this;
    }

    this.hide = function (inputContainer) {
        inputContainer.slideUp({
            complete: function () {
                jQuery('body').append(inputContainer);
            },
        });
        return this;
    }

    this.error = function (errorMessage) {
        jQuery('.gateway-errors').html(errorMessage);
        return this;
    }

    this.errorClear = function () {
        let gatewayErrorsContainer = jQuery('.gateway-errors');
        if (gatewayErrorsContainer.length == 0) return;
        this.error('');
        gatewayErrorsContainer.slideUp();
        return this;
    }

    this.errorShow = (errorMessage, source = 'invoice-pay') => {
        let gatewayErrorsContainer = jQuery('.gateway-errors');

        if (source === 'checkout' && typeof showCheckoutError === 'function') {
            // standardized function to show checkout error
            showCheckoutError(errorMessage, gatewayErrorsContainer);
        }

        if (source === 'invoice-pay') {
            if (gatewayErrorsContainer.length === 0) {
                return this;
            }

            this.error(errorMessage);
            gatewayErrorsContainer.slideDown();
        }

        return this;
    }

    this.submitReset = function (source) {
        if (source == 'invoice-pay') {
            this.invoiceSubmitReset();
        } else if (source == 'checkout') {
            this.checkoutSubmitReset();
        } else {
            WHMCS.payment.internal.reportUnknownSource(source);
        }
    };

    this.invoiceSubmitReset = function () {
        let btnSubmit = jQuery('#btnSubmit').prop('disabled', false)
            .removeClass('disabled');
        btnSubmit.find('.click-text').hide();
        btnSubmit.find('.pay-text').show();
    }

    this.checkoutSubmitReset = function () {
        jQuery('#btnCompleteOrder').removeClass('disabled')
            .removeClass('disable-on-click')
            .removeClass('spinner-on-click')
            .addClass('disable-on-click spinner-on-click')
            .prop('disabled', false)
            .find('i.fas')
                .removeAttr('class')
                .addClass('fas fa-arrow-circle-right');
    }

    this.submitDisable = function (source) {
        if (source == 'invoice-pay') {
            this.invoiceSubmitDisable();
        } else if (source == 'checkout') {
            this.checkoutSubmitDisable();
        } else {
            WHMCS.payment.internal.reportUnknownSource(source);
        }
    };

    this.invoiceSubmitDisable = function () {
        jQuery('#btnSubmit').addClass('disabled')
            .prop('disabled', true);
    }

    this.checkoutSubmitDisable = function () {
        jQuery('#btnCompleteOrder').addClass('disabled')
            .prop('disabled', true);
    }
},

});
