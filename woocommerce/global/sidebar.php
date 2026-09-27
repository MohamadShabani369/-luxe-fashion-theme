<?php
/**
 * Sidebar for shop archive.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<aside class="shop-sidebar" aria-label="<?php esc_attr_e( 'Shop filters', 'luxe-fashion' ); ?>">
    <div class="shop-filters">
        <div class="filter-section filter-categories">
            <h3 class="filter-title">Categories</h3>
            <?php
            $terms = get_terms(
                array(
                    'taxonomy'   => 'product_cat',
                    'hide_empty' => false,
                )
            );
            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
                ?>
                <ul class="filter-list">
                    <?php foreach ( $terms as $term ) : ?>
                        <li>
                            <a href="<?php echo esc_url( get_term_link( $term ) ); ?>"
                               class="filter-link">
                                <?php echo esc_html( $term->name ); ?>
                                <span class="filter-count">
                                    <?php echo esc_html( $term->count ); ?>
                                </span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <div class="filter-section filter-price">
            <h3 class="filter-title">Price</h3>
            <form method="get"
                  class="filter-price-form"
                  aria-label="<?php esc_attr_e( 'Price filter', 'luxe-fashion' ); ?>">
                <div class="price-fields">
                    <input type="number"
                           name="min_price"
                           value=""
                           placeholder="<?php esc_attr_e( 'Min', 'luxe-fashion' ); ?>"
                           aria-label="<?php esc_attr_e( 'Minimum price', 'luxe-fashion' ); ?>"
                           class="price-input" />
                    <span class="price-separator">-</span>
                    <input type="number"
                           name="max_price"
                           value=""
                           placeholder="<?php esc_attr_e( 'Max', 'luxe-fashion' ); ?>"
                           aria-label="<?php esc_attr_e( 'Maximum price', 'luxe-fashion' ); ?>"
                           class="price-input" />
                </div>
                <button type="submit"
                        class="filter-button">
                    <?php esc_html_e( 'Filter', 'luxe-fashion' ); ?>
                </button>
            </form>
        </div>

        <div class="filter-section filter-clear">
            <a href="<?php echo esc_url( get_post_type_archive_link( "product" ) ); ?>"
               class="clear-all-button">
                <?php esc_html_e( 'Clear All', 'luxe-fashion' ); ?>
            </a>
        </div>
    </div>
</aside>
