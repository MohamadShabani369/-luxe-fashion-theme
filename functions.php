<?php
/**
 * Luxe Fashion theme functions and definitions
 *
 * @package Luxe_Fashion
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Theme setup constants.
 */
define( 'LUXE_THEME_VERSION', '1.0.0' );
define( 'LUXE_THEME_URI', get_template_directory_uri() );
define( 'LUXE_THEME_PATH', get_template_directory() );
define( 'LUXE_ASSET_URI', LUXE_THEME_URI . '/assets' );
define( 'LUXE_TEXT_DOMAIN', 'luxe-fashion' );

/**
 * Load theme includes.
 */
$theme_includes = [
    '/inc/setup.php',
    '/inc/security.php',
    '/inc/enqueue.php',
    '/inc/woocommerce.php',
    '/inc/template-tags.php',
    '/inc/customizer.php',
    '/inc/contact-form.php',
];

foreach ( $theme_includes as $file ) {
    $file_path = LUXE_THEME_PATH . $file;
    if ( file_exists( $file_path ) ) {
        require_once $file_path;
    }
}

/**
 * -------------------------------------------------------------------------
 * WooCommerce Session Fix
 * -------------------------------------------------------------------------
 */

/**
 * Force session cookie creation if WooCommerce hasn't done it yet.
 */
add_action(
    'wp_loaded',
    static function (): void {
        if ( ! function_exists( 'WC' ) || ! WC()->session ) {
            return;
        }

        if ( ! WC()->session->has_session() ) {
            WC()->session->set_customer_session_cookie( true );
        }
    },
    5
);

/**
 * OPTIONAL: Disable secure cookie for session.
 * Uncomment ONLY if you do NOT have HTTPS.
 */
// add_filter( 'wc_session_use_secure_cookie', '__return_false' );

/**
 * Prevent cart / checkout / account pages from being cached.
 */
add_action(
    'template_redirect',
    static function (): void {
        if ( ! function_exists( 'is_cart' ) ) {
            return;
        }

        if ( is_cart() || is_checkout() || is_account_page() ) {
            if ( ! defined( 'DONOTCACHEPAGE' ) ) {
                define( 'DONOTCACHEPAGE', true );
            }

            nocache_headers();

            header( 'Cache-Control: no-store, no-cache, must-revalidate, max-age=0' );
            header( 'Pragma: no-cache' );
            header( 'Expires: 0' );
        }
    }
);

/**
 * Debug bar — only when WP_DEBUG is enabled.
 */
add_action(
    'wp_footer',
    static function (): void {
        if ( ! defined( 'WP_DEBUG' ) || ! WP_DEBUG ) {
            return;
        }

        if ( ! function_exists( 'is_cart' ) || ! is_cart() ) {
            return;
        }

        $count   = ( function_exists( 'WC' ) && WC()->cart ) ? WC()->cart->get_cart_contents_count() : 'N/A';
        $session = ( function_exists( 'WC' ) && WC()->session ) ? 'active' : 'null';

        printf(
            '<div style="position:fixed;bottom:0;left:0;right:0;background:#000;color:#0f0;padding:8px;font-family:monospace;font-size:12px;z-index:99999">Cart Count: %1$s | Session: %2$s | SSL: %3$s</div>',
            esc_html( (string) $count ),
            esc_html( $session ),
            is_ssl() ? 'yes' : 'no'
        );
    }
);