<?php
/**
 * Cart page template override.
 *
 * @package Luxe_Fashion
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

do_action( 'woocommerce_before_cart' ); ?>

<div class="cart-hero">
    <nav class="cart-breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'luxe-fashion' ); ?>">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'luxe-fashion' ); ?></a>
        <span>/</span>
        <span><?php esc_html_e( 'Cart', 'luxe-fashion' ); ?></span>
    </nav>
    <h1 class="cart-title"><?php esc_html_e( 'Shopping Cart', 'luxe-fashion' ); ?></h1>
    <p class="cart-item-count" aria-live="polite">
        <?php
        printf(
            /* translators: %d: cart item count */
            esc_html( _n( '%d item in your cart', '%d items in your cart', WC()->cart->get_cart_contents_count(), 'luxe-fashion' ) ),
            esc_html( WC()->cart->get_cart_contents_count() )
        );
        ?>
    </p>
</div>

<?php if ( WC()->cart->is_empty() ) : ?>

    <?php wc_get_template( 'cart/cart-empty.php' ); ?>

<?php else : ?>

    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
        <?php do_action( 'woocommerce_before_cart_table' ); ?>

        <table class="woocommerce-cart-form__contents">
            <thead>
                <tr>
                    <th><?php esc_html_e( 'Product', 'luxe-fashion' ); ?></th>
                    <th><?php esc_html_e( 'Price', 'luxe-fashion' ); ?></th>
                    <th><?php esc_html_e( 'Quantity', 'luxe-fashion' ); ?></th>
                    <th><?php esc_html_e( 'Subtotal', 'luxe-fashion' ); ?></th>
                    <th><?php esc_html_e( 'Remove', 'luxe-fashion' ); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
                    $product = $cart_item['data'];
                    if ( ! $product || ! $product->exists() || $cart_item['quantity'] <= 0 ) {
                        continue;
                    }
                    ?>
                    <tr class="cart_item" data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>">
                        <td class="product-thumbnail">
                            <?php echo wp_kses_post( $product->get_image( 'woocommerce_thumbnail' ) ); ?>
                            <a href="<?php echo esc_url( $product->get_permalink( $cart_item ) ); ?>" class="product-name">
                                <strong><?php echo esc_html( $product->get_name() ); ?></strong>
                            </a>
                        </td>
                        <td class="product-price" data-title="<?php esc_attr_e( 'Price', 'luxe-fashion' ); ?>">
                            <?php echo wp_kses_post( $product->get_price_html() ); ?>
                        </td>
                        <td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'luxe-fashion' ); ?>">
                            <div class="quantity-stepper">
                                <button type="button" class="qty-minus" aria-label="<?php esc_attr_e( 'Decrease quantity', 'luxe-fashion' ); ?>">-</button>
                                <input
                                    type="number"
                                    name="cart[<?php echo esc_attr( $cart_item_key ); ?>][qty]"
                                    value="<?php echo esc_attr( $cart_item['quantity'] ); ?>"
                                    class="qty"
                                    min="1"
                                />
                                <button type="button" class="qty-plus" aria-label="<?php esc_attr_e( 'Increase quantity', 'luxe-fashion' ); ?>">+</button>
                            </div>
                        </td>
                        <td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'luxe-fashion' ); ?>">
                            <?php echo wp_kses_post( WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] ) ); ?>
                        </td>
                        <td class="product-remove">
                            <a
                                href="<?php echo esc_url( WC()->cart->get_remove_url( $cart_item_key ) ); ?>"
                                aria-label="<?php echo esc_attr( sprintf( __( 'Remove %s', 'luxe-fashion' ), $product->get_name() ) ); ?>"
                                data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
                                data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>"
                            >&times;</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php do_action( 'woocommerce_cart_contents' ); ?>
            </tbody>
        </table>

        <?php do_action( 'woocommerce_after_cart_table' ); ?>

        <div class="cart-actions">
            <button type="submit" name="update_cart" class="button" value="<?php esc_attr_e( 'Update cart', 'luxe-fashion' ); ?>">
                <?php esc_html_e( 'Update cart', 'luxe-fashion' ); ?>
            </button>
            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
        </div>
    </form>

    <div class="cart-collaterals">
        <?php get_template_part( 'woocommerce/cart/cart-totals' ); ?>
    </div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_cart' ); ?>