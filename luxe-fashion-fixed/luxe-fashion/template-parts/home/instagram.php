<?php
/**
 * Instagram Template Part
 */
declare(strict_types=1);
if ( ! defined( 'ABSPATH' ) ) exit;
$instagram_handle = get_theme_mod( 'luxe_instagram_handle', 'luxefashion' );
?>
<section class="instagram instagram-section">
	<div class="container">
		<header class="section-header">
			<h2 class="section-title"><?php printf( esc_html__( 'Follow @%s', 'luxe-fashion' ), esc_html( $instagram_handle ) ); ?></h2>
		</header>
		<div class="instagram-empty">
			<p>Follow us on Instagram for daily style inspiration.</p>
			<a href="https://instagram.com/luxefashion" class="btn btn-outline">Follow @luxefashion</a>
		</div>
	</div>
</section>
