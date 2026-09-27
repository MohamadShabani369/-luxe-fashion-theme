<?php
/**
 * Template Name: Contact Page
 * Template Post Type: page
 *
 * @package Luxe_Fashion
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main contact-page">
    <?php get_template_part( 'template-parts/contact/hero' ); ?>
    <?php get_template_part( 'template-parts/contact/info' ); ?>
    <?php get_template_part( 'template-parts/contact/form' ); ?>
    <?php get_template_part( 'template-parts/contact/social-hours' ); ?>
    <?php get_template_part( 'template-parts/contact/cta' ); ?>
</main>

<?php
get_footer();