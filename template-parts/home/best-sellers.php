<?php
/**
 * Best Sellers Template Part
 *
 * @package Luxe Fashion
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = array(
	'post_type' => 'product',
	'posts_per_page' => 4,
	'meta_key' => 'total_sales',
	'orderby' => 'meta_value_num',
	'order' => 'DESC',
);

$products_query = new WP_Query( $args );
?>

<section class="best-sellers">
	<div class="container">
		<header class="section-header">
			<h2 class="section-title">
				<?php esc_html_e( 'Best Sellers', 'luxe-fashion' ); ?>
			</h2>
			<p class="section-subtitle">
				<?php esc_html_e( 'Our most loved styles that keep coming back', 'luxe-fashion' ); ?>
			</p>
		</header>
		<?php if ( $products_query->have_posts() ) : ?>
		<div class="products-grid">
			<?php while ( $products_query->have_posts() ) :
					$products_query->the_post(); ?>
			<div class="product-card">
				<div class="product-image">
					<?php
						$product = wc_get_product( get_the_ID() );
						if ( $product ) {
							echo $product->get_image( 'woocommerce_thumbnail' );
						}
						?>
					<div class="product-actions">
						<button type="button" class="action-btn" aria-label="Wishlist">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
								<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
							</svg>
						</button>
						<button type="button" class="action-btn" aria-label="Quick view">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
								<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
								<circle cx="12" cy="12" r="3"/>
							</svg>
						</button>
					</div>
				</div>
				<div class="product-info">
					<span class="product-category">
						<?php echo get_the_term_list( get_the_ID(), 'product_cat', '', ', ' ); ?>
					</span>
					<h3 class="product-title">
						<a href="<?php echo esc_url( get_permalink() ); ?>">
							<?php the_title(); ?>
						</a>
					</h3>
					<div class="product-price">
						<?php woocommerce_template_loop_price(); ?>
					</div>
					<button type="button" class="btn btn-primary add-to-cart-btn">
						<?php esc_html_e( 'Add to Cart', 'luxe-fashion' ); ?>
					</button>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
		<?php else : ?>
		<p class="no-products">
			<?php esc_html_e( 'No products available', 'luxe-fashion' ); ?>
		</p>
		<?php endif; ?>
			<?php wp_reset_postdata(); ?>
	</div>
</section>