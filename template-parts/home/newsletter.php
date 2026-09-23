<?php
/**
 * Newsletter Template Part
 *
 * @package Luxe Fashion
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$newsletter_text = get_theme_mod( 'luxe_newsletter_text', 'Get 10% off your first order when you sign up.' );
?>

<section class="newsletter">
	<div class="container">
		<div class="newsletter-content">
			<h2 class="newsletter-title">
				<?php esc_html_e( 'Join the Luxe Community', 'luxe-fashion' ); ?>
			</h2>
			<p class="newsletter-subtitle">
				<?php echo esc_html( $newsletter_text ); ?>
			</p>
			<form class="newsletter-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="post">
				<div class="form-group">
					<input type="email" name="email" class="form-control" placeholder="<?php esc_attr_e( 'Email address', 'luxe-fashion' ); ?>" required>
				</div>
				<button type="submit" class="btn btn-primary btn-lg">
					<?php esc_html_e( 'Subscribe', 'luxe-fashion' ); ?>
				</button>
			</form>
			<p class="newsletter-privacy">
				<?php esc_html_e( 'We respect your privacy. Unsubscribe anytime.', 'luxe-fashion' ); ?>
			</p>
		</div>
	</div>
</section>