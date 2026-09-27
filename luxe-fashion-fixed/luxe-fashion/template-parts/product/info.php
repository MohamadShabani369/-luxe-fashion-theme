<?php
/**
 * Product Info Template Part
 */
declare( strict_types = 1 );
if ( ! defined( 'ABSPATH' ) ) exit;
global $product;
if ( ! $product ) return;
$sale = $product->is_on_sale();
?>
<div class="product-info">
    <p class="category-label">
        <?php echo get_the_term_list( get_the_ID(), 'product_cat', '', ', ' ); ?>
    </p>
    <h1 class="product-title"><?php the_title(); ?></h1>
    <div class="product-rating">
        <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
        <span class="review-count">(<?php echo $product->get_review_count(); ?>)</span>
    </div>
    <div class="product-price-wrap">
        <?php if ( $sale ) : ?>
        <span class="regular-price"><del><?php echo $product->get_regular_price_html(); ?></del></span>
        <span class="sale-price"><?php echo $product->get_price_html(); ?></span>
        <?php else : ?>
        <span class="price"><?php echo $product->get_price_html(); ?></span>
        <?php endif; ?>
    </div>
    <div class="product-description">
        <?php echo wp_kses_post( $product->get_short_description() ); ?>
    </div>
    <hr class="divider" />
    <div class="add-to-cart-area">
        <?php
        /**
         * IMPORTANT: use WooCommerce's own dispatcher instead of forcing the
         * "simple" template on every product. This was the main bug behind
         * items not really reaching the cart: it picks the right template
         * (simple / variable / grouped / external) based on $product->get_type(),
         * and — critically for variable products — it also prints the
         * surrounding <form> tag with the data-product_variations attribute
         * and enqueues wc-add-to-cart-variation.js, none of which happen when
         * add-to-cart/simple.php is included directly.
         */
        woocommerce_template_single_add_to_cart();
        ?>
    </div>
    <a href="#" class="wishlist-link" aria-label="Add to wishlist">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
        Add to Wishlist
    </a>
    <div class="product-meta">
        <span>SKU: <?php echo esc_html( $product->get_sku() ); ?></span>
        <span><?php echo get_the_term_list( get_the_ID(), 'product_cat', 'Category: ', ', ' ); ?></span>
        <span><?php echo get_the_term_list( get_the_ID(), 'product_tag', 'Tags: ', ', ' ); ?></span>
    </div>
    <?php get_template_part( 'template-parts/product/trust-badges' ); ?>
</div>
