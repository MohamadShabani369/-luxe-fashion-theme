<?php
/**
 * Mobile Menu Template Part
 *
 * Off-canvas navigation for mobile devices.
 *
 * @package Luxe Fashion
 * @since 1.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return mobile menu navigation items.
 *
 * @return array
 */
if ( ! function_exists( 'luxe_get_mobile_menu_items' ) ) {
	function luxe_get_mobile_menu_items() : array {
		$items = [];

		if ( function_exists( 'wp_get_nav_menu_locations' ) ) {
			$locations = wp_get_nav_menu_locations();
			$menu_id   = isset( $locations['primary'] )
				? (int) $locations['primary']
				: 0;
			$items     = $menu_id
				? (array) wp_get_nav_menu_items( $menu_id )
				: [];
		}

		if ( empty( $items ) && function_exists( 'get_pages' ) ) {
			$pages = get_pages( [
				'sort_column'  => 'menu_order',
				'hierarchical' => true,
			] );
			$items = is_array( $pages ) ? $pages : [];
		}

		return $items;
	}
}

?>
<nav id="mobile-menu" class="mobile-menu" role="navigation" aria-label="<?php esc_attr_e( 'Mobile Menu', 'luxe-fashion' ); ?>">
	<div class="mobile-menu-header">
		<h3 class="mobile-menu-title">
			<?php esc_html_e( 'Menu', 'luxe-fashion' ); ?>
		</h3>
		<button type="button" class="mobile-menu-close" aria-label="<?php esc_attr_e( 'Close menu', 'luxe-fashion' ); ?>">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
				<line x1="18" y1="6" x2="6" y2="18"></line>
				<line x1="6" y1="6" x2="18" y2="18"></line>
			</svg>
		</button>
	</div>
	<ul class="mobile-menu-list">
		<?php foreach ( luxe_get_mobile_menu_items() as $item ) : ?>
			<?php
			$url   = isset( $item->url ) ? esc_url( $item->url ) : home_url( '/' );
			$title = isset( $item->title ) ? esc_html( $item->title ) : '';
			?>
			<li class="mobile-menu-item">
				<a href="<?php echo $url; ?>" class="mobile-menu-link">
					<?php echo $title; ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
	<div class="mobile-menu-icons">
		<?php
		$account_url = function_exists( 'wc_get_page_permalink' )
			? esc_url( wc_get_page_permalink( 'myaccount' ) )
			: home_url( '/' );
		?>
		<a href="<?php echo $account_url; ?>" class="mobile-menu-icon-link">
			<?php esc_html_e( 'My Account', 'luxe-fashion' ); ?>
		</a>
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="mobile-menu-icon-link">
			<?php esc_html_e( 'Cart', 'luxe-fashion' ); ?>
		</a>
	</div>
</nav>
<div class="mobile-menu-overlay"></div>
