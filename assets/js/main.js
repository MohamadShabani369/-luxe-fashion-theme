/**
 * Luxe Fashion — Main JavaScript Module
 *
 * All frontend interactivity is implemented in pure vanilla JS.
 * No jQuery dependencies.
 *
 * @package Luxe_Fashion
 * @since 1.0.0
 */

(function() {
	'use strict';

	/**
	 * Initialize all theme functionality.
	 *
	 * @since 1.0.0
	 */
	function init() {
		setupMobileMenu();
		setupStickyHeader();
		setupSearchToggle();
		setupLazyLoad();
		setupScrollAnimations();
	}

	/**
	 * Mobile menu toggle for navigation.
	 *
	 * @since 1.0.0
	 */
	function setupMobileMenu() {
		const toggle = document.querySelector('.mobile-menu-toggle');
		const nav = document.querySelector('.primary-nav');

		if (!toggle || !nav) {
			return;
		}

		toggle.addEventListener('click', function() {
			const expanded = toggle.getAttribute('aria-expanded') === 'true';
			toggle.setAttribute('aria-expanded', !expanded ? 'true' : 'false');
			nav.classList.toggle('is-open');
			toggle.classList.toggle('is-active');
		});
	}

	/**
	 * Sticky header — hide on scroll down, show on scroll up.
	 *
	 * @since 1.0.0
	 */
	function setupStickyHeader() {
		const header = document.getElementById('masthead');
		if (!header) return;

		let lastScrollY = window.scrollY;

		window.addEventListener('scroll', function() {
			const currentScrollY = window.scrollY;
			if (currentScrollY > 300) {
				if (currentScrollY > lastScrollY) {
					header.classList.add('is-hidden');
				} else {
					header.classList.remove('is-hidden');
				}
			} else {
				header.classList.remove('is-hidden');
			}
			lastScrollY = currentScrollY;
		}, { passive: true });
	}

	/**
	 * Search toggle for header search form.
	 *
	 * @since 1.0.0
	 */
	function setupSearchToggle() {
		const searchForm = document.querySelector('.search-form');
		const button = document.querySelector('.search-toggle');

		if (!searchForm) return;

		if (button) {
			button.addEventListener('click', function(e) {
				e.preventDefault();
				searchForm.classList.toggle('is-visible');
				if (searchForm.classList.contains('is-visible')) {
					const input = searchForm.querySelector('input[type="search"]');
					if (input) input.focus();
				}
			});
		}
	}

	/**
	 * Lazy load images with native loading="lazy".
	 *
	 * @since 1.0.0
	 */
	function setupLazyLoad() {
		const images = document.querySelectorAll('img:not([loading])');
		images.forEach(function(img) {
			img.setAttribute('loading', 'lazy');
		});
	}

	/**
	 * Scroll-triggered fade/slide animations using IntersectionObserver.
	 *
	 * @since 1.0.0
	 */
	function setupScrollAnimations() {
		if (!('IntersectionObserver' in window)) {
			return;
		}

		const observer = new IntersectionObserver(function(entries) {
			entries.forEach(function(entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
					observer.unobserve(entry.target);
				}
			});
		}, { threshold: 0.1 });

		document.querySelectorAll('.fade-in, .slide-up').forEach(function(el) {
			observer.observe(el);
		});
	}

	// Initialize on DOMContentLoaded.
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}

})();
