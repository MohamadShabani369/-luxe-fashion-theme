<?php
/**
 * About Hero Section
 *
 * @package Luxe_Fashion
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$hero_image = get_theme_mod(
    'luxe_about_hero_image',
    get_template_directory_uri() . '/assets/img/about-hero.jpg'
);
$hero_eyebrow  = get_theme_mod( 'luxe_about_hero_eyebrow', 'ABOUT US' );
$hero_title    = get_theme_mod(
    'luxe_about_hero_title',
    'Crafted with Intention'
);
$hero_subtitle = get_theme_mod(
    'luxe_about_hero_subtitle',
    'A story of timeless elegance and modern sensibility.'
);
?>
<section
    class="about-hero"
    style="background-image: url('<?php echo esc_url( $hero_image ); ?>');"
>
    <div class="about-hero-overlay" aria-hidden="true"></div>

    <div class="about-hero-content">
        <?php if ( $hero_eyebrow ) : ?>
            <p class="about-eyebrow about-eyebrow-light">
                <?php echo esc_html( $hero_eyebrow ); ?>
            </p>
        <?php endif; ?>

        <h1 class="about-hero-title">
            <?php echo esc_html( $hero_title ); ?>
        </h1>

        <?php if ( $hero_subtitle ) : ?>
            <p class="about-hero-subtitle">
                <?php echo esc_html( $hero_subtitle ); ?>
            </p>
        <?php endif; ?>
    </div>
</section>