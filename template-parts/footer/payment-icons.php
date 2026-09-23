<?php
/**
 * Payment Icons Template Part
 *
 * @package Luxe Fashion
 * @since 1.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'luxe_render_payment_icons' ) ) {
	function luxe_render_payment_icons() : void {
		?>
		<div class="footer-payments">
			<h4 class="footer-heading" aria-label="<?php esc_attr_e( 'Payment methods', 'luxe-fashion' ); ?>">
				<?php esc_html_e( 'Payments', 'luxe-fashion' ); ?>
			</h4>
			<div class="payment-icons" aria-label="<?php esc_attr_e( 'Supported payment methods', 'luxe-fashion' ); ?>">
				<a href="#" aria-label="Visa" class="payment-icon">
					<svg width="36" height="22" viewBox="0 0 36 22" fill="none" aria-hidden="true">
						<rect width="36" height="22" rx="2" fill="#1A1F71"/>
						<text x="18" y="15" text-anchor="middle" fill="#fff" font-family="sans-serif" font-weight="bold" font-size="8">VISA</text>
					</svg>
				</a>
				<a href="#" aria-label="Mastercard" class="payment-icon">
					<svg width="36" height="22" viewBox="0 0 36 22" fill="none" aria-hidden="true">
						<rect width="36" height="22" rx="2" fill="#EB001B"/>
						<circle cx="22" cy="11" r="8" fill="#F79E1B" opacity="0.7"/>
					</svg>
				</a>
				<a href="#" aria-label="PayPal" class="payment-icon">
					<svg width="36" height="22" viewBox="0 0 36 22" fill="none" aria-hidden="true">
						<rect width="36" height="22" rx="2" fill="#003087"/>
						<text x="18" y="15" text-anchor="middle" fill="#fff" font-family="sans-serif" font-size="7">PP</text>
					</svg>
				</a>
				<a href="#" aria-label="Apple Pay" class="payment-icon">
					<svg width="36" height="22" viewBox="0 0 36 22" fill="none" aria-hidden="true">
						<rect width="36" height="22" rx="2" fill="#000"/>
						<text x="18" y="15" text-anchor="middle" fill="#fff" font-family="sans-serif" font-size="7">Apple Pay</text>
					</svg>
				</a>
			</div>
		</div>
		<?php
	}
}

luxe_render_payment_icons();
