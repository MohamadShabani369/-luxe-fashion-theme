<?php
/**
 * Luxe Fashion — Sidebar Template
 *
 * Renders the primary sidebar. Only outputs if the sidebar is
 * active and the current page supports it.
 *
 * @package Luxe_Fashion
 * @since 1.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output the sidebar.
 *
 * @since 1.0.0
 */
function luxe_sidebar() {
	// Don't show sidebar on WooCommerce cart/checkout/account pages.
	if ( class_exists( 'WooCommerce' ) && ( is_cart() || is_checkout() || is_account_page() ) ) {
		return;
	}

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		return;
	}

	?>
	<aside id="secondary" class="site-sidebar" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar', 'luxe-fashion' ); ?>">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside>
	<?php
}

luxe_sidebar();