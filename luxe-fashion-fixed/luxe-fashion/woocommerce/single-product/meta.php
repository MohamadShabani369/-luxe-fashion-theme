<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $product;
if ( ! $product ) return;
?>
<div class="product-meta-inner">
    <?php if ( $sku = $product->get_sku() ) : ?>
    <span class="meta-row"><span class="label">SKU:</span> <?php echo esc_html( $sku ); ?></span>
    <?php endif; ?>
    <span class="meta-row"><span class="label">Category:</span> <?php echo get_the_term_list( get_the_ID(), 'product_cat', '', ', ' ); ?></span>
    <?php if ( $tags = get_the_term_list( get_the_ID(), 'product_tag', '', ', ' ) ) : ?>
    <span class="meta-row"><span class="label">Tags:</span> <?php echo $tags; ?></span>
    <?php endif; ?>
</div>
