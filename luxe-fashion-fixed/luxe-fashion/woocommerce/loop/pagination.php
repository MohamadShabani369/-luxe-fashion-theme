<?php
/**
 * Pagination.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! $total ) {
    return;
}
?>
<nav class="woocommerce-pagination"
     aria-label="<?php esc_attr_e( 'Pagination', 'luxe-fashion' ); ?>">
    <?php echo $paginate_links; ?>
</nav>
