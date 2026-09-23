<?php
/**
 * Luxe Fashion - Theme Header Template
 * @package Luxe Fashion @since 1.0.0
 */
declare(strict_types=1);
if (!defined('ABSPATH')) exit;

if (!function_exists('luxe_get_cart_count')) {
	function luxe_get_cart_count() : int {
		if (!function_exists('WC') || !WC() || !WC()->cart) return 0;
		return (int) WC()->cart->get_cart_contents_count();
	}
}

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo esc_html(wp_title('|', false, 'right') . ' ' . get_bloginfo('name')); ?></title>
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'luxe-fashion'); ?></a>

<?php get_template_part("template-parts/header/announcement-bar"); ?>
<header id="masthead" class="site-header" role="banner">
<div class="header-inner container">

<div class="site-branding">
	<?php if (function_exists('has_custom_logo') && has_custom_logo()) { the_custom_logo(); } else { ?>
	<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
	<?php } ?>
</div>

<nav id="site-navigation" class="primary-nav" aria-label="<?php esc_attr_e('Primary Menu', 'luxe-fashion'); ?>">
	<?php
	wp_nav_menu([
		'theme_location' => 'primary',
		'container'      => false,
		'menu_class'     => 'menu',
		'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'fallback_cb'    => false,
		'depth'          => 3,
	]);
	?>
</nav>

<div class="header-actions">
	<button type="button" class="icon-btn search-toggle" aria-label="<?php esc_attr_e('Search', 'luxe-fashion'); ?>">
		<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
	</button>
	<button type="button" class="icon-btn" aria-label="<?php esc_attr_e('Wishlist', 'luxe-fashion'); ?>">
		<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
	</button>
	<a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : home_url('/')); ?>" class="icon-btn" aria-label="<?php esc_attr_e('Account', 'luxe-fashion'); ?>">
		<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
	</a>
	<button type="button" class="icon-btn cart" aria-label="<?php esc_attr_e('Cart', 'luxe-fashion'); ?>">
		<span class="cart-count"><?php echo esc_html(luxe_get_cart_count()); ?></span>
		<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="1" y1="6" x2="23" y2="6"/></svg>
	</button>
</div>

</div>
</header>
<?php get_template_part("template-parts/header/search-overlay"); ?>
<?php get_template_part("template-parts/header/mini-cart"); ?>
<?php get_template_part("template-parts/header/mobile-menu"); ?>
