<?php
/**
 * Cart totals.
 *
 * @package Luxe_Fashion
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="cart-totals-wrap">
    <h2><?php esc_html_e( 'Order Summary', 'luxe-fashion' ); ?></h2>

    <table class="cart-totals-table">
        <tr>
            <th><?php esc_html_e( 'Subtotal', 'luxe-fashion' ); ?></th>
            <td><?php wc_cart_totals_subtotal_html(); ?></td>
        </tr>
        <tr>
            <th><?php esc_html_e( 'Shipping', 'luxe-fashion' ); ?></th>
            <td><?php esc_html_e( 'Calculated at checkout', 'luxe-fashion' ); ?></td>
        </tr>
        <tr>
            <th><?php esc_html_e( 'Tax', 'luxe-fashion' ); ?></th>
            <td><?php wc_cart_totals_tax_html(); ?></td>
        </tr>
        <tr class="cart-total">
            <th><?php esc_html_e( 'Total', 'luxe-fashion' ); ?></th>
            <td><?php wc_cart_totals_order_total_html(); ?></td>
        </tr>
    </table>

    <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-button">
        <?php esc_html_e( 'Proceed to Checkout', 'luxe-fashion' ); ?>
    </a>
    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="continue-shopping">
        <?php esc_html_e( 'Continue Shopping', 'luxe-fashion' ); ?>
    </a>
</div>
