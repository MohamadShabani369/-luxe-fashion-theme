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
 * Keep the header cart badge and the slide-in mini-cart panel in sync with
 * the real server-side cart whenever WooCommerce's own AJAX add-to-cart runs
 * (e.g. the "Add to cart" buttons on the shop/archive grid).
 *
 * Without this, those two elements are only ever rendered once, at the top
 * of the page, on normal page load. An AJAX add-to-cart updates the session
 * on the server just fine, but — with nothing telling wc-cart-fragments.js
 * which elements on the page to refresh — the badge and the panel keep
 * showing whatever was true when the page first loaded, which looks like
 * "the item didn't really get added" even though it did.
 *
 * @param array $fragments
 * @return array
 */
function luxe_cart_fragments( array $fragments ) : array {
	if ( ! WC()->cart ) {
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

/* --- Filters --- */

function luxe_dequeue_woocommerce_styles() : void {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return;
    }
    wp_dequeue_style( 'woocommerce-general' );
    wp_dequeue_style( 'woocommerce-layout' );
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

/* --- Price filter --- */
function luxe_filter_by_price( $q ) : void {
    if ( ! class_exists( 'WooCommerce' ) || ! $q->is_main_query() ) {
        return;
    }
    $min = isset( $_GET['min_price'] ) ? floatval( $_GET['min_price'] ) : 0;
    $max = isset( $_GET['max_price'] ) ? floatval( $_GET['max_price'] ) : 0;
    if ( $min > 0 || $max > 0 ) {
        $meta_query = (array) $q->get( 'meta_query' );
        $meta_query[] = array(
            'key'     => '_price',
            'value'   => array( $min, $max ),
            'compare' => 'BETWEEN',
            'type'    => 'NUMERIC',
        );
        $q->set( 'meta_query', $meta_query );
    }
}
add_action( 'woocommerce_product_query', 'luxe_filter_by_price' );

/* --- Sale badge % --- */
function luxe_sale_flash( $html, $post, $product ) : string {
    if ( ! $product || ! $product->is_on_sale() ) {
        return $html;
    }
    $percent = 0;
    $regular = floatval( $product->get_regular_price() );
    $sale    = floatval( $product->get_sale_price() );
    if ( $regular > 0 ) {
        $percent = round( ( ( $regular - $sale ) / $regular ) * 100 );
    }
    if ( $percent > 0 ) {
        return '<span class="luxe-sale-badge">-' . esc_html( $percent ) . '%</span>';
    }
    return $html;
}
add_filter( 'woocommerce_sale_flash', 'luxe_sale_flash', 10, 3 );

/* --- Archive description (category) --- */
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
/* --- Single product sidebar removal --- */
function luxe_single_product_remove_sidebar() : void {
    if ( is_product() ) {
        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
    }
}
add_action( 'wp', 'luxe_single_product_remove_sidebar', 20 );

/* --- Related products args --- */
function luxe_related_products_args( $args ) : array {
    $args['posts_per_page'] = 4;
    $args['columns'] = 4;
    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'luxe_related_products_args' );

/* --- Product tabs customization --- */
function luxe_custom_product_tabs( $tabs ) : array {
    if ( isset( $tabs['additional_information'] ) ) {
        $tabs['additional_information']['title'] = __( 'Details', 'luxe-fashion' );
    }
    foreach ( $tabs as $key => $tab ) {
        if ( $key === 'reviews' ) {
            $count = $tab['callback'] === 'woocommerce_product_reviews_tab' ? ($product = wc_get_product() ? $product->get_review_count() : 0) : 0;
            $tabs[$key]['title'] = sprintf( __( 'Reviews (%d)', 'luxe-fashion' ), $count );
        }
    }
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'luxe_custom_product_tabs', 98 );

/* --- Gallery wrapper class --- */
function luxe_gallery_wrapper_class( $html ) : string {
    if ( is_product() ) {
        $html = str_replace( 'class="woocommerce-product-gallery', 'class="woocommerce-product-gallery luxe-product-gallery', $html );
    }
    return $html;
}
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'luxe_gallery_wrapper_class', 10, 1 );

add_action( 'woocommerce_archive_description', 'luxe_archive_description' );
