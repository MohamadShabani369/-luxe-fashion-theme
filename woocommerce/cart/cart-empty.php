<?php
/**
 * Empty cart page.
 *
 * @package Luxe_Fashion
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

do_action( 'woocommerce_cart_is_empty' );
?>
<div class="cart-empty-state">
    <div class="empty-icon" aria-hidden="true">
        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="var(--color-accent,#c9a87c)" stroke-width="1.5">
            <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
            <line x1="3" y1="6" x2="21" y2="6"/>
            <path d="M16 10a4 4 0 01-8 0"/>
        </svg>
    </div>
    <h2 class="empty-title"><?php esc_html_e( 'Your Cart is Empty', 'luxe-fashion' ); ?></h2>
    <p class="empty-subtitle"><?php esc_html_e( "Looks like you haven't added anything yet.", 'luxe-fashion' ); ?></p>
    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="btn-primary">
        <?php esc_html_e( 'Start Shopping', 'luxe-fashion' ); ?>
    </a>
</div>

<?php get_template_part( 'woocommerce/cart/new-arrivals' ); ?>
