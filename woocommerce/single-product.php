<?php
/**
 * Single Product Template
 * @package Luxe_Fashion
 */
declare( strict_types = 1 );
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>
<main id="primary" class="site-main single-product">
<?php
while ( have_posts() ) : the_post();
global $product;
?>
<header class="single-product-hero">
    <?php
    do_action( 'woocommerce_before_single_product' );
    ?>
</header>
<div class="container product-layout">
    <aside class="product-gallery-col">
        <?php get_template_part( 'template-parts/product/gallery' ); ?>
    </aside>
    <section class="product-info-col">
        <?php get_template_part( 'template-parts/product/info' ); ?>
    </section>
</div>
<?php
endwhile;
?>
<section class="product-extra">
    <?php do_action( 'woocommerce_after_single_product_summary' ); ?>
</section>
<?php
get_footer();
