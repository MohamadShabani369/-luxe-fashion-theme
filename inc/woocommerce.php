<?php
/**
 * WooCommerce integration, hooks and customizations.
 *
 * @package Luxe_Fashion
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* -------------------------------------------------------------------------
 * Theme support
 * ---------------------------------------------------------------------- */

function luxe_woocommerce_support() : void {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return;
    }

    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    add_theme_support( 'custom-logo' );
}
add_action( 'after_setup_theme', 'luxe_woocommerce_support', 20 );

/* -------------------------------------------------------------------------
 * Gallery args
 * ---------------------------------------------------------------------- */

function luxe_modify_product_gallery_args( $args ) {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return $args;
    }

    $args['thumbnail_size_w'] = 100;
    $args['thumbnail_size_h'] = 100;
    $args['thumbnail_crop']   = 1;
    $args['woocommerce_single_image_width']  = 800;
    $args['woocommerce_single_image_height'] = 1000;

    return $args;
}
add_filter( 'woocommerce_gallery_image_args', 'luxe_modify_product_gallery_args', 10, 1 );

/* -------------------------------------------------------------------------
 * Remove default hooks
 * ---------------------------------------------------------------------- */

function luxe_remove_woocommerce_hooks() : void {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return;
    }

    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 20 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
}
add_action( 'init', 'luxe_remove_woocommerce_hooks' );

/* -------------------------------------------------------------------------
 * Body classes
 * ---------------------------------------------------------------------- */

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

/* -------------------------------------------------------------------------
 * AJAX: Refresh cart fragments (mini-cart badge + panel)
 * ---------------------------------------------------------------------- */

function luxe_ajax_mini_cart() : void {
    if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
        wp_send_json_error( [ 'message' => 'Cart unavailable.' ] );
        return;
    }

    $nonce = isset( $_REQUEST['nonce'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ) : '';
    if ( ! wp_verify_nonce( $nonce, 'luxe_ajax_nonce' ) ) {
        wp_send_json_error( [ 'message' => 'Invalid nonce.' ] );
        return;
    }

    // ✅ Correct method name (was get_refresh_fragments — wrong).
    WC_AJAX::get_refreshed_fragments();
}
add_action( 'wp_ajax_luxe_mini_cart', 'luxe_ajax_mini_cart' );
add_action( 'wp_ajax_nopriv_luxe_mini_cart', 'luxe_ajax_mini_cart' );

/* -------------------------------------------------------------------------
 * AJAX: Add to cart
 * ---------------------------------------------------------------------- */

function luxe_ajax_add_to_cart() : void {
    if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
        wp_send_json_error( [ 'message' => 'Cart unavailable.' ] );
        return;
    }

    $nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
    if ( ! wp_verify_nonce( $nonce, 'luxe_ajax_nonce' ) ) {
        wp_send_json_error( [ 'message' => 'Invalid nonce.' ] );
        return;
    }

    $product_id   = isset( $_POST['product_id'] ) ? absint( $_POST['product_id'] ) : 0;
    $quantity     = isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : 1;
    $variation_id = isset( $_POST['variation_id'] ) ? absint( $_POST['variation_id'] ) : 0;
    $variation    = [];

    if ( ! $product_id ) {
        wp_send_json_error( [ 'message' => 'Invalid product ID.' ] );
        return;
    }

    $passed = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variation );
    if ( ! $passed ) {
        wp_send_json_error( [ 'message' => 'Validation failed.' ] );
        return;
    }

    $added = WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation );

    if ( ! $added ) {
        wp_send_json_error( [ 'message' => 'Could not add to cart.' ] );
        return;
    }

    // ✅ Recalculate totals.
    WC()->cart->calculate_totals();

    // ✅ This method sets the session cookies AND sends JSON fragments.
    WC_AJAX::get_refreshed_fragments();
}
add_action( 'wp_ajax_luxe_add_to_cart', 'luxe_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_luxe_add_to_cart', 'luxe_ajax_add_to_cart' );

/* -------------------------------------------------------------------------
 * Cart fragments filter (badge + mini-cart panel)
 * ---------------------------------------------------------------------- */

function luxe_cart_fragments( array $fragments ) : array {
    if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
        return $fragments;
    }

    ob_start();
    ?>
    <span class="cart-count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
    <?php
    $fragments['span.cart-count'] = ob_get_clean();

    ob_start();
    get_template_part( 'template-parts/header/mini-cart' );
    $fragments['#mini-cart'] = ob_get_clean();

    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'luxe_cart_fragments' );

/* -------------------------------------------------------------------------
 * AJAX: Quick view
 * ---------------------------------------------------------------------- */

