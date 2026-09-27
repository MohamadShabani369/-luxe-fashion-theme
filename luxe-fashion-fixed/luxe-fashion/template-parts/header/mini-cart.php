<?php
/**
 * Mini Cart Template Part
 *
 * Slide-in cart panel for WooCommerce.
 *
 * @package Luxe Fashion
 * @since 1.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return mini cart items.
 *
 * @return array
 */
if ( ! function_exists( 'luxe_get_mini_cart_items' ) ) {
	function luxe_get_mini_cart_items() : array {
		if ( ! class_exists( 'WooCommerce' ) || ! WC()->cart ) {
			return [];
		}

		$items = WC()->cart->get_cart();

		if ( empty( $items ) ) {
			return [];
		}

		$results = [];
		foreach ( $items as $item ) {
			$product = $item['data'];
			if ( ! $product ) {
				continue;
			}

			$results[] = [
				'id'      => $item['key'],
				'name'    => $product->get_name(),
				'quantity'=> (int) $item['quantity'],
				'thumbnail' => $product->get_image_id()
					? wp_get_attachment_image_url( $product->get_image_id(), 'thumbnail' )
					: wc_placeholder_img_src(),
				'price'   => $product->get_price(),
				'link'    => $product->get_permalink(),
			];
		}

		return $results;
	}
}

?>
<div id="mini-cart" class="mini-cart" role="complementary" aria-label="<?php esc_attr_e( 'Shopping cart', 'luxe-fashion' ); ?>">
	<div class="mini-cart-header">
		<h3 class="mini-cart-title">
			<?php esc_html_e( 'Your Cart', 'luxe-fashion' ); ?>
		</h3>
		<button type="button" class="mini-cart-close" aria-label="<?php esc_attr_e( 'Close cart', 'luxe-fashion' ); ?>">
			<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
				<line x1="18" y1="6" x2="6" y2="18"></line>
				<line x1="6" y1="6" x2="18" y2="18"></line>
			</svg>
		</button>
	</div>
	<div class="mini-cart-content">
		<?php if ( WC()->cart && WC()->cart->is_empty() ) : ?>
			<p class="mini-cart-empty">
				<?php esc_html_e( 'Your cart is currently empty.', 'luxe-fashion' ); ?>
			</p>
		<?php else : ?>
			<ul class="mini-cart-items">
				<?php foreach ( luxe_get_mini_cart_items() as $item ) : ?>
					<li class="mini-cart-item">
						<a href="<?php echo esc_url( $item['link'] ); ?>" class="mini-cart-item-link">
							<img src="<?php echo esc_url( $item['thumbnail'] ); ?>" alt="" class="mini-cart-thumb">
							<div class="mini-cart-item-details">
								<p class="mini-cart-item-name">
									<?php echo esc_html( $item['name'] ); ?>
								</p>
								<p class="mini-cart-item-qty">
									<?php printf( esc_html__( 'Qty: %d', 'luxe-fashion' ), $item['quantity'] ); ?>
								</p>
							</div>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>
	<div class="mini-cart-footer">
		<p class="mini-cart-subtotal">
			<?php
			if ( WC()->cart ) {
				echo wp_kses_post( WC()->cart->get_cart_subtotal() );
			}
			?>
		</p>
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="btn btn-primary mini-cart-button">
			<?php esc_html_e( 'View Cart', 'luxe-fashion' ); ?>
		</a>
		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn btn-outline mini-cart-button">
			<?php esc_html_e( 'Checkout', 'luxe-fashion' ); ?>
		</a>
	</div>
</div>
