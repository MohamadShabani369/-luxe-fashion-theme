<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<section class="related-products">
    <h2 class="related-title">You May Also Like</h2>
    <?php woocommerce_product_loop_start(); ?>
    <?php while ( have_posts() ) : the_post(); ?>
    <?php wc_get_template_part( 'content', 'product' ); ?>
    <?php endwhile; ?>
    <?php woocommerce_product_loop_end(); ?>
</section>
