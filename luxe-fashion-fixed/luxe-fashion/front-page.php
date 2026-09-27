<?php
/**
 * Front Page Template
 *
 * @package Luxe Fashion
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

<main id="primary" class="site-main">
	<?php
	// Hero Section
	get_template_part( 'template-parts/home/hero' );

	// Featured Categories
	get_template_part( 'template-parts/home/featured-categories' );

	// New Arrivals
	get_template_part( 'template-parts/home/new-arrivals' );

	// Best Sellers
	get_template_part( 'template-parts/home/best-sellers' );

	// Editorial Lookbook
	get_template_part( 'template-parts/home/lookbook' );

	// Brand Story
	get_template_part( 'template-parts/home/brand-story' );

	// Instagram Feed
	get_template_part( 'template-parts/home/instagram' );

	// Newsletter
	get_template_part( 'template-parts/home/newsletter' );
	?>
</main><!-- #main -->

<?php
get_footer();
