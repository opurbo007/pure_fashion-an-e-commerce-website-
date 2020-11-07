(function($, document) {
    "use strict";

    if (!$.jStorage.storageAvailable()) {
        throw 'localStorage is not available';
        return;
    }

    var $document = $(document),
        PRODUCTS_KEY = "pure-items",
        $wItemsCount = $('[data-pure-items-count]'),
        instance = null,
        defaults = {
            debug: false,
            onItemAdded: function(item) {

            },
            onItemUpdated: function(item) {

            }
        };

    /**
     * Call in the submit form event
     * @param form submit event
     */
    function submitForm(e) {
        e.preventDefault();

        var cf = $.Purefashion();

        var $form = $(e.currentTarget),
            $submit = $form.find('[data-pure-submit]'),
            $item = $form.find('[data-pure-item-id]');

        if (!$submit.length) {
            $submit = $form.find('input[type=submit], button').first();
        }

        var products = $.extend({}, $.jStorage.get(PRODUCTS_KEY)),
            action, serializedObject = serializeObject($form);

        if (!($item.val() in products)) {

            action = "added";

            // Call callback for items added
            cf.defaults.onItemAdded(serializedObject);

        } else {

            action = "updated";

            // Call callback for items updated
            cf.defaults.onItemUpdated(serializedObject);

        }

        products[$item.val()] = serializedObject;

        $.jStorage.set(PRODUCTS_KEY, products);

        updateCount();

        $form.trigger('pure-item-' + action);

        // Show some debug information if the variable is set and evaluates to true
        if (cf.defaults.debug) {
            console.info("[Purefashion] - Basket updated!");
            console.info("[Purefashion] - Item " + action + "!");
        }
    }

    function serializeObject($form) {
        var obj = {},
            arraySerial = $form.find('[data-pure-attribute]').serializeArray();

        $.each(arraySerial, function() {
            if (obj[this.name] !== undefined) {
                if (!obj[this.name].push) {
                    obj[this.name] = [obj[this.name]];
                }
                obj[this.name].push(this.value || '');
            } else {
                obj[this.name] = this.value || '';
            }
        });

        return obj;
    }

    /**
     * Update counter items. Wrapper of the count is referenced by metadata 'data-pure-items-count'
     * @return void
     */
    function updateCount() {

        var $itemsCount = $wItemsCount.find('.pure-fashion__num-items');

        if (jQuery.isEmptyObject(getItems())) {

            $itemsCount.remove();

            return;
        }

        $.each($wItemsCount, function(index, value) {
            var $itemsCount = $(this).find('.pure-fashion__num-items');

            if (!$itemsCount.length) {
                $itemsCount = $("<span class=\"pure-fashion__num-items\" />");

                $(this).append($itemsCount);
            }

            $itemsCount.php(getNumItems());

        });

    }

    /**
     * Get number of the items in basket
     * @return int
     */
    function getNumItems() {
        return Object.keys($.jStorage.get(PRODUCTS_KEY)).length;
    }

    /**
     * Get items of the basket
     * @returns {*|Mixed}
     */
    function getItems() {
        return $.jStorage.get(PRODUCTS_KEY);
    }

    /**
     * Remove item in the basket
     * @param Item id
     */
    function removeItem(id) {
        var items = getItems();

        var cf = $.Purefashion();

        if (id in items) {
            delete items[id]; // delete item
        } else {

            // Show some debug information if the variable is set and evaluates to true
            if (cf.defaults.debug) {
                console.info("[Purefashion] - Item not found in the basket.");
            }

            return false;
        }

        $.jStorage.flush(); // Emptying the basket

        $.jStorage.set(PRODUCTS_KEY, items); // Put new list of items in the basket.

        $document.trigger('pure-item-deleted');

        // Show some debug information if the variable is set and evaluates to true
        if (cf.defaults.debug) {
            console.info("[Purefashion] - Item deleted!");
        }

        updateCount();

        return true;
    }

    /**
     *  Clear basket
     *  @return void
     */
    function clearBasket() {

        var cf = $.Purefashion();

        if ($.jStorage.flush()) {

            updateCount();

            if (cf.defaults.debug) {
                console.info("[Purefashion] - Empty basket!");
            }

            $document.trigger('pure-clear-basket');

            return true;
        }

        if (cf.defaults.debug) {
            console.warn("[Purefashion] - Problem when emptying basket!");
        }

        return false;
    }

    /**
     *  The Constructor
     */
    function Purefashion(options) {

        /* Singleton (ensure unique instance) */
        if (!instance) {

            this.defaults = $.extend({}, defaults, options);

            instance = this;

            this.init();
        }

        return instance;
    }

    $.extend(Purefashion.prototype, {
        init: function() {

            var cf = $.Purefashion();

            if (cf.defaults.debug) {
                console.info("[Purefashion] - Init");
            }

            updateCount();

            $document.on('submit', 'form[data-pure-form]', submitForm);

            $document.on('click', '[data-pure-clear-basket]', function(e) {
                e.preventDefault();
                clearBasket();
            });

            $document.on('click', '[data-pure-delete-item]', function(e) {
                e.preventDefault();

                var productId = $(this).data('pure-delete-item');
                removeItem(productId);
            });

        },
        updateCount: updateCount,
        getNumItems: getNumItems,
        getItems: getItems,
        removeItem: function(itemId) { return removeItem(itemId); },
        clearBasket: clearBasket
    });

    $.extend({
        Purefashion: function(options) {
            return (new Purefashion(options));
        }
    });

})(jQuery, document); // Fully reference jQuery after this point.