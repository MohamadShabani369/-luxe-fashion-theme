<?php
/**
 * Luxe Fashion — 404 Not Found Template
 *
 * @package Luxe_Fashion
 * @since 1.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="content" class="site-main">
	<article class="error-404 not-found">
		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'luxe-fashion' ); ?></h1>
		</header>

		<div class="page-content">
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Try a search, or head back to the homepage.', 'luxe-fashion' ); ?></p>

			<?php get_search_form(); ?>

			<div class="error-links">
				<h2><?php esc_html_e( 'Take me to:', 'luxe-fashion' ); ?></h2>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Homepage', 'luxe-fashion' ); ?></a></li>
					<li><a href="<?php echo esc_url( get_post_type_archive_link( 'product' ) ); ?>"><?php esc_html_e( 'Shop', 'luxe-fashion' ); ?></a></li>
					<li><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"><?php esc_html_e( 'Blog', 'luxe-fashion' ); ?></a></li>
					<li><a href="<?php echo esc_url( get_permalink( get_option( 'page_on_front' ) ) ); ?>"><?php esc_html_e( 'Front Page', 'luxe-fashion' ); ?></a></li>
				</ul>
			</div>
		</div>
	</article>
</main>

<?php
get_footer();