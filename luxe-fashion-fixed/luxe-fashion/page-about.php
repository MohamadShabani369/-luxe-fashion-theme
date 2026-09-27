<?php
/**
 * Template Name: About Page
 * Template Post Type: page
 *
 * @package Luxe_Fashion
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main about-page">
    <?php get_template_part( 'template-parts/about/hero' ); ?>
    <?php get_template_part( 'template-parts/about/story' ); ?>
    <?php get_template_part( 'template-parts/about/values' ); ?>
    <?php get_template_part( 'template-parts/about/team' ); ?>
    <?php get_template_part( 'template-parts/about/cta' ); ?>
</main>

<?php
get_footer();
