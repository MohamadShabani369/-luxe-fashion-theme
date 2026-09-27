<?php if (!defined('ABSPATH')) exit; ?>
<section class="new-arrivals-section">
    <h2>New Arrivals</h2>
    <?php
    $q = new WP_Query(['post_type'=>'product','posts_per_page'=>4,'orderby'=>'date','order'=>'DESC']);
    if ($q->have_posts()) :
    echo '<div class="new-arrivals-grid">';
    while ($q->have_posts()) : $q->the_post();
        $prod = wc_get_product(get_the_ID());
    ?>
    <a href="<?php echo esc_url($prod->get_permalink()); ?>" class="arr-new-card">
        <?php echo $prod->get_image('medium'); ?>
        <h3><?php echo esc_html($prod->get_name()); ?></h3>
        <span class="arr-price"><?php echo $prod->get_price_html(); ?></span>
    </a>
    <?php endwhile; echo '</div>'; wp_reset_postdata(); endif; ?>
</section>
