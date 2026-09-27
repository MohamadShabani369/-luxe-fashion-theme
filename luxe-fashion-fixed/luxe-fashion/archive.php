<?php
/**
 * Luxe Fashion — Archive Template
 *
 * Used for category, tag, author, date, and custom taxonomy
 * archive pages. Displays the archive title, description,
 * and a grid/list of posts.
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

<main id="content" class="site-main" role="main">
	<header class="archive-header">
		<?php
		the_archive_title( '<h1 class="archive-title">', '</h1>' );
		the_archive_description( '<div class="archive-description">', '</div>' );
		?>
	</header>

	<?php
	if ( have_posts() ) :
		?>
		<div class="archive-posts grid">
			<?php
			while ( have_posts() ) : the_post();

				/**
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;
			?>
		</div>

		<?php
		// Numeric pagination.
		the_posts_pagination( [
			'mid_size'           => 2,
			'prev_text'          => esc_html__( 'Previous', 'luxe-fashion' ),
			'next_text'          => esc_html__( 'Next', 'luxe-fashion' ),
			'screen_reader_text' => esc_html__( 'Posts navigation', 'luxe-fashion' ),
		] );
		?>

	<?php else : ?>
		<?php get_template_part( 'template-parts/content', 'none' ); ?>
	<?php endif; ?>
</main>

<?php
get_sidebar();
get_footer();