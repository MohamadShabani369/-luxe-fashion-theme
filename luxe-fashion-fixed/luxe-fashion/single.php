<?php
/**
 * Luxe Fashion — Single Post Template
 *
 * Used for individual blog posts. Includes the header,
 * sidebar (if enabled), and the post content with
 * navigation and comments.
 *
 * @package Luxe_Fashion
 * @since 1.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$show_sidebar = (bool) get_theme_mod( 'luxe_show_post_sidebar', false );
?>

<main id="content" class="site-main" role="main">
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?>>
		<header class="single-post-header">
			<h1 class="single-post-title"><?php the_title(); ?></h1>
			<div class="single-post-meta">
				<?php luxe_posted_on(); ?>
				<?php if ( function_exists( 'luxe_entry_footer' ) ) : ?>
					<?php luxe_entry_footer(); ?>
				<?php endif; ?>
			</div>
		</header>

		<div class="single-post-content entry-content">
			<?php the_content(); ?>
			<?php
			wp_link_pages( [
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'luxe-fashion' ),
				'after'  => '</div>',
			] );
			?>
		</div>

		<footer class="single-post-footer">
			<?php
			// Tags displayed at the bottom of each post.
			$tags_list = get_the_tag_list( '', ', ' );
			if ( $tags_list ) {
				printf(
					'<span class="tags-links">%1$s</span>',
					$tags_list
				);
			}
			?>
		</footer>
	</article>

	<?php
	// Post navigation (previous / next).
	the_post_navigation( [
		'prev_text' => '<span class="nav-label">' . esc_html__( 'Previous', 'luxe-fashion' ) . '</span><span class="nav-title">%title</span>',
		'next_text' => '<span class="nav-label">' . esc_html__( 'Next', 'luxe-fashion' ) . '</span><span class="nav-title">%title</span>',
	] );

	// Comments.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
	?>
</main>

<?php
if ( $show_sidebar && is_active_sidebar( 'sidebar-1' ) ) {
	get_template_part( 'template-parts/sidebar', 'primary' );
}

get_footer();