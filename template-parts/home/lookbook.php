<?php
/**
 * Lookbook Section
 * @package Luxe_Fashion
 */
declare(strict_types=1);
if ( ! defined( 'ABSPATH' ) ) exit;
$lookbook_image = get_theme_mod( 'luxe_lookbook_image', get_template_directory_uri() . '/assets/img/lookbook.jpg' );
$lookbook_eyebrow = get_theme_mod( 'luxe_lookbook_eyebrow', 'EDITORIAL' );
$lookbook_title   = get_theme_mod( 'luxe_lookbook_title', 'Discover the Lookbook' );
$lookbook_text    = get_theme_mod( 'luxe_lookbook_text', 'Explore curated looks that blend sophistication with modern edge. Each piece is handpicked to tell a story of timeless elegance.' );
$lookbook_btn_text = get_theme_mod( 'luxe_lookbook_btn_text', 'Discover More' );
$lookbook_btn_url  = get_theme_mod( 'luxe_lookbook_btn_url', home_url( '/shop/' ) );
?>
<section class="lookbook-section">
    <div class="container">
        <div class="lookbook-inner">
            <div class="lookbook-image">
                <?php if ( file_exists( get_template_directory() . '/assets/img/lookbook.jpg' ) ) : ?>
                    <img src="<?php echo esc_url( $lookbook_image ); ?>" alt="<?php echo esc_attr( $lookbook_title ); ?>" loading="lazy">
                <?php else : ?>
                    <div style="width:100%;height:100%;background:#ebe5dd;display:flex;align-items:center;justify-content:center;">
                        <span style="font-family:serif;font-size:1.5rem;color:#c9a87c;letter-spacing:0.2em;">LOOKBOOK</span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="lookbook-content">
                <?php if ( $lookbook_eyebrow ) : ?>
                    <p class="lookbook-eyebrow"><?php echo esc_html( $lookbook_eyebrow ); ?></p>
                <?php endif; ?>
                <h2 class="lookbook-title"><?php echo esc_html( $lookbook_title ); ?></h2>
                <?php if ( $lookbook_text ) : ?>
                    <p class="lookbook-text"><?php echo esc_html( $lookbook_text ); ?></p>
                <?php endif; ?>
                <?php if ( $lookbook_btn_text ) : ?>
                    <a href="<?php echo esc_url( $lookbook_btn_url ); ?>" class="btn btn-outline-dark"><?php echo esc_html( $lookbook_btn_text ); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
