<?php
/**
 * Simple Add to Cart
 */
if ( ! defined( 'ABSPATH' ) ) exit;
global $product;
if ( ! $product || ! $product->is_purchasable() ) return;
?>
<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
    <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
    <div class="quantity-stepper">
        <button type="button" class="qty-minus" aria-label="Decrease">-</button>
        <?php woocommerce_quantity_input( array( 'min_value' => 1, 'max_value' => $product->get_max_purchase_quantity(), 'input_value' => $product->get_min_purchase_quantity() ) ); ?>
        <button type="button" class="qty-plus" aria-label="Increase">+</button>
    </div>
    <button type="submit" name="add-to-cart" value="<?php echo $product->get_id(); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->add_to_cart_text() ); ?></button>
    <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
</form>
