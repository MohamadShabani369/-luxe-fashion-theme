/**
 * Luxe Fashion - Header interactions
 * Vanilla JS, no dependencies.
 */

(function () {
    'use strict';

    console.log('LUXE: header.js loaded');

    function init() {
        console.log('LUXE: header.js init running');
        initSearchOverlay();
        initStickyHeader();
    }

    function initSearchOverlay() {
        var toggle = document.querySelector('.search-toggle');
        var overlay = document.getElementById('search-overlay');

        console.log('LUXE: search toggle =', toggle);
        console.log('LUXE: search overlay =', overlay);

        if (!toggle || !overlay) {
            console.warn('LUXE: search elements not found');
            return;
        }

        var closeBtn = overlay.querySelector('.search-overlay-close');
        var backdrop = overlay.querySelector('.search-overlay-backdrop');
        var input = overlay.querySelector('input[type="search"]');

        function openSearch(e) {
            if (e) e.preventDefault();
            console.log('LUXE: opening search');
            overlay.classList.add('is-open');
            document.body.classList.add('luxe-no-scroll');
            if (input) {
                setTimeout(function () { input.focus(); }, 120);
            }
        }

        function closeSearch() {
            console.log('LUXE: closing search');
            overlay.classList.remove('is-open');
            document.body.classList.remove('luxe-no-scroll');
        }

        toggle.addEventListener('click', openSearch);

        if (closeBtn) closeBtn.addEventListener('click', closeSearch);
        if (backdrop) backdrop.addEventListener('click', closeSearch);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' || e.keyCode === 27) {
                closeSearch();
            }
        });
    }

    function initStickyHeader() {
        var header = document.querySelector('.site-header');
        if (!header) return;

        var lastScroll = 0;
        var threshold = 100;

        window.addEventListener('scroll', function () {
            var current = window.pageYOffset || document.documentElement.scrollTop;

            if (current > threshold && current > lastScroll) {
                header.classList.add('is-hidden');
            } else {
                header.classList.remove('is-hidden');
            }

            lastScroll = current;
        }, { passive: true });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();