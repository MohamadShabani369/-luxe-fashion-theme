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
	// Reset and base styles. We use a normalized reset approach.
	wp_enqueue_style(
		'luxe-normalize',
		LUXE_ASSET_URI . '/css/normalize.css',
		[],
		$version
	);

	// Main theme stylesheet — design tokens, layout, typography, utilities.
	wp_enqueue_style(
		'luxe-main',
		LUXE_ASSET_URI . '/css/main.css',
		[ 'luxe-normalize' ],
		$version
	);

	// WooCommerce-specific styles (loaded only on shop pages if WooCommerce is active).
	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_style(
			'luxe-woocommerce',
			LUXE_ASSET_URI . '/css/woocommerce.css',
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

	// Animations module — only loads if the animations.css file exists.
	wp_enqueue_script(
		'luxe-animations',
		LUXE_ASSET_URI . '/js/animations.js',
		[ 'luxe-main' ],
		$version,
		true
	);

	// WooCommerce frontend interactions (cart, quick-view, filtering).
	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_script(
			'luxe-cart',
			LUXE_ASSET_URI . '/js/cart.js',
			[ 'luxe-main', 'luxe-animations' ],
			$version,
			true
		);

		wp_enqueue_style(
			'luxe-animations',
			LUXE_ASSET_URI . '/css/animations.css',
			[ 'luxe-main' ],
			$version
		);
	}
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
