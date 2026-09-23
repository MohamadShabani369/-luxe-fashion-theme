<?php
/**
 * Luxe Fashion - Theme Footer Template
 *
 * @package Luxe Fashion
 * @since 1.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the newsletter form markup.
 *
 * @return string
 */
if ( ! function_exists( 'luxe_get_newsletter_form' ) ) {
	function luxe_get_newsletter_form() : string {
		$action = esc_url( admin_url( 'admin-ajax.php' ) );
		$label  = esc_html__( 'Subscribe to our newsletter', 'luxe-fashion' );
		$placeholder = esc_attr__( 'Your email address', 'luxe-fashion' );
		$button_text = esc_attr__( 'Subscribe', 'luxe-fashion' );

		return sprintf(
			'<form class="newsletter-form" action="%s" method="post" aria-label="%s">',
			$action,
			$label
		) . sprintf(
			'<label class="sr-only" for="newsletter-email">%s</label>',
			$label
		) . sprintf(
			'<input type="email" id="newsletter-email" name="email" placeholder="%s" required>',
			$placeholder
		) . sprintf(
			'<button type="submit" class="btn btn-primary newsletter-submit">%s</button>',
			$button_text
		) . '</form>';
	}
}

/**
 * Render the footer template parts when they exist.
 *
 * @return void
 */
if ( ! function_exists( 'luxe_render_footer_parts' ) ) {
	function luxe_render_footer_parts() : void {
		$parts = [
			'template-parts/footer/newsletter',
			'template-parts/footer/social-links',
			'template-parts/footer/payment-icons',
		];

		foreach ( $parts as $part ) {
			$part_path = get_template_directory() . '/' . $part . '.php';
			if ( ! file_exists( $part_path ) ) {
				continue;
			}

			$template_parts = explode( '/', $part, 2 );
			get_template_part( $template_parts[0], $template_parts[1] );
		}
	}
}

