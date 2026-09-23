<?php
/**
 * Luxe Fashion — Theme Footer Template
 *
 * @package Luxe_Fashion
 * @since 1.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output the footer widget areas.
 *
 * @since 1.0.0
 */
function luxe_footer_widgets() {
	$show_footer = (bool) get_theme_mod( 'luxe_show_footer', true );
	if ( ! $show_footer ) {
		return;
	}

	?>
	<aside class="site-footer-widget-area" role="complementary">
		<div class="container footer-widget-row">
			<?php
			$widgets = [
				'footer-1' => esc_html__( 'Footer 1', 'luxe-fashion' ),
				'footer-2' => esc_html__( 'Footer 2', 'luxe-fashion' ),
				'footer-3' => esc_html__( 'Footer 3', 'luxe-fashion' ),
				'footer-4' => esc_html__( 'Footer 4', 'luxe-fashion' ),
			];

			foreach ( $widgets as $id => $label ) {
				if ( is_active_sidebar( $id ) ) {
					?>
					<div class="footer-widget-column">
						<?php dynamic_sidebar( $id ); ?>
					</div>
					<?php
				}
			}
			?>
		</div>
	</aside>
	<?php
}

/**
 * Output the footer copyright and credits.
 *
 * @since 1.0.0
 */
function luxe_footer_copyright() {
	$year = date_i18n( 'Y' );
	$copyright = sprintf(
		/* translators: %1$s: current year, %2$s: site name, %3$s: theme author */
		_x( '&copy; %1$s %2$s. All rights reserved.', 'Copyright notice', 'luxe-fashion' ),
		$year,
		get_bloginfo( 'name' ),
		_x( 'Luxe Fashion', 'Theme author', 'luxe-fashion' )
	);

	?>
	<footer class="site-footer" role="contentinfo">
		<div class="container footer-inner">
			<div class="footer-copy">
				<?php echo wp_kses_post( $copyright ); ?>
			</div>
			<?php
			// Secondary navigation in footer.
			$footer_menu = wp_nav_menu( [
				'theme_location' => 'footer',
				'container'      => false,
				'menu_class'     => 'footer-nav',
				'fallback_cb'    => false,
				'depth'          => 1,
				'echo'           => false,
			] );
			if ( $footer_menu ) {
				echo '<nav class="footer-nav">' . $footer_menu . '</nav>';
			}
			?>
		</div>
	</footer>
	<?php
}

/**
 * Output the footer markup.
 *
 * @since 1.0.0
 */
function luxe_footer() {
	luxe_footer_widgets();
	luxe_footer_copyright();
}

luxe_footer();

wp_footer();