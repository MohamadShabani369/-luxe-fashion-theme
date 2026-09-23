<?php
/**
 * Newsletter Template Part
 *
 * @package Luxe Fashion
 * @since 1.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'luxe_render_newsletter' ) ) {
	function luxe_render_newsletter() : void {
		?>
		<div class="footer-newsletter">
			<h4 class="footer-heading">
				<?php esc_html_e( 'Stay Updated', 'luxe-fashion' ); ?>
			</h4>
			<p class="footer-newsletter-desc">
				<?php esc_html_e( 'Get exclusive offers and new arrival alerts.', 'luxe-fashion' ); ?>
			</p>
			<form class="newsletter-form" action="#" method="post" aria-label="<?php esc_attr_e( 'Newsletter subscription', 'luxe-fashion' ); ?>">
				<label for="newsletter-email" class="sr-only">
					<?php esc_html_e( 'Email address', 'luxe-fashion' ); ?>
				</label>
				<input type="email" id="newsletter-email" name="email" placeholder="<?php esc_attr_e( 'Your email', 'luxe-fashion' ); ?>" required>
				<button type="submit" class="btn btn-primary">
					<?php esc_html_e( 'Subscribe', 'luxe-fashion' ); ?>
				</button>
			</form>
		</div>
		<?php
	}
}

luxe_render_newsletter();
