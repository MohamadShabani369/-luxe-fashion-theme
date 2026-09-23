<?php
/**
 * Theme setup — supports, menus, image sizes, custom logo.
 *
 * @package Luxe_Fashion
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'luxe_setup_theme' ) ) :

	/**
	 * Set up theme defaults and make the theme available for translation.
	 *
	 * @return void
	 */
	function luxe_setup_theme() : void {
		// Let WordPress manage the document title (no <title> tag in header.php).
		add_theme_support( 'title-tag' );

		// Enable HTML5 for all form and structural elements.
		add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			]
		);

		// Custom logo — rendered with a flexible width so it scales on retina.
		add_theme_support(
			'custom-logo',
			[
				'height'               => 80,
				'width'                => 250,
				'flex-height'          => true,
				'flex-width'           => true,
				'unlink_homepage_logo' => true,
				'header-text'          => false,
			]
		);

		// Featured image (post-thumbnails) support.
		add_theme_support( 'post-thumbnails' );

		// Custom background support.
		add_theme_support( 'custom-background' );

		// Selective refresh for widgets — improves Customizer preview performance.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Register navigation menus for the various areas of the site.
		register_nav_menus(
			[
				'primary'    => esc_html__( 'Primary Menu', 'luxe-fashion' ),
				'footer'     => esc_html__( 'Footer Menu', 'luxe-fashion' ),
				'mobile'     => esc_html__( 'Mobile Menu', 'luxe-fashion' ),
				'account'    => esc_html__( 'Account / My-Account Menu', 'luxe-fashion' ),
			]
		);
	}

	add_action( 'after_setup_theme', 'luxe_setup_theme' );

endif;

/**
 * Register custom image sizes for editorial and product use.
 *
 * @return void
 */
function luxe_register_image_sizes() : void {
	// Hero / editorial banner — wide, short crops.
	add_image_size( 'luxe-hero', 1600, 700, true );

	// Square crop for product grid cards.
	add_image_size( 'luxe-product-square', 600, 600, true );

	// Tall portrait — used for lookbook/editorial spreads.
	add_image_size( 'luxe-editorial', 800, 1200, false );

	// Thumbnail for related / upsell grids.
	add_image_size( 'luxe-thumb-small', 150, 150, true );
}

add_action( 'after_setup_theme', 'luxe_register_image_sizes' );

/**
 * Return the correct image size key based on context.
 * Helpers can call this to avoid hard-coding size names.
 *
 * @param string $context Where the image will appear (hero, product, etc.).
 * @return string
 */
function luxe_get_image_size( string $context ) : string {
	$map = [
		'hero'       => 'luxe-hero',
		'product'    => 'luxe-product-square',
		'editorial'  => 'luxe-editorial',
		'thumb'      => 'luxe-thumb-small',
	];

	return $map[ $context ] ?? 'large';
}
