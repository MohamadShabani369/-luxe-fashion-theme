<?php if (!defined('ABSPATH')) exit; ?>
<div class="product-row">
    <a href="<?php echo esc_url($product->get_permalink()); ?>" class="product-thumb"><?php echo $product->get_image('thumbnail'); ?></a>
    <h3 class="product-row-title"><a href="<?php echo esc_url($product->get_permalink()); ?>"><?php echo esc_html($product->get_name()); ?></a></h3>
    <span class="product-row-price"><?php echo $cart_item['line_subtotal']; ?></span>
</div>
