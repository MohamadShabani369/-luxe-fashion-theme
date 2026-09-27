<?php
/**
 * Contact CTA Section
 *
 * @package Luxe_Fashion
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>
<section class="contact-cta">
    <div class="container">
        <h2 class="contact-cta-title">
            <?php esc_html_e( 'Discover the Collection', 'luxe-fashion' ); ?>
        </h2>
        <p class="contact-cta-text">
            <?php esc_html_e( 'Explore our latest pieces, curated for the modern woman who values quality and timeless style.', 'luxe-fashion' ); ?>
        </p>
        <a href="/shop/" class="btn">
            <?php esc_html_e( 'Shop Now', 'luxe-fashion' ); ?>
        </a>
    </div>
</section>