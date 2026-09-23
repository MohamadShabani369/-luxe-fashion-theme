<?php
get_header();
?>
<main id="content">
  <section class="hero">
    <h1><?php echo esc_html( get_theme_mod( 'luxe_hero_title', 'New Collection' ) ); ?></h1>
    <p><?php echo esc_html( get_theme_mod( 'luxe_hero_sub', 'Elegant fashion' ) ); ?></p>
  </section>
  <section class="categories">
    <h2><?php esc_html_e( 'Categories', 'luxe-fashion' ); ?></h2>
    <?php
    $cats = get_terms( [ 'taxonomy'=>'product_cat', 'hide_empty'=>false ] );
    foreach ( $cats as $cat ) :
      printf( '<a href="%s">%s</a>', esc_url( get_term_link( $cat ) ), esc_html( $cat->name ) );
    endforeach;
    ?>
  </section>
  <section class="arrivals">
    <h2><?php esc_html_e( 'Arrivals', 'luxe-fashion' ); ?></h2>
    <?php
    $arr = new WP_Query( [ 'post_type'=>'product', 'posts_per_page'=>4 ] );
    while ( $arr->have_posts() ) : $arr->the_post();
      global $product;
      printf( '<a href="%s">%s</a>', esc_url( get_permalink() ), esc_html( $product->get_name() ) );
    endwhile; wp_reset_postdata();
    ?>
  </section>
</main>
<?php get_footer();
