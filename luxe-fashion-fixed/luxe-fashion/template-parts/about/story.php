<?php
/**
 * About Story Section
 *
 * @package Luxe_Fashion
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$story_image = get_theme_mod(
    'luxe_about_story_image',
    get_template_directory_uri() . '/assets/img/about-story.jpg'
);
$story_text = get_theme_mod(
    'luxe_about_story_text',
    'Founded on the belief that true elegance never fades, we curate pieces that speak to the modern woman who values substance alongside style. Every garment begins with intention — from the selection of sustainable materials to the hands that craft them.'
);
?>
<section class="about-story">
    <div class="container">
        <div class="about-story-grid">

            <div class="about-story-image">
                <img
                    src="<?php echo esc_url( $story_image ); ?>"
                    alt="<?php esc_attr_e( 'Our story', 'luxe-fashion' ); ?>"
                    loading="lazy"
                >
            </div>

            <div class="about-story-content">
                <p class="about-eyebrow">
                    <?php esc_html_e( 'OUR STORY', 'luxe-fashion' ); ?>
                </p>
                <h2 class="about-story-title">
                    <?php esc_html_e( 'Where Elegance Meets Purpose', 'luxe-fashion' ); ?>
                </h2>
                <p class="about-story-text">
                    <?php echo esc_html( $story_text ); ?>
                </p>
            </div>

        </div>
    </div>
</section>