<?php
/**
 * Search Overlay Template Part
 *
 * @package Luxe Fashion
 * @since 1.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div id="search-overlay" class="search-overlay" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Search', 'luxe-fashion' ); ?>">
	<div class="search-overlay-backdrop"></div>
	<div class="search-overlay-panel">
		<button type="button" class="search-overlay-close" aria-label="<?php esc_attr_e( 'Close search', 'luxe-fashion' ); ?>">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
				<line x1="18" y1="6" x2="6" y2="18"></line>
				<line x1="6" y1="6" x2="18" y2="18"></line>
			</svg>
		</button>
		<form class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search">
			<label for="search-input" class="sr-only">
				<?php esc_html_e( 'Search products', 'luxe-fashion' ); ?>
			</label>
			<input type="search" id="search-input" name="s" placeholder="<?php esc_attr_e( 'Search products…', 'luxe-fashion' ); ?>" autocomplete="off" autofocus>
			<button type="submit" class="btn btn-primary">
				<?php esc_html_e( 'Search', 'luxe-fashion' ); ?>
			</button>
		</form>
	</div>
</div>