?><footer id="colophon" class="site-footer" role="contentinfo">
	<?php luxe_render_footer_parts(); ?>

	<div class="footer-grid container">
		<div class="footer-col brand-col">
			<div class="footer-branding">
				<?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<p class="footer-site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
					</p>
				<?php endif; ?>
				<?php if ( get_bloginfo( 'description', 'display' ) ) : ?>
					<p class="footer-tagline">
						<?php echo esc_html( get_bloginfo( 'description', 'display' ) ); ?>
					</p>
				<?php endif; ?>
			</div>
			<div class="footer-social">
				<h3 class="footer-heading">
					<?php esc_html_e( 'Follow', 'luxe-fashion' ); ?>
				</h3>
				<div class="social-icons">
					<a href="#" class="social-icon" aria-label="Facebook">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
							<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.914v2.213h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
						</svg>
					</a>
					<a href="#" class="social-icon" aria-label="Instagram">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
							<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
							<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
							<line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
						</svg>
					</a>
					<a href="#" class="social-icon" aria-label="Twitter">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
							<path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
						</svg>
					</a>
				</div>
			</div>
		</div>

		<div class="footer-col">
			<h3 class="footer-heading">
				<?php esc_html_e( 'Shop', 'luxe-fashion' ); ?>
			</h3>
			<ul class="footer-links">
				<li><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
					<?php esc_html_e( 'All Products', 'luxe-fashion' ); ?>
				</a></li>
				<li><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?filter=new">
					<?php esc_html_e( 'New Arrivals', 'luxe-fashion' ); ?>
				</a></li>
				<li><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?filter=sale">
					<?php esc_html_e( 'Sale', 'luxe-fashion' ); ?>
				</a></li>
				<li><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?filter=dress">
					<?php esc_html_e( 'Dresses', 'luxe-fashion' ); ?>
				</a></li>
				<li><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?filter=accessories">
					<?php esc_html_e( 'Accessories', 'luxe-fashion' ); ?>
				</a></li>
			</ul>
		</div>

		<div class="footer-col">
			<h3 class="footer-heading">
				<?php esc_html_e( 'Help', 'luxe-fashion' ); ?>
			</h3>
			<ul class="footer-links">
				<li><a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>">
					<?php esc_html_e( 'My Account', 'luxe-fashion' ); ?>
				</a></li>
				<li><a href="<?php echo esc_url( wc_get_page_permalink( 'order-tracking' ) ); ?>">
					<?php esc_html_e( 'Track Order', 'luxe-fashion' ); ?>
				</a></li>
				<li><a href="<?php echo esc_url( wc_get_page_permalink( 'shipping' ) ); ?>">
					<?php esc_html_e( 'Shipping Info', 'luxe-fashion' ); ?>
				</a></li>
				<li><a href="<?php echo esc_url( wc_get_page_permalink( 'returns' ) ); ?>">
					<?php esc_html_e( 'Returns', 'luxe-fashion' ); ?>
				</a></li>
				<li><a href="#">
					<?php esc_html_e( 'FAQ', 'luxe-fashion' ); ?>
				</a></li>
			</ul>
		</div>

		<div class="footer-col newsletter-col">
			<h3 class="footer-heading">
				<?php esc_html_e( 'Newsletter', 'luxe-fashion' ); ?>
			</h3>
			<p class="footer-newsletter-text">
				<?php esc_html_e( 'Subscribe for exclusive offers and updates.', 'luxe-fashion' ); ?>
			</p>
			<?php echo wp_kses_post( luxe_get_newsletter_form() ); ?>
		</div>
	</div>

	<div class="footer-bottom container">
		<div class="footer-bottom-inner">
			<p class="footer-copy">
				<?php
				$year = date_i18n( 'Y' );
				printf(
					esc_html__( '© %1$s %2$s. All rights reserved.', 'luxe-fashion' ),
					$year,
					esc_html( get_bloginfo( 'name' ) )
				);
				?>
			</p>
			<div class="footer-payments">
				<h3 class="footer-heading footer-payments-heading">
					<?php esc_html_e( 'We Accept', 'luxe-fashion' ); ?>
				</h3>
				<div class="payment-icons">
					<svg width="40" height="25" viewBox="0 0 40 25" aria-label="Visa">
						<rect width="40" height="25" rx="3" fill="#1a1f71"/>
						<text x="20" y="17" text-anchor="middle" fill="#fff" font-size="10" font-weight="bold" font-family="sans-serif">VISA</text>
					</svg>
					<svg width="40" height="25" viewBox="0 0 40 25" aria-label="Mastercard">
						<rect width="40" height="25" rx="3" fill="#f5f5f5"/>
						<circle cx="15" cy="12.5" r="8" fill="#eb001b" opacity="0.8"/>
						<circle cx="25" cy="12.5" r="8" fill="#f79e1b" opacity="0.8"/>
					</svg>
					<svg width="40" height="25" viewBox="0 0 40 25" aria-label="PayPal">
						<rect width="40" height="25" rx="3" fill="#003087"/>
						<text x="20" y="16" text-anchor="middle" fill="#fff" font-size="8" font-weight="bold" font-family="sans-serif">PP</text>
					</svg>
					<svg width="40" height="25" viewBox="0 0 40 25" aria-label="American Express">
						<rect width="40" height="25" rx="3" fill="#016fd0"/>
						<text x="20" y="16" text-anchor="middle" fill="#fff" font-size="7" font-weight="bold" font-family="sans-serif">AMEX</text>
					</svg>
					<svg width="40" height="25" viewBox="0 0 40 25" aria-label="Apple Pay">
						<rect width="40" height="25" rx="3" fill="#000"/>
						<text x="20" y="16" text-anchor="middle" fill="#fff" font-size="7" font-family="sans-serif">Pay</text>
					</svg>
				</div>
			</div>
		</div>
	</div>
</footer>

<button type="button" class="back-to-top" aria-label="<?php esc_attr_e( 'Back to top', 'luxe-fashion' ); ?>">
	<svg class="progress-ring" width="44" height="44" viewBox="0 0 44 44" aria-hidden="true">
		<circle class="progress-ring-track" cx="22" cy="22" r="18" fill="none" stroke="var(--color-border)" stroke-width="3"/>
		<circle class="progress-ring-fill" cx="22" cy="22" r="18" fill="none" stroke="var(--color-accent)" stroke-width="3" stroke-dasharray="113" stroke-dashoffset="113" stroke-linecap="round"/>
	</svg>
	<span class="back-to-top-arrow" aria-hidden="true">↑</span>
</button>
