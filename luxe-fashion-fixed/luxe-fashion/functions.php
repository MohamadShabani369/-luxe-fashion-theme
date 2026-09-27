<?php
/**
 * Luxe Fashion theme functions and definitions
 *
 * @package Luxe_Fashion
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Theme setup constants — loaded before includes so child overrides or
 * early hooks can reference them without relying on function call order.
 */
define( 'LUXE_THEME_VERSION', '1.0.0' );
define( 'LUXE_THEME_URI', get_template_directory_uri() );
define( 'LUXE_THEME_PATH', get_template_directory() );
define( 'LUXE_ASSET_URI', LUXE_THEME_URI . '/assets' );
define( 'LUXE_TEXT_DOMAIN', 'luxe-fashion' );

/**
 * Load all theme includes. Each file is responsible for a single concern
 * (single responsibility). Guard with function_exists to allow child-theme
 * overrides without redeclaration errors.
 */
$theme_includes = [
	'/inc/setup.php',         // Theme supports, menus, image sizes, custom logos.
	'/inc/security.php',      // Sanitization and escaping helpers.
	'/inc/enqueue.php',       // Script and style registration / enqueueing.
	'/inc/woocommerce.php',   // WooCommerce hooks and customizations.
	'/inc/template-tags.php', // Reusable template helper functions.
	'/inc/customizer.php',    // Theme options via the Customizer API.
	'/inc/contact-form.php',  // Contact form handler and messaging.
];

foreach ( $theme_includes as $file ) {
	$file_path = LUXE_THEME_PATH . $file;
	if ( file_exists( $file_path ) ) {
		require_once $file_path;
	}
}