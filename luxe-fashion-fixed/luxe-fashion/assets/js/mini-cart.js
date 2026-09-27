/**
 * Luxe Fashion - Mini Cart slide-in panel
 * Vanilla JS, no dependencies.
 *
 * NOTE: after an AJAX add-to-cart, WooCommerce's wc-cart-fragments.js
 * replaces #mini-cart with a brand new element (see luxe_cart_fragments()
 * in inc/woocommerce.php), which would silently detach any listeners bound
 * directly to the old node. Everything below is delegated from `document`
 * so it keeps working after that swap, and the panel opens automatically
 * whenever something is really added to the cart.
 */

(function () {
    'use strict';

    function openCart() {
        var panel = document.getElementById('mini-cart');
        if (!panel) return;
        panel.classList.add('is-open');
        document.body.classList.add('luxe-no-scroll');
    }

    function closeCart() {
        var panel = document.getElementById('mini-cart');
        if (!panel) return;
        panel.classList.remove('is-open');
        document.body.classList.remove('luxe-no-scroll');
    }

    document.addEventListener('click', function (e) {
        if (e.target.closest('.header-actions .cart')) {
            e.preventDefault();
            openCart();
            return;
        }
        if (e.target.closest('#mini-cart .mini-cart-close') ||
            e.target.closest('#mini-cart .mini-cart-backdrop') ||
            e.target.closest('#mini-cart .mini-cart-overlay')) {
            closeCart();
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' || e.keyCode === 27) {
            closeCart();
        }
    });

    // Open the panel as soon as a product is really added to the cart, so
    // the person gets an immediate, truthful confirmation instead of a
    // silent count change they might not notice.
    document.body.addEventListener('added_to_cart', function () {
        openCart();
    });
})();
