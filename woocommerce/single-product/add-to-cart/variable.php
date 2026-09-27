<?php
/**
 * Variable Add to Cart
 */
if ( ! defined( 'ABSPATH' ) ) exit;
global $product;
if ( ! $product || ! $product->is_type( 'variable' ) ) return;
$attributes = $product->get_variation_attributes();
$available = $product->get_available_variations();
?>
<table class="variations" cellspacing="0">
    <tbody>
    <?php foreach ( $attributes as $attribute_name => $options ) : ?>
        <tr>
            <th class="label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></th>
            <td class="value">
                <select id="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>" name="attribute_<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>" data-attribute_name="attribute_<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>">
                    <option value=""><?php echo esc_html( wc_attribute_label( $attribute_name ) ); ?></option>
                    <?php foreach ( $options as $option ) : ?>
                    <option value="<?php echo esc_attr( $option ); ?>"><?php echo esc_html( apply_filters( 'woocommerce_variation_option_name', $option, null, $attribute_name, $product ) ); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="reset-variation">
    <a class="reset_variations" href="#" style="display:none;"><?php echo esc_html_e( 'Clear', 'luxe-fashion' ); ?></a>
</div>
<input type="hidden" name="variation_id" class="variation_id" value="0" />
<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