function luxe_ajax_quick_view() : void {
    if ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) {
        wp_send_json_error( [ 'message' => 'Not an AJAX request.' ] );
        return;
    }

    $nonce = isset( $_REQUEST['nonce'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ) : '';
    if ( ! wp_verify_nonce( $nonce, 'luxe_ajax_nonce' ) ) {
        wp_send_json_error( [ 'message' => 'Invalid nonce.' ] );
        return;
    }

    $product_id = isset( $_POST['product_id'] ) ? absint( $_POST['product_id'] ) : 0;
    if ( ! $product_id || ! class_exists( 'WC_Product' ) ) {
        wp_send_json_error( [ 'message' => 'Invalid product ID.' ] );
        return;
    }

    $product = wc_get_product( $product_id );
    if ( ! $product ) {
        wp_send_json_error( [ 'message' => 'Product not found.' ] );
        return;
    }

    wp_send_json_success( [
        'id'              => $product_id,
        'title'           => get_the_title( $product_id ),
        'price'           => $product->get_price_html(),
        'image'           => get_the_post_thumbnail_url( $product_id, 'luxe-product-square' ) ?: '',
        'permalink'       => get_permalink( $product_id ),
        'is_in_stock'     => $product->is_in_stock(),
        'add_to_cart_url' => $product->add_to_cart_url(),
    ] );
}
add_action( 'wp_ajax_luxe_quick_view', 'luxe_ajax_quick_view' );
add_action( 'wp_ajax_nopriv_luxe_quick_view', 'luxe_ajax_quick_view' );

/* -------------------------------------------------------------------------
 * Filters
 * ---------------------------------------------------------------------- */

function luxe_dequeue_woocommerce_styles() : void {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return;
    }
    // Only dequeue if your theme fully replaces these styles.
    // wp_dequeue_style( 'woocommerce-general' );
    // wp_dequeue_style( 'woocommerce-layout' );
}
add_action( 'wp_enqueue_scripts', 'luxe_dequeue_woocommerce_styles', 20 );

function luxe_set_products_per_row() : int {
    return 3;
}
add_filter( 'loop_shop_columns', 'luxe_set_products_per_row' );

function luxe_set_products_per_page( int $cols ) : int {
    return 12;
}
add_filter( 'loop_shop_per_page', 'luxe_set_products_per_page' );

/* Price filter */
function luxe_filter_by_price( $meta_query, $query ) {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return $meta_query;
    }

    $min = isset( $_GET['min_price'] ) ? floatval( $_GET['min_price'] ) : 0;
    $max = isset( $_GET['max_price'] ) ? floatval( $_GET['max_price'] ) : 0;

    if ( $min > 0 || $max > 0 ) {
        $meta_query[] = [
            'key'     => '_price',
            'value'   => [ $min, $max ],
            'compare' => 'BETWEEN',
            'type'    => 'NUMERIC',
        ];
    }

    return $meta_query;
}
add_filter( 'woocommerce_product_query_meta_query', 'luxe_filter_by_price', 10, 2 );

/* Sale badge */
function luxe_sale_flash( $html, $post, $product ) : string {
    if ( ! $product || ! $product->is_on_sale() ) {
        return $html;
    }

    $regular = floatval( $product->get_regular_price() );
    $sale    = floatval( $product->get_sale_price() );
    $percent = ( $regular > 0 ) ? round( ( ( $regular - $sale ) / $regular ) * 100 ) : 0;

    if ( $percent > 0 ) {
        return '<span class="luxe-sale-badge">-' . esc_html( $percent ) . '%</span>';
    }

    return $html;
}
add_filter( 'woocommerce_sale_flash', 'luxe_sale_flash', 10, 3 );

/* Archive description */
function luxe_archive_description() : void {
    if ( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) {
        $term = get_queried_object();
        if ( $term && ! is_wp_error( $term ) ) {
            echo '<div class="archive-description">';
            echo '<h2>' . esc_html( $term->name ) . '</h2>';
            if ( $term->description ) {
                echo '<p>' . esc_html( $term->description ) . '</p>';
            }
            echo '</div>';
        }
    }
}
add_action( 'woocommerce_archive_description', 'luxe_archive_description' );

/* Single product sidebar removal */
function luxe_single_product_remove_sidebar() : void {
    if ( is_product() ) {
        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
    }
}
add_action( 'wp', 'luxe_single_product_remove_sidebar', 20 );

/* Related products */
function luxe_related_products_args( $args ) : array {
    $args['posts_per_page'] = 4;
    $args['columns']        = 4;
    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'luxe_related_products_args' );

/* Product tabs */
function luxe_custom_product_tabs( $tabs ) : array {
    global $product;

    if ( isset( $tabs['additional_information'] ) ) {
        $tabs['additional_information']['title'] = __( 'Details', 'luxe-fashion' );
    }

    if ( isset( $tabs['reviews'] ) && $product instanceof WC_Product ) {
        $tabs['reviews']['title'] = sprintf(
            __( 'Reviews (%d)', 'luxe-fashion' ),
            $product->get_review_count()
        );
    }

    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'luxe_custom_product_tabs', 98 );

/* Gallery wrapper class */
function luxe_gallery_wrapper_class( $html ) : string {
    if ( is_product() ) {
        $html = str_replace(
            'class="woocommerce-product-gallery',
            'class="woocommerce-product-gallery luxe-product-gallery',
            $html
        );
    }
    return $html;
}
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'luxe_gallery_wrapper_class', 10, 1 );