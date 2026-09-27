<?php
/**
 * Ordering / sort dropdown.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<form class="woocommerce-ordering"
      method="get"
      aria-label="<?php esc_attr_e( 'Shop order', 'luxe-fashion' ); ?>">
    <label for="luxe-orderby"
           class="screen-reader-text">
        <?php esc_html_e( 'Order by', 'luxe-fashion' ); ?>
    </label>
    <select
        id="luxe-orderby"
        name="orderby"
        class="orderby"
        aria-label="<?php esc_attr_e( 'Shop order', 'luxe-fashion' ); ?>"
        onchange="this.form.submit()">
        <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
            <option value="<?php echo esc_attr( $id ); ?>"
                <?php selected( $orderby, $id ); ?>>
                <?php echo esc_html( $name ); ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>
