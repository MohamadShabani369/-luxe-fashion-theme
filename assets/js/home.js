/**
 * Homepage JavaScript - Luxe Fashion
 * Carousel logic and scroll animations
 */

(function () {
	'use strict';

	// ==========================================================================
	// New Arrivals Carousel
	// ==========================================================================
	function initNewArrivalsCarousel() {
		const carousel = document.querySelector('.new-arrivals .carousel-track');
		const prevBtn = document.querySelector('.new-arrivals .nav-btn.prev-btn');
		const nextBtn = document.querySelector('.new-arrivals .nav-btn.next-btn');
		if (!carousel || !prevBtn || !nextBtn) return;

		let scrollAmount = 0;
		const scrollStep = 200; // pixels per click

		prevBtn.addEventListener('click', () => {
			carousel.scrollBy({ left: -scrollStep, behavior: 'smooth' });
		});

		nextBtn.addEventListener('click', () => {
			carousel.scrollBy({ left: scrollStep, behavior: 'smooth' });
		});

		// Optional: scroll on wheel
		carousel.addEventListener('wheel', (e) => {
			if (e.deltaY !== 0) {
				e.preventDefault();
				carousel.scrollBy({ left: e.deltaY, behavior: 'auto' });
			}
		});
	}

	// ==========================================================================
	// Scroll Reveal Animations
	// ==========================================================================
	function initScrollReveal() {
		const observerOptions = {
			root: null,
			threshold: 0.1,
			rootMargin: '0px'
		};

		const observer = new IntersectionObserver((entries, obs) => {
			entries.forEach(entry => {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
					obs.unobserve(entry.target);
				}
			});
		}, observerOptions);

		const elements = document.querySelectorAll('.hero-content, .section-header, .product-card, .category-card, .lookbook-image, .lookbook-content, .story-content, .instagram-grid, .newsletter-content');
		elements.forEach(el => {
			observer.observe(el);
			el.classList.add('is-hidden');
		});
	}

	// ==========================================================================
	// Hero Parallax (Subtle)
	// ==========================================================================
	function initHeroParallax() {
		const hero = document.querySelector('.hero');
		if (!hero) return;

		window.addEventListener('scroll', () => {
			const scrolled = window.pageYOffset;
			const rate = scrolled * 0.1;
			hero.style.backgroundPositionY = `${rate}px`;
		});
	}

	// ==========================================================================
	// Initialize
	// ==========================================================================
	function init() {
		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', () => {
				initNewArrivalsCarousel();
				initScrollReveal();
				initHeroParallax();
			});
		} else {
			initNewArrivalsCarousel();
			initScrollReveal();
			initHeroParallax();
		}
	}

	init();
})();