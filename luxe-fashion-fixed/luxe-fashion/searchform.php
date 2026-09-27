<?php
/**
 * Luxe Fashion — Search Form Template
 *
 * Outputs a search form styled for the brand. The form action is
 * the site search URL. The input name is `s` so WordPress can
 * parse the query.
 *
 * @package Luxe_Fashion
 * @since 1.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output the search form.
 *
 * @since 1.0.0
 */
function luxe_search_form() {
	$unique_id = 'searchform-' . wp_rand( 0, 9999 );
	?>
	<form class="search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label class="screen-reader-text" for="<?php echo esc_attr( $unique_id ); ?>">
			<?php _e( 'Search for:', 'luxe-fashion' ); ?>
		</label>
		<input type="search" id="<?php echo esc_attr( $unique_id ); ?>" class="search-field"
			name="s" value="<?php echo esc_attr( get_search_query() ); ?>"
			aria-label="<?php esc_attr_e( 'Search', 'luxe-fashion' ); ?>"
			placeholder="<?php esc_attr_e( 'Search products...', 'luxe-fashion' ); ?>"
			autocomplete="off">
		<button type="submit" class="search-submit" aria-label="<?php esc_attr_e( 'Search', 'luxe-fashion' ); ?>">
			<span class="screen-reader-text"><?php esc_html_e( 'Search', 'luxe-fashion' ); ?></span>
			<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
				<circle cx="11" cy="11" r="7"></circle>
				<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
			</svg>
		</button>
	</form>
	<?php
}

luxe_search_form();