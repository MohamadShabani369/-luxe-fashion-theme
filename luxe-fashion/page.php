<?php
/**
 * Luxe Fashion — Page Template
 *
 * Used for all static pages. Outputs the content with optional
 * sidebar and breadcrumbs.
 *
 * @package Luxe_Fashion
 * @since 1.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$show_sidebar = (bool) get_theme_mod( 'luxe_show_page_sidebar', true );
?>

<main id="content" class="site-main" role="main">
	<?php
	if ( function_exists( 'luxe_breadcrumb' ) ) {
		luxe_breadcrumb();
	}

	while ( have_posts() ) : the_post();

		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'page' ); ?>>

			<header class="page-header">
				<h1 class="page-title entry-title"><?php the_title(); ?></h1>
			</header>

			<div class="page-content entry-content">
				<?php
				// Output the page content.
				the_content();

				// Link pages for multi-page content.
				if ( post_password_required() ) {
					echo get_the_password_form();
				} else {
					// Edit link for logged-in users.
					edit_post_link(
						'<p class="edit-link">' . get_the_post_navigation( [
							'screen_reader_text' => esc_html__( 'Edit', 'luxe-fashion' ),
						] ) . '</p>'
					);
				}
				?>
			</div>
		</article>
		<?php
	endwhile;

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