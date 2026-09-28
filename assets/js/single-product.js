(function() {
    'use strict';
    const DEBUG = false;
    function log(msg) { if (DEBUG) console.log('[LuxeSingle]', msg); }
    function init() {
        initGallerySwap();
        initQuantityStepper();
        initStickyAddToCart();
        initStarRating();
    }
    function initGallerySwap() {
        const gallery = document.querySelector('.luxe-product-gallery');
        if (!gallery) return;
        const mainImg = gallery.querySelector('.main-image');
        const thumbs = gallery.querySelectorAll('.thumb-img');
        if (!mainImg || !thumbs.length) return;
        thumbs.forEach(thumb => {
            thumb.addEventListener('click', function() {
                const src = this.getAttribute('data-full') || this.src;
                if (src && mainImg.src !== src) {
                    mainImg.src = src;
                    log('Gallery swapped: ' + src);
                }
                thumbs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
    }
    function initQuantityStepper() {
        document.querySelectorAll('.qty-minus, .qty-plus').forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.closest('.quantity-stepper').querySelector('.qty');
                if (!input) return;
                let val = parseInt(input.value) || 1;
                const max = parseInt(input.getAttribute('max')) || 999;
                if (this.classList.contains('qty-plus')) {
                    val = Math.min(val + 1, max);
                } else {
                    val = Math.max(val - 1, parseInt(input.getAttribute('min')) || 1);
                }
                input.value = val;
                input.dispatchEvent(new Event('change', { bubbles: true }));
            });
        });
    }
    function initStickyAddToCart() {
        const sticky = document.createElement('div');
        sticky.className = 'sticky-cart-bar';
        sticky.innerHTML = '<span class="sticky-title"></span><span class="sticky-price"></span><a href="#" class="sticky-cart-btn">Add to Cart</a>';
        document.body.appendChild(sticky);
        const btn = document.querySelector('.single_add_to_cart_button');
        if (!btn) return;
        const titleEl = document.querySelector('.product-title');
        const priceEl = document.querySelector('.price');
        if (titleEl) sticky.querySelector('.sticky-title').textContent = titleEl.textContent.trim();
        if (priceEl) sticky.querySelector('.sticky-price').textContent = priceEl.textContent.trim();
        // The sticky button had no click handler at all, so tapping it did
        // nothing. Forward the click to the real add-to-cart button so it
        // goes through WooCommerce's normal add-to-cart flow (works for
        // simple and variable products alike).
        const stickyBtn = sticky.querySelector('.sticky-cart-btn');
        if (stickyBtn) {
            stickyBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const liveBtn = document.querySelector('.single_add_to_cart_button');
                if (liveBtn) liveBtn.click();
            });
        }
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(e => {
                sticky.classList.toggle('visible', !e.isIntersecting);
                log('Sticky visibility: ' + !e.isIntersecting);
            });
        }, { threshold: 0 });
        observer.observe(btn);
        const scrollHandler = function() {
            // throttle handled by observer; no extra logic needed
        };
    }
    function initStarRating() {
        const form = document.querySelector('.comment-form-rating');
        if (!form) return;
        const stars = form.querySelectorAll('.star');
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                stars.forEach(s => s.classList.toggle('selected', parseInt(s.getAttribute('data-value')) <= parseInt(value)));
                const hidden = form.querySelector('input[name="rating"]');
                if (hidden) hidden.value = value;
            });
        });
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    luxeInitCartToast();
})();

(function() {
    'use strict';
    function luxeInitCartToast() {
        const toast = document.getElementById('luxe-cart-toast');
        if (!toast) return;
        const productEl = toast.querySelector('.luxe-toast-product');
        const closeBtn = toast.querySelector('.luxe-toast-close');
        const continueBtn = toast.querySelector('.luxe-toast-continue');
        let autoDismissTimer = null;

        function luxeShowToast(productName) {
            if (productEl) productEl.textContent = productName || 'Item added';
            toast.classList.add('is-visible');
            toast.setAttribute('aria-hidden', 'false');
            if (autoDismissTimer) clearTimeout(autoDismissTimer);
            autoDismissTimer = setTimeout(luxeHideToast, 4000);
        }

        function luxeHideToast() {
            toast.classList.remove('is-visible');
            toast.setAttribute('aria-hidden', 'true');
            if (autoDismissTimer) { clearTimeout(autoDismissTimer); autoDismissTimer = null; }
        }

        document.body.addEventListener('added_to_cart', function(e, fragments, cartHash, $button) {
            let productName = 'Item added to your cart';
            if ($button && $button.length) {
                const btnEl = $button[0] || $button;
                const title = btnEl.closest('.product') ? btnEl.closest('.product').querySelector('.product_title, .woocommerce-loop-product__title') : null;
                if (title) productName = title.textContent.trim();
            }
            if (!productName || productName === 'Item added to your cart') {
                const titleEl = document.querySelector('.product_title');
                if (titleEl) productName = titleEl.textContent.trim();
            }
            luxeShowToast(productName);
        });

        document.body.addEventListener('wc_fragments_refreshed', function() {
            const msg = document.querySelector('.woocommerce-message');
            if (msg && msg.textContent.includes('added to your cart')) { msg.style.display = 'none'; }
        });

        if (closeBtn) closeBtn.addEventListener('click', luxeHideToast);
        if (continueBtn) continueBtn.addEventListener('click', luxeHideToast);
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape') luxeHideToast(); });
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', luxeInitCartToast);
    } else {
        luxeInitCartToast();
    }
})();
