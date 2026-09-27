<?php
/**
 * Announcement Bar Template Part
 *
 * @package Luxe Fashion
 * @since 1.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the announcement bar text.
 *
 * @return string
 */
if ( ! function_exists( 'luxe_get_announcement_text' ) ) {
	function luxe_get_announcement_text() : string {
		$text = get_theme_mod( 'luxe_announcement_text', 'Free shipping on orders over $200' );

		return esc_html( $text );
	}
}

$announcement = luxe_get_announcement_text();

if ( ! empty( $announcement ) ) : ?>
	<div class="announcement-bar" role="banner">
		<div class="container announcement-inner">
			<p class="announcement-text">
				<?php echo esc_html( $announcement ); ?>
			</p>
		</div>
	</div>
<?php endif;
