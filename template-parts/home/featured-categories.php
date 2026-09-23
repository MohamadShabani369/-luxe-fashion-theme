<?php
/**
 * Featured Categories Template Part
 *
 * @package Luxe Fashion
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$terms = get_terms( array(
	'taxonomy' => 'product_cat',
	'hide_empty' => true,
	'orderby' => 'menu_order',
) );
?>

<section class="featured-categories">
	<div class="container">
		<header class="section-header">
			<h2 class="section-title"><?php esc_html_e( 'Shop by Category', 'luxe-fashion' ); ?></h2>
			<div class="section-divider"></div>
		</header>
		<?php if ( ! empty( $terms ) && is_array( $terms ) ) : ?>
		<div class="categories-grid">
			<?php
			foreach ( $terms as $term ) :
				$thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
				$image        = wp_get_attachment_image_url( $thumbnail_id, 'full' );
				$image_class  = $image ? 'has-image' : 'no-image';
				$product_count = $term->count;
				?>
				<a href="<?php echo esc_url( get_term_link( $term->term_id, 'product_cat' ) ); ?>" class="category-card <?php echo esc_attr( $image_class ); ?>">
					<?php if ( $image ) : ?>
					<div class="category-card-image" style="background-image: url('<?php echo esc_url( $image ); ?>');"></div>
					<?php endif; ?>
					<div class="category-card-content">
						<h3 class="category-card-title"><?php echo esc_html( $term->name ); ?></h3>
						<p class="category-card-count"><?php echo esc_html( $product_count ); ?> <?php esc_html_e( 'styles', 'luxe-fashion' ); ?></p>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
		<?php else : ?>
		<p class="no-categories"><?php esc_html_e( 'No categories available', 'luxe-fashion' ); ?></p>
		<?php endif; ?>
	</div>
</section>
