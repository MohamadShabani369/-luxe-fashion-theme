<?php
/**
 * Hero Section
 * @package Luxe_Fashion
 */
declare(strict_types=1);
if ( ! defined( 'ABSPATH' ) ) exit;
$hero_image = get_theme_mod( 'luxe_hero_image', 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1920&q=80' );
$hero_eyebrow   = get_theme_mod( 'luxe_hero_eyebrow', 'NEW COLLECTION' );
$hero_title     = get_theme_mod( 'luxe_hero_title', 'Timeless Elegance for the Modern Woman' );
$hero_subtitle  = get_theme_mod( 'luxe_hero_subtitle', 'Discover our latest collection of curated fashion pieces designed for the contemporary woman.' );
$hero_btn1_text = get_theme_mod( 'luxe_hero_btn1_text', 'Shop Now' );
$hero_btn1_url  = get_theme_mod( 'luxe_hero_btn1_url', home_url( '/shop/' ) );
$hero_btn2_text = get_theme_mod( 'luxe_hero_btn2_text', 'View Lookbook' );
$hero_btn2_url  = get_theme_mod( 'luxe_hero_btn2_url', home_url( '/lookbook/' ) );
?>
<section class="hero-section" style="background-image: url('<?php echo esc_url( $hero_image ); ?>');" aria-label="Hero">
    <div class="hero-overlay"></div>
    <div class="hero-content container">
        <?php if ( $hero_eyebrow ) : ?>
            <p class="hero-eyebrow"><?php echo esc_html( $hero_eyebrow ); ?></p>
        <?php endif; ?>
        <h1 class="hero-title"><?php echo esc_html( $hero_title ); ?></h1>
        <?php if ( $hero_subtitle ) : ?>
            <p class="hero-subtitle"><?php echo esc_html( $hero_subtitle ); ?></p>
        <?php endif; ?>
        <div class="hero-actions">
            <?php if ( $hero_btn1_text ) : ?>
                <a href="<?php echo esc_url( $hero_btn1_url ); ?>" class="btn btn-primary"><?php echo esc_html( $hero_btn1_text ); ?></a>
            <?php endif; ?>
            <?php if ( $hero_btn2_text ) : ?>
                <a href="<?php echo esc_url( $hero_btn2_url ); ?>" class="btn btn-outline"><?php echo esc_html( $hero_btn2_text ); ?></a>
            <?php endif; ?>
        </div>
    </div>
    <div class="hero-scroll" aria-hidden="true">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 9l6 6 6-6"/></svg>
    </div>
</section>
