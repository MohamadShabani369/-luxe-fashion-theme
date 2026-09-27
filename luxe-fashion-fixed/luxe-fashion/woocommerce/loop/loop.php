<?php
/**
 * Product card loop template.
 *
 * @package Luxe_Fashion
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product;
if ( ! $product ) {
    return;
}
?>
<li <?php wc_product_class( '', $product ); ?>>
    <a href="<?php echo esc_url( $product->get_permalink() ); ?>"
       class="woocommerce-LoopProduct-link woocommerce-loop-product__link">

        <?php
        do_action( 'woocommerce_before_shop_loop_item' );
        ?>

        <div class="loop-product-image">
            <?php echo $product->get_image( 'woocommerce_thumbnail' ); ?>
        </div>

        <div class="loop-product-meta">
            <h2 class="woocommerce-loop-product__title">
                <?php echo esc_html( $product->get_name() ); ?>
            </h2>

            <?php
            do_action( 'woocommerce_shop_loop_item_title' );

            $price = $product->get_price_html();
            if ( $price ) :
                ?>
                <span class="price">
                    <?php echo wp_kses_post( $price ); ?>
                </span>
            <?php endif; ?>

            <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
        </div>

        <div class="loop-product-cart">
            <?php
            woocommerce_template_loop_add_to_cart(
                array(
                    'quantity'   => 1,
                    'class'      => 'button product_type_simple add_to_cart_button',
                )
            );
            ?>
        </div>

        <?php
        do_action( 'woocommerce_after_shop_loop_item' );
        ?>
    </a>
</li>
