<?php
/**
 * Lookbook Template Part
 *
 * @package Luxe Fashion
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lookbook_image = get_theme_mod( 'luxe_lookbook_image', '' );
$lookbook_content = get_theme_mod( 'luxe_lookbook_content', 'Explore curated looks that blend sophistication with modern edge.' );
$reverse = is_rtl();
?>

<section class="lookbook">
	<div class="container">
		<div class="lookbook-wrapper <?php echo $reverse ? 'reverse' : ''; ?>>
			<div class="lookbook-image">
				<?php if ( ! empty( $lookbook_image ) ) : ?>
					<img src="<?php echo esc_url( $lookbook_image ); ?>" alt="<?php esc_attr_e( 'Lookbook image', 'luxe-fashion' ); ?>" />
				<?php endif; ?>
			</div>
			<div class="lookbook-content" style="text-align:center;">
				<h2 class="lookbook-title">
					<?php esc_html_e( 'Discover the Lookbook', 'luxe-fashion' ); ?>
				</h2>
				<p class="lookbook-text">
					<?php echo esc_html( $lookbook_content ); ?>
				</p>
				<a href="<?php echo esc_url( home_url( '/lookbook/' ) ); ?>" class="btn btn-primary btn-lg">
					<?php esc_html_e( 'Discover the Lookbook', 'luxe-fashion' ); ?>
				</a>
			</div>
		</div>
	</div>
</section>