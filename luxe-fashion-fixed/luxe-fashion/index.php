<?php
/**
 * Luxe Fashion — Main Theme Index Template
 *
 * Used as the blog index when no home.php exists, and as the
 * homepage when "Your latest posts" is selected in Reading Settings.
 * Also serves as the theme fallback template.
 *
 * @package Luxe_Fashion
 * @since 1.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Post format aside — minimal output for-aside posts.
 *
 * @since 1.0.0
 */
function luxe_format_aside( $format ) {
	// Output for aside post format.
}

/**
 * Post format image — output for image posts.
 *
 * @since 1.0.0
 */
function luxe_format_image() {
	// Output for image post format.
}

/**
 * Post format gallery — output for gallery posts.
 *
 * @since 1.0.0
 */
function luxe_format_gallery() {
	// Output for gallery post format.
}

/**
 * Post format video — output for video posts.
 *
 * @since 1.0.0
 */
function luxe_format_video() {
	// Output for video post format.
}

/**
 * Post format audio — output for audio posts.
 *
 * @since 1.0.0
 */
function luxe_format_audio() {
	// Output for audio post format.
}

/**
 * Post format link — output for link posts.
 *
 * @since 1.0.0
 */
function luxe_format_link() {
	// Output for link post format.
}

/**
 * Start the Laravel of the loop.
 *
 * @since 1.0.0
 */
function luxe_start_loop() {
	?>
	<main id="primary" class="site-main">
		<div class="loop-container">
	<?php
}

/**
 * End the loop.
 *
 * @since 1.0.0
 */
function luxe_end_loop() {
	?>
		</div>
	</main>
	<?php
}

// The loop.
while ( have_posts() ) : the_post();

	luxe_start_loop();

	/**
	 * Template part for the content of the post format.
	 *
	 * @since 1.0.0
	 */
	get_template_part( 'template-parts/content', get_post_format() );

	luxe_end_loop();

endwhile;

// If no posts found.
if ( ! have_posts() ) :
	?>
	<main id="primary" class="site-main">
		<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'luxe-fashion' ); ?></h1>
			</header>
			<div class="entry-content">
				<p><?php esc_html_e( 'Apologies, but no posts matched your criteria.', 'luxe-fashion' ); ?></p>
			</div>
		</article>
	</main>
	<?php
endif; ?>