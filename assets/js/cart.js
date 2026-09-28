/**
 * Luxe Fashion — Cart interactions
 * Handles AJAX add-to-cart, quantity update, and mini-cart refresh.
 */
(function () {
    'use strict';

    const cfg = window.luxeTheme || {};
    const ajaxUrl = cfg.ajaxUrl;
    const nonce = cfg.nonce;

    if (!ajaxUrl || !nonce) {
        console.warn('[Luxe] luxeTheme config missing.');
        return;
    }

    /**
     * Core AJAX helper — always sends cookies with the request.
     */
    async function post(action, data = {}) {
        const body = new URLSearchParams();
        body.append('action', action);
        body.append('nonce', nonce);

        Object.keys(data).forEach((key) => {
            body.append(key, data[key]);
        });

        const response = await fetch(ajaxUrl, {
            method: 'POST',
            credentials: 'same-origin', // ✅ critical: sends/accepts WC session cookies
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: body.toString(),
        });

        return response.json();
    }

    /**
     * Apply WooCommerce fragments returned in the response.
     */
    function applyFragments(fragments) {
        if (!fragments) return;

        Object.keys(fragments).forEach((selector) => {
            const html = fragments[selector];
            document.querySelectorAll(selector).forEach((el) => {
                const tmp = document.createElement('div');
                tmp.innerHTML = html.trim();
                const replacement = tmp.firstElementChild || tmp;
                el.replaceWith(replacement);
            });
        });
    }

    /**
     * Add to cart via AJAX.
     */
    async function addToCart(productId, quantity = 1, variationId = 0) {
        try {
            const result = await post('luxe_add_to_cart', {
                product_id: productId,
                quantity: quantity,
                variation_id: variationId,
            });

            if (!result || result.success === false) {
                const msg = result?.data?.message || 'Add to cart failed.';
                console.error('[Luxe]', msg);
                return;
            }

            // WooCommerce get_refreshed_fragments() returns { fragments, cart_hash }
            if (result.fragments) {
                applyFragments(result.fragments);
            }

            document.body.dispatchEvent(
                new CustomEvent('luxe:added-to-cart', {
                    detail: { productId, quantity },
                })
            );
        } catch (err) {
            console.error('[Luxe] addToCart error:', err);
        }
    }

    /* ------------------------------------------------------------------
     * Event bindings
     * ---------------------------------------------------------------- */

    document.addEventListener('click', function (e) {
        // Add to cart buttons
        const btn = e.target.closest('.add_to_cart_button, [data-add-to-cart]');
        if (btn) {
            const productId =
                btn.dataset.product_id ||
                btn.dataset.productId ||
                btn.getAttribute('data-product_id');
            const quantity = btn.dataset.quantity || 1;
            const variationId = btn.dataset.variation_id || 0;

            if (productId) {
                e.preventDefault();
                addToCart(productId, quantity, variationId);
            }
        }

        // Quantity stepper (+/-) on cart page
        const minus = e.target.closest('.qty-minus');
        const plus = e.target.closest('.qty-plus');

        if (minus || plus) {
            const stepper = (minus || plus).closest('.quantity-stepper');
            const input = stepper?.querySelector('input.qty');
            if (!input) return;

            const delta = plus ? 1 : -1;
            const min = parseInt(input.min || '1', 10);
            const next = Math.max(min, parseInt(input.value || '1', 10) + delta);
            input.value = next;
            input.dispatchEvent(new Event('change', { bubbles: true }));
        }
    });

    /* Expose helpers for theme scripts. */
    window.luxeCart = {
        addToCart,
        applyFragments,
    };
})();