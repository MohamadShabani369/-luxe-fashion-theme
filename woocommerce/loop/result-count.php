<?php
/**
 * Result count.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<p class="woocommerce-result-count">
    <?php
    echo esc_html(
        sprintf(
            /* translators: %d: total results */
            _n(
                'Showing %d result',
                'Showing %d results',
                $total,
                'luxe-fashion'
            ),
            $total
        )
    );
    ?>
</p>
