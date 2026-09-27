<?php
/**
 * Asset registration and enqueueing.
 *
 * All scripts are vanilla JS (no jQuery). Dependencies are expressed
 * explicitly, and versioning uses the theme version to bust cache on update.
 *
 * @package Luxe_Fashion
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the effective theme version for cache-busting.
 * Falls back to LUXE_THEME_VERSION when a child theme overrides the constant.
 *
 * @return string
 */
function luxe_get_asset_version() : string {
	return defined( 'LUXE_THEME_VERSION' ) ? LUXE_THEME_VERSION : '1.0.0';
}

/**
 * Register and enqueue frontend styles and scripts.
 *
 * @return void
 */
function luxe_enqueue_assets() : void {
	$version = luxe_get_asset_version();

	// --- Fonts -------------------------------------------------------------
	// Vazirmatn (Persian) is bundled locally per requirements.
	// We also enqueue a Google Fonts stylesheet for Playfair Display and Inter
	// via wp_enqueue_style — no inline <link> tags.
	wp_enqueue_style(
		'luxe-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap',
		[],
		$version
	);

	// --- CSS ---------------------------------------------------------------
	// Main theme stylesheet — design tokens, layout, typography, utilities.
	wp_enqueue_style(
		'luxe-main',
		LUXE_ASSET_URI . '/css/main.css',
		[],
		$version
	);

	// Header stylesheet — announcement bar, sticky header, mega menu, search overlay, mini cart, mobile menu.
	wp_enqueue_style(
		'luxe-header',
		LUXE_ASSET_URI . '/css/header.css',
		[ 'luxe-main' ],
		$version
	);

	// Footer stylesheet — footer grid, newsletter, social links, payment icons, back-to-top.
	wp_enqueue_style(
		'luxe-footer',
		LUXE_ASSET_URI . '/css/footer.css',
		[ 'luxe-main' ],
		$version
	);

	// Animations stylesheet is loaded only when WooCommerce is active.
	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_style(
			'luxe-animations',
			LUXE_ASSET_URI . '/css/animations.css',
			[ 'luxe-main' ],
			$version
		);
	}

	// Homepage styles — load only on front page.
	if ( is_front_page() ) {
		wp_enqueue_style(
			'luxe-home',
			LUXE_ASSET_URI . '/css/home.css',
			[ 'luxe-main' ],
			$version
		);
	}

	// --- JS ---------------------------------------------------------------
	// All modern browsers support ES modules, but we still register as a
	// plain script with explicit dependencies for maximum compatibility.
	wp_enqueue_script(
		'luxe-main',
		LUXE_ASSET_URI . '/js/main.js',
		[],
		$version,
		true // Load in footer.
	);

	// Header JavaScript — sticky header, search overlay.
	wp_enqueue_script(
		'luxe-header',
		LUXE_ASSET_URI . '/js/header.js',
		[],
		$version,
		true
	);

	// Mobile menu — off-canvas hamburger menu with focus trap.
	wp_enqueue_script(
		'luxe-mobile-menu',
		LUXE_ASSET_URI . '/js/mobile-menu.js',
		[],
		$version,
		true
	);

	// Mini Cart — slide-in cart panel, live count badge, AJAX updates.
	wp_enqueue_script(
		'luxe-mini-cart',
		LUXE_ASSET_URI . '/js/mini-cart.js',
		[],
		$version,
		true
	);

	// Homepage JavaScript — carousel, scroll reveal, hero parallax.
	if ( is_front_page() ) {
		wp_enqueue_script(
			'luxe-home',
			LUXE_ASSET_URI . '/js/home.js',
			[],
			$version,
			true
		);
	}

	// --- Conditional: About page styles ---
	if ( is_page_template( 'page-about.php' ) ) {
		wp_enqueue_style(
			'luxe-about',
			LUXE_ASSET_URI . '/css/about.css',
			[ 'luxe-main' ],
			$version
		);
	}

	// --- Conditional: Shop archive styles ---
	if ( is_shop() || is_product_category() || is_product_tag()
	     || is_post_type_archive( 'product' ) ) {
		wp_enqueue_style(
			'luxe-shop',
			LUXE_ASSET_URI . '/css/shop.css',
			[ 'luxe-main' ],
			$version
		);
	}

	// --- Conditional: Cart page styles ---
	if ( is_cart() ) {
		wp_enqueue_style(
			'luxe-cart',
			LUXE_ASSET_URI . '/css/cart.css',
			[ 'luxe-main' ],
			$version
		);
	}

	// --- Conditional: Single product assets ---
	if ( is_product() ) {
		wp_enqueue_style(
			'luxe-single-product',
			LUXE_ASSET_URI . '/css/single-product.css',
			[ 'luxe-main' ],
			$version
		);
		wp_enqueue_script(
			'luxe-single-product',
			LUXE_ASSET_URI . '/js/single-product.js',
			[],
			$version,
			true
		);
		wp_localize_script(
			'luxe-single-product',
			'luxeSingleProduct',
			[
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'luxe_single_product_nonce' ),
				'isRTL'   => is_rtl() ? 'true' : 'false',
			]
		);
	}

	// --- Conditional: Contact page styles ---
	if ( is_page_template( 'page-contact.php' ) ) {
		wp_enqueue_style(
			'luxe-contact',
			LUXE_ASSET_URI . '/css/contact.css',
			[ 'luxe-main' ],
			$version
		);
	}

	// Pass theme data to the main script (no inline JS).
	wp_localize_script(
		'luxe-main',
		'luxeTheme',
		[
			'ajaxUrl'      => admin_url( 'admin-ajax.php', 'relative' ),
			'nonce'        => wp_create_nonce( 'luxe_ajax_nonce' ),
			'textDomain'   => LUXE_TEXT_DOMAIN,
			'isRTL'        => is_rtl() ? 'true' : 'false',
			'ajaxFilters'  => class_exists( 'WooCommerce' ) ? 1 : 0,
			'wooAvailable' => class_exists( 'WooCommerce' ) ? 1 : 0,
		]
	);
}

add_action( 'wp_enqueue_scripts', 'luxe_enqueue_assets' );

/**
 * Remove the default WordPress block-library styles from the <head><body>
 * and instead rely on theme-managed styles. Optionally re-enable via filter.
 *
 * @return void
 */
function luxe_deregister_block_styles() : void {
	// Only needed if the theme uses full-site editing or if the client
	// wants leaner output. Left enabled by default for editor compatibility.
	if ( ! apply_filters( 'luxe_deregister_global_styles', false ) ) {
		return;
	}
	wp_deregister_style( 'global-styles' );
}

add_action( 'wp_enqueue_scripts', 'luxe_deregister_block_styles', 999 );

/**
 * Defer non-critical CSS for fonts — uses a simple preload-and-swap technique.
 * This keeps critical above-fold rendering fast.
 *
 * @param string $html
 * @param string $handle
 * @param array  $attr
 * @return string
 */
function luxe_filter_font_stylesheet_preload( $html, $handle, $attr ) : string {
	if ( 'luxe-fonts' === $handle ) {
		// Replace the standard <link> with a <link rel="preload"> for the font css.
		return str_replace( "rel='stylesheet'", "rel='preload' as='style' onload=\"this.onload=null;this.rel='stylesheet'\"", $html );
	}
	return $html;
}

add_filter( 'style_loader_tag', 'luxe_filter_font_stylesheet_preload', 10, 3 );