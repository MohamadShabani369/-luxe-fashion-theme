<?php if (!defined('ABSPATH')) exit; ?>
<div class="empty-cart-state">
    <svg class="empty-icon" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="var(--color-accent,#c9a87c)" stroke-width="1.5" aria-hidden="true"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
    <h2 class="empty-title">Your Cart is Empty</h2>
    <p class="empty-subtitle">Looks like you haven't added anything yet.</p>
    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn-primary">Start Shopping</a>
</div>
<section class="new-arrivals">
    <h3>New Arrivals</h3>
    <div class="new-arrivals-grid">
        <?php
        $new = new WP_Query(['post_type'=>'product','posts_per_page'=>4,'orderby'=>'date','order'=>'DESC']);
        if ($new->have_posts()) : while ($new->have_posts()) : $new->the_post();
            global $product;
            if (!is_a($product,'WC_Product')) $product = wc_get_product(get_the_ID());
        ?>
        <a href="<?php echo esc_url($product->get_permalink()); ?>" class="product-card">
            <?php echo $product->get_image('medium'); ?>
            <h4><?php echo esc_html($product->get_name()); ?></h4>
            <span class="product-price"><?php echo $product->get_price_html(); ?></span>
        </a>
        <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>
</section>
