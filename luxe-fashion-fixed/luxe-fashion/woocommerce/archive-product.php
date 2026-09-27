<?php
/**
 * The Template for displaying product archive pages.
 *
 * @package Luxe_Fashion
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main shop-page">
    <?php
    do_action( 'woocommerce_before_main_content' );
    ?>

    <header class="woocommerce-products-header">
        <nav class="woocommerce-breadcrumb"
             aria-label="<?php esc_attr_e( 'Breadcrumb', 'luxe-fashion' ); ?>">
            <?php woocommerce_breadcrumb(); ?>
        </nav>

        <h1 class="shop-title page-title">Shop All</h1>
        <p class="shop-subtitle">
            <?php esc_html_e( 'Curated pieces for the modern woman', 'luxe-fashion' ); ?>
        </p>
    </header>

    <?php if ( woocommerce_product_loop() ) : ?>
        <div class="shop-layout">
            <aside class="shop-sidebar">
                <?php
                /**
                 * Hook: woocommerce_sidebar.
                 */
                do_action( 'woocommerce_sidebar' );
                ?>
            </aside>

            <section class="shop-grid">
                <?php
                do_action( 'woocommerce_before_shop_loop' );

                wc_get_template_part( 'loop/loop-start' );
                if ( wc_get_loop_prop( 'total' ) ) {
                    while ( have_posts() ) {
                        the_post();
                        do_action( 'woocommerce_shop_loop' );
                        wc_get_template_part( 'content', 'product' );
                    }
                }

                wc_get_template_part( 'loop/loop-end' );
                woocommerce_pagination();

                do_action( 'woocommerce_after_shop_loop' );
                ?>
            </section>
        </div>
    <?php else : ?>
        <div class="shop-empty">
            <p>
                <?php esc_html_e( 'No products found.', 'luxe-fashion' ); ?>
            </p>
        </div>
    <?php endif; ?>

    <?php do_action( 'woocommerce_after_main_content' ); ?>
</main>

<?php
get_footer();
