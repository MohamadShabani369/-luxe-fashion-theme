<?php
/**
 * WooCommerce integration, hooks and customizations.
 *
 * Loaded even when WooCommerce is inactive — each function checks
 * Woo availability before acting so the theme stays functional.
 *
 * @package Luxe_Fashion
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Declare WooCommerce support and configure image/lightbox/gallery settings.
 *
 * @return void
 */
function luxe_woocommerce_support() : void {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	// Enable WooCommerce features: product-gallery-zoom, sliders, lightbox.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Custom image dimensions for the single product gallery.
	add_theme_support( 'custom-logo' );
}

add_action( 'after_setup_theme', 'luxe_woocommerce_support', 20 );

/**
 * Modify the WooCommerce product gallery thumbnails — vertical, no flex.
 *
 * @param array $args
 * @return array
 */
function luxe_modify_product_gallery_args( $args ) {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return $args;
	}

	// Override the default thumb columns and position.
	$args['thumbnail_size_w'] = 100;
	$args['thumbnail_size_h'] = 100;
	$args['thumbnail_crop']   = 1;

	$args['woocommerce_single_image_width']  = 800;
	$args['woocommerce_single_image_height'] = 1000;

	return $args;
}

add_filter( 'woocommerce_gallery_image_args', 'luxe_modify_product_gallery_args', 10, 1 );

/**
 * Remove default WooCommerce wrappers so we control the markup via our
 * own template parts. This prevents conflicts when using the theme's
 * own header/footer and layout.
 *
 * @return void
 */
function luxe_remove_woocommerce_hooks() : void {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	// We'll wrap our own template files, so remove defaults here.
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 20 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
}

add_action( 'init', 'luxe_remove_woocommerce_hooks' );

/**
 * Add body classes for WooCommerce pages — used by CSS for layout shifts.
 *
 * @param array $classes
 * @return array
 */
function luxe_woocommerce_body_classes( $classes ) {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return $classes;
	}

	if ( is_woocommerce() ) {
		$classes[] = 'luxe-woocommerce';
	}

	if ( is_shop() || is_product_category() || is_product_tag() || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) {
		$classes[] = 'luxe-shop-archive';
	}

	if ( is_cart() ) {
		$classes[] = 'luxe-cart-page';
	}

	if ( is_checkout() ) {
		$classes[] = 'luxe-checkout-page';
	}

	if ( is_account_page() ) {
		$classes[] = 'luxe-account-page';
	}

	return $classes;
}

add_filter( 'body_class', 'luxe_woocommerce_body_classes' );

/**
 * Enqueue a small JSON config for AJAX cart / filter interactions.
 * This keeps the main localize call lean.
 *
 * @return void
 */
function luxe_enqueue_woocommerce_ajax() : void {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	// The cart.js script already received luxeTheme via wp_localize_script
	// in enqueue.php, so no additional work is needed here. Any Woo-specific
	// AJAX handlers should verify the nonce from `luxeTheme.nonce`.
}

/**
 * AJAX handler: get mini-cart fragments.
 * Returns updated cart HTML and the cart count — used for the slide-in mini-cart.
 *
 * @return void
 */
function luxe_ajax_mini_cart() : void {
	if ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) {
		wp_send_json_error( [ 'message' => esc_html__( 'Not an AJAX request.', 'luxe-fashion' ) ] );
		return;
	}

	// Nonce will be passed from the frontend as `luxeTheme.nonce`.
	$nonce = $_POST['nonce'] ?? $_GET['nonce'] ?? '';
	if ( ! wp_verify_nonce( $nonce, 'luxe_ajax_nonce' ) ) {
		wp_send_json_error( [ 'message' => esc_html__( 'Invalid nonce.', 'luxe-fashion' ) ] );
		return;
	}

	WC_AJAX::get_refresh_fragments();
}

add_action( 'wp_ajax_luxe_mini_cart', 'luxe_ajax_mini_cart' );
add_action( 'wp_ajax_nopriv_luxe_mini_cart', 'luxe_ajax_mini_cart' );

/**
 * AJAX handler: quick-view product data.
 * Returns the product title, price, gallery images, and add-to-cart form.
 *
 * @return void
 */
function luxe_ajax_quick_view() : void {
	if ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) {
		wp_send_json_error( [ 'message' => esc_html__( 'Not an AJAX request.', 'luxe-fashion' ) ] );
		return;
	}

	$nonce = $_POST['nonce'] ?? $_GET['nonce'] ?? '';
	if ( ! wp_verify_nonce( $nonce, 'luxe_ajax_nonce' ) ) {
		wp_send_json_error( [ 'message' => esc_html__( 'Invalid nonce.', 'luxe-fashion' ) ] );
		return;
	}

	$product_id = isset( $_POST['product_id'] ) ? absint( $_POST['product_id'] ) : 0;
	if ( ! $product_id || ! class_exists( 'WC_Product' ) ) {
		wp_send_json_error( [ 'message' => esc_html__( 'Invalid product ID.', 'luxe-fashion' ) ] );
		return;
	}

	$product = wc_get_product( $product_id );
	if ( ! $product ) {
		wp_send_json_error( [ 'message' => esc_html__( 'Product not found.', 'luxe-fashion' ) ] );
		return;
	}

	$response = [
		'id'       => $product_id,
		'title'    => get_the_title( $product_id ),
		'price'    => $product->get_price_html(),
		'image'    => get_the_post_thumbnail_url( $product_id, 'luxe-product-square' ) ?: '',
		'permalink'=> get_permalink( $product_id ),
		'is_in_stock' => $product->is_in_stock(),
		'add_to_cart_url' => $product->add_to_cart_url(),
	];

	wp_send_json_success( $response );
}

add_action( 'wp_ajax_luxe_quick_view', 'luxe_ajax_quick_view' );
add_action( 'wp_ajax_nopriv_luxe_quick_view', 'luxe_ajax_quick_view' );
