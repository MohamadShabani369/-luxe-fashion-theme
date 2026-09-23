<?php
/**
 * Brand Story Template Part
 *
 * @package Luxe Fashion
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$text = get_theme_mod( 'luxe_brand_story_text', 'At Luxe Fashion, we believe true style is timeless. Our collections are designed for the modern woman who demands quality, sophistication, and effortless elegance.' );
?>

<section class="brand-story">
	<div class="container">
		<div class="story-content">
			<span class="story-label">
				<?php esc_html_e( 'OUR STORY', 'luxe-fashion' ); ?>
			</span>
			<h2 class="story-title">
				<?php esc_html_e( 'Crafting Timeless Elegance', 'luxe-fashion' ); ?>
			</h2>
			<p class="story-text">
				<?php echo esc_html( $text ); ?>
			</p>
			<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn btn-outline">
				<?php esc_html_e( 'Learn More', 'luxe-fashion' ); ?>
			</a>
		</div>
	</div>
</section>