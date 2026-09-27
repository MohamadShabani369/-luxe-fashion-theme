<?php
/**
 * Contact Hero Section
 *
 * @package Luxe_Fashion
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="contact-hero">
    <div class="container">
        <p class="contact-eyebrow">
            <?php esc_html_e( 'GET IN TOUCH', 'luxe-fashion' ); ?>
        </p>
        <h1 class="contact-hero-title">
            <?php esc_html_e( "We'd Love to Hear From You", 'luxe-fashion' ); ?>
        </h1>
        <p class="contact-hero-subtitle">
            <?php
            esc_html_e(
                'Questions, feedback, or just want to say hello — our team is here.',
                'luxe-fashion'
            );
            ?>
        </p>
    </div>
</section>