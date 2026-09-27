<?php
/**
 * Single Product Price
 */
if ( ! defined( 'ABSPATH' ) ) exit;
global $product;
if ( ! $product ) return;
$sale = $product->is_on_sale();
?>
<p class="price">
<?php if ( $sale ) : ?>
    <del><?php echo $product->get_regular_price_html(); ?></del>
    <ins><?php echo $product->get_price_html(); ?></ins>
<?php else : ?>
    <?php echo $product->get_price_html(); ?>
<?php endif; ?>
</p>
