/**
 * Mobile Menu JavaScript - Luxe Fashion
 * Handles off-canvas mobile menu toggle
 */

(function () {
	'use strict';

	// ==========================================================================
	// Configuration
	// ==========================================================================
	const CONFIG = {
		toggleSelector: '.mobile-menu-toggle',
		menuSelector: '#mobile-menu',
		closeSelector: '.mobile-menu-close',
		overlaySelector: '.mobile-menu-overlay',
		menuLinkSelector: '.mobile-menu-link',
	};

	// ==========================================================================
	// State
	// ==========================================================================
	let toggleEl = null;
	let menuEl = null;
	let closeEl = null;
	let overlayEl = null;
	let lastFocusedElement = null;
	let isOpen = false;

	// ==========================================================================
	// Mobile Menu Functions
	// ==========================================================================
	function openMenu() {
		if (isOpen) {
			return;
		}

		lastFocusedElement = document.activeElement;

		toggleEl?.classList.add('is-active');
		menuEl?.classList.add('is-open');
		overlayEl?.classList.add('is-open');

		document.body.style.overflow = 'hidden';
		isOpen = true;

		// Trap focus within menu
		trapFocus();

		// Close on Escape
		document.addEventListener('keydown', handleKeydown);
	}

	function closeMenu() {
		if (!isOpen) {
			return;
		}

		toggleEl?.classList.remove('is-active');
		menuEl?.classList.remove('is-open');
		overlayEl?.classList.remove('is-open');

		document.body.style.overflow = '';
		isOpen = false;

		if (lastFocusedElement) {
			lastFocusedElement.focus();
		}

		document.removeEventListener('keydown', handleKeydown);
	}

	function toggleMenu() {
		if (isOpen) {
			closeMenu();
		} else {
			openMenu();
		}
	}

	function handleKeydown(e) {
		if (e.key === 'Escape') {
			closeMenu();
		}

		// Trap Tab key
		if (e.key === 'Tab' && menuEl) {
			const focusableElements = menuEl.querySelectorAll(
				'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
			);

			if (focusableElements.length === 0) {
				return;
			}

			const firstElement = focusableElements[0];
			const lastElement = focusableElements[focusableElements.length - 1];

			if (e.shiftKey && document.activeElement === firstElement) {
				e.preventDefault();
				lastElement.focus();
			} else if (!e.shiftKey && document.activeElement === lastElement) {
				e.preventDefault();
				firstElement.focus();
			}
		}
	}

	function trapFocus() {
		if (!menuEl) {
			return;
		}

		const focusableElements = menuEl.querySelectorAll(
			'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
		);

		if (focusableElements.length > 0) {
			focusableElements[0].focus();
		}
	}

	function handleOverlayClick() {
		closeMenu();
	}

	function handleMenuLinkClick() {
		// Close menu when a link is clicked (optional - keeps it open for submenus)
		// closeMenu();
	}

	// ==========================================================================
	// Initialize
	// ==========================================================================
	function init() {
		toggleEl = document.querySelector(CONFIG.toggleSelector);
		menuEl = document.querySelector(CONFIG.menuSelector);
		closeEl = document.querySelector(CONFIG.closeSelector);
		overlayEl = document.querySelector(CONFIG.overlaySelector);

		if (!toggleEl || !menuEl) {
			return;
		}

		toggleEl.addEventListener('click', toggleMenu);
		closeEl?.addEventListener('click', closeMenu);
		overlayEl?.addEventListener('click', handleOverlayClick);

		// Close menu when clicking a link
		const menuLinks = menuEl.querySelectorAll(CONFIG.menuLinkSelector);
		menuLinks.forEach((link) => {
			link.addEventListener('click', handleMenuLinkClick);
		});

		// Handle window resize - close menu if resized to desktop
		window.addEventListener('resize', () => {
			if (window.innerWidth > 1023 && isOpen) {
				closeMenu();
			}
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();