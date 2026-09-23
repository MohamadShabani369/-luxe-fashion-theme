/**
 * Luxe Fashion - Mini Cart slide-in panel
 * Vanilla JS, no dependencies.
 */

(function () {
    'use strict';

    function init() {
        var cartBtn = document.querySelector('.header-actions .cart');
        var panel = document.getElementById('mini-cart');

        if (!cartBtn || !panel) {
            console.warn('Luxe: cart button or mini-cart panel not found');
            return;
        }

        var closeBtn = panel.querySelector('.mini-cart-close');
        var backdrop = panel.querySelector('.mini-cart-backdrop');
        var overlay = panel.querySelector('.mini-cart-overlay');

        function openCart(e) {
            if (e) e.preventDefault();
            panel.classList.add('is-open');
            document.body.classList.add('luxe-no-scroll');
        }

        function closeCart() {
            panel.classList.remove('is-open');
            document.body.classList.remove('luxe-no-scroll');
        }

        cartBtn.addEventListener('click', openCart);

        if (closeBtn) closeBtn.addEventListener('click', closeCart);
        if (backdrop) backdrop.addEventListener('click', closeCart);
        if (overlay) overlay.addEventListener('click', closeCart);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' || e.keyCode === 27) {
                closeCart();
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();