<?php
if (!defined('ABSPATH')) exit;
?>
<div class="cart-hero">
    <nav class="cart-breadcrumb" aria-label="Breadcrumb">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
        <span>/</span>
        <span>Cart</span>
    </nav>
    <h1 class="cart-title">Shopping Cart</h1>
    <p class="cart-item-count" aria-live="polite">
        <?php echo esc_html(WC()->cart->get_cart_contents_count()); ?> items in your cart
    </p>
</div>

<?php if (WC()->cart->is_empty()) {
    get_template_part('cart/cart-empty');
    return; }
?>

<?php do_action('woocommerce_before_cart'); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
    <?php do_action('woocommerce_before_cart_table'); ?>
    <table class="woocommerce-cart-form__contents">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody>
            <?php do_action('woocommerce_before_cart_contents'); ?>
            <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
                $product = $cart_item['data'];
            ?>
            <tr class="cart_item" data-product_sku="<?php echo esc_attr($product->get_sku()); ?>">
                <td class="product-thumbnail">
                    <?php echo $product->get_image('woocommerce_thumbnail'); ?>
                    <a href="<?php echo esc_url($product->get_permalink($cart_item)); ?>" class="product-name"><strong><?php echo esc_html($product->get_name()); ?></strong></a>
                </td>
                <td class="product-price" data-title="Price">
                    <?php echo $product->get_price_html(); ?>
                </td>
                <td class="product-quantity" data-title="Quantity">
                    <div class="quantity-stepper">
                        <button type="button" class="qty-minus" onclick="luxeUpdateQty('<?php echo $cart_item_key; ?>', -1)">-</button>
                        <input type="number" name="cart[<?php echo $cart_item_key; ?>][qty]" value="<?php echo esc_attr($cart_item['quantity']); ?>" class="qty" min="1" />
                        <button type="button" class="qty-plus" onclick="luxeUpdateQty('<?php echo $cart_item_key; ?>', 1)">+</button>
                    </div>
                </td>
                <td class="product-subtotal" data-title="Subtotal">
                    <?php echo WC()->cart->get_product_subtotal($product, $cart_item['quantity']); ?>
                </td>
                <td class="product-remove">
                    <a href="<?php echo esc_url(WC()->cart->get_remove_url($cart_item_key)); ?>" aria-label="Remove <?php echo esc_attr($product->get_name()); ?>" data-product_id="<?php echo esc_attr($product->get_id()); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()); ?>">&times;</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php do_action('woocommerce_cart_contents'); ?>
        </tbody>
    </table>
    <?php do_action('woocommerce_after_cart_table'); ?>
    <div class="cart-actions">
        <button type="submit" name="update_cart" class="button" value="<?php esc_attr_e('Update cart', 'luxe-fashion'); ?>"><?php esc_html_e('Update cart', 'luxe-fashion'); ?></button>
    </div>
</form>

<div class="cart-collaterals">
    <div class="cart-totals">
        <h2>Order Summary</h2>
        <table>
            <tr><th>Subtotal</th><td><?php wc_cart_totals_subtotal_html(); ?></td></tr>
            <tr><th>Shipping</th><td>Calculated at checkout</td></tr>
            <tr><th>Tax</th><td><?php wc_cart_totals_tax_html(); ?></td></tr>
            <tr class="total"><th>Total</th><td><?php wc_cart_totals_order_total_html(); ?></td></tr>
        </table>
        <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="checkout-button">Proceed to Checkout</a>
        <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="continue-shopping">Continue Shopping</a>
    </div>
</div>

<?php do_action('woocommerce_after_cart'); ?>
