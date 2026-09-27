<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
if ( ! empty( $tabs ) ) : ?>
<div class="product-tabs">
    <nav class="tabs-nav">
        <?php foreach ( $tabs as $key => $tab ) : ?>
        <a href="#tab-<?php echo esc_attr( $key ); ?>" class="tab-link<?php echo $key === array_key_first( $tabs ) ? ' active' : ''; ?>"><?php echo esc_html( $tab['title'] ); ?></a>
        <?php endforeach; ?>
    </nav>
    <?php foreach ( $tabs as $key => $tab ) : ?>
    <div id="tab-<?php echo esc_attr( $key ); ?>" class="tab-panel<?php echo $key === array_key_first( $tabs ) ? ' active' : ''; ?>">
        <?php call_user_func( $tab['callback'], $key, $tab ); ?>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
