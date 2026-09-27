<?php
/**
 * About CTA Section
 *
 * @package Luxe_Fashion
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$cta_title   = get_theme_mod( 'luxe_about_cta_title', 'Discover the Collection' );
$cta_subtitle = get_theme_mod(
    'luxe_about_cta_subtitle',
    'Explore our latest arrivals'
);
$cta_button_text = get_theme_mod( 'luxe_about_cta_button_text', 'Shop Now' );
$cta_button_url = get_theme_mod( 'luxe_about_cta_button_url', '/shop/' );
?>

<section class="about-cta" aria-label="Call to Action">
    <div class="container">
        <div class="about-cta-inner">
            <h2 class="about-cta-title">
                <?php echo esc_html( $cta_title ); ?>
            </h2>
            <p class="about-cta-subtitle">
                <?php echo esc_html( $cta_subtitle ); ?>
            </p>
            <div class="about-cta-btn-wrap">
                <a href="<?php echo esc_url( $cta_button_url ); ?>"
                   class="btn btn-primary">
                    <?php echo esc_html( $cta_button_text ); ?>
                </a>
            </div>
        </div>
    </div>
</section>
