<?php if (!defined('ABSPATH')) exit; ?>
<div class="cart-totals-wrap">
    <h2>Order Summary</h2>
    <table class="cart-totals-table">
        <tr><th>Subtotal</th><td><?php wc_cart_totals_subtotal_html(); ?></td></tr>
        <tr><th>Shipping</th><td>Calculated at checkout</td></tr>
        <tr><th>Tax</th><td><?php wc_cart_totals_tax_html(); ?></td></tr>
        <tr class="cart-total"><th>Total</th><td><?php wc_cart_totals_order_total_html(); ?></td></tr>
    </table>
    <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="checkout-button">Proceed to Checkout</a>
    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="continue-shopping">Continue Shopping</a>
</div>
