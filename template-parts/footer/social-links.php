<?php
/**
 * Social Links Template Part
 *
 * @package Luxe Fashion
 * @since 1.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'luxe_render_social_links' ) ) {
	function luxe_render_social_links() : void {
		$social_links = apply_filters( 'luxe_social_links', [
			'instagram' => [
				'url'  => 'https://instagram.com/',
				'label' => __( 'Instagram', 'luxe-fashion' ),
			],
			'pinterest' => [
				'url'  => 'https://pinterest.com/',
				'label' => __( 'Pinterest', 'luxe-fashion' ),
			],
			'youtube' => [
				'url'  => 'https://youtube.com/',
				'label' => __( 'YouTube', 'luxe-fashion' ),
			],
		] );

		?>
		<div class="footer-social">
			<h4 class="footer-heading">
				<?php esc_html_e( 'Connect', 'luxe-fashion' ); ?>
			</h4>
			<div class="social-icons">
				<?php foreach ( $social_links as $key => $link ) : ?>
					<a href="<?php echo esc_url( $link['url'] ); ?>" class="social-icon" aria-label="<?php echo esc_attr( $link['label'] ); ?>" target="_blank" rel="noopener noreferrer">
						<?php if ( 'instagram' === $key ) : ?>
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
								<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
								<circle cx="12" cy="12" r="5"></circle>
								<circle cx="17.5" cy="6.5" r="1.5"></circle>
							</svg>
						<?php elseif ( 'pinterest' === $key ) : ?>
							<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
								<path d="M12 0C5.373 0 0 5.373 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.769-2.249 3.769-5.495 0-2.87-2.062-4.876-5.006-4.876-3.414 0-5.415 2.561-5.415 5.207 0 1.033.397 2.143.892 2.747.098.119.112.224.083.345l-.333 1.36c-.053.22-.174.267-.402.162-1.492-.695-2.424-2.86-2.424-4.845 0-3.965 2.867-7.587 8.25-7.587 4.343 0 7.512 3.098 7.512 7.187 0 4.226-2.662 7.623-6.363 7.623-1.24 0-2.407-.645-2.807-1.404l-.798 3.029c-.3 1.133-1.078 2.547-1.615 3.417C9.074 23.837 10.462 24 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0z"/>
							</svg>
						<?php elseif ( 'youtube' === $key ) : ?>
							<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
								<path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12 9.545 15.568z"/>
							</svg>
						<?php else : ?>
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
								<circle cx="12" cy="12" r="10"></circle>
							</svg>
						<?php endif; ?>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}
}

luxe_render_social_links();
