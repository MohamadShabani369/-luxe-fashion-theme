<?php
/**
 * New Arrivals Template Part
 *
 * @package Luxe Fashion
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = array(
	'post_type' => 'product',
	'posts_per_page' => 8,
	'orderby' => 'date',
	'order' => 'DESC',
);

$products_query = new WP_Query( $args );
?>

<section class="new-arrivals">
	<div class="container">
		<header class="section-header">
			<h2 class="section-title">
				<?php esc_html_e( 'New Arrivals', 'luxe-fashion' ); ?>
			</h2>
			<a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="view-all-link">
				<?php esc_html_e( 'View All', 'luxe-fashion' ); ?> &rarr;
			</a>
		</header>
		<?php if ( $products_query->have_posts() ) : ?>
			<div class="products-carousel">
				<div class="carousel-track">
					<?php
					while ( $products_query->have_posts() ) :
							$products_query->the_post();
							wc_get_template_part( 'content', 'product' );
					endwhile;
					?>
				</div>
				<div class="carousel-navigation">
					<button class="nav-btn prev-btn" aria-label="Previous">
						&larr;
					</button>
					<button class="nav-btn next-btn" aria-label="Next">
						&rarr;
					</button>
				</div>
			</div>
			<?php else : ?>
				<p class="no-products">
					<?php esc_html_e( 'No products available', 'luxe-fashion' ); ?>
				</p>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
	</div>
</section>
