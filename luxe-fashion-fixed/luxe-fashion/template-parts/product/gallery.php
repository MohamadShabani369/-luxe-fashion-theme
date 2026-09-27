<?php
/**
 * Product Gallery Template Part
 */
declare( strict_types = 1 );
if ( ! defined( 'ABSPATH' ) ) exit;
global $product;
if ( ! $product ) return;
$sale = $product->is_on_sale();
?>
<div class="product-gallery" data-gallery>
    <?php if ( $sale ) : ?>
    <span class="sale-badge">-<?php echo absint( round( ( floatval( $product->get_regular_price() ) - floatval( $product->get_sale_price() ) ) / floatval( $product->get_regular_price() ) * 100 ) ); ?>%</span>
    <?php endif; ?>
    <figure class="gallery-main">
        <?php echo $product->get_image( 'woocommerce_single', array( 'class' => 'main-image' ) ); ?>
    </figure>
    <div class="gallery-thumbs">
        <?php
        $gallery = $product->get_gallery_image_ids();
        if ( $gallery ) {
            foreach ( $gallery as $image_id ) {
                echo wp_get_attachment_image( $image_id, 'woocommerce_thumbnail', false, array( 'class' => 'thumb-img', 'data-full' => wp_get_attachment_url( $image_id ) ) );
            }
        }
        ?>
    </div>
</div>
