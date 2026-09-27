<?php
/**
 * Mega Menu Template Part
 *
 * Displays a product category grid under the Shop link.
 *
 * @package Luxe Fashion
 * @since 1.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return product category data for the mega menu.
 *
 * @return array
 */
if ( ! function_exists( 'luxe_get_mega_menu_categories' ) ) {
	function luxe_get_mega_menu_categories() : array {
		if ( ! function_exists( 'wc_get_product_categories' ) ) {
			return [];
		}

		$categories = wc_get_product_categories( 0, [
			'hide_empty' => true,
			'number'     => 12,
		] );

		if ( is_wp_error( $categories ) || empty( $categories ) ) {
			return [];
		}

		$results = [];
		foreach ( $categories as $cat ) {
			$results[] = [
				'name'     => $cat->name,
				'slug'     => $cat->slug,
				'count'    => (int) $cat->count,
				'link'     => get_term_link( $cat ),
				'thumbnail' => '',
			];
		}

		return $results;
	}
}

$categories = luxe_get_mega_menu_categories();

if ( ! empty( $categories ) ) : ?>
	<div id="shop-mega-menu" class="mega-menu" role="region" aria-label="<?php esc_attr_e( 'Shop categories', 'luxe-fashion' ); ?>">
		<div class="container mega-menu-inner">
			<div class="mega-menu-grid">
				<?php foreach ( $categories as $cat ) : ?>
					<a href="<?php echo esc_url( $cat['link'] ); ?>" class="mega-menu-item">
						<?php echo esc_html( $cat['name'] ); ?>
						<span class="mega-menu-count">
							<?php printf( esc_html__( '%d items', 'luxe-fashion' ), $cat['count'] ); ?>
						</span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php endif;
