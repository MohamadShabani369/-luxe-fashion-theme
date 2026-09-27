<?php
/**
 * Luxe Fashion — Template tags (reusable functions)
 *
 * @package Luxe_Fashion
 * @since 1.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fallback for main navigation menu.
 *
 * @since 1.0.0
 */
function luxe_primary_menu_fallback() {
	wp_page_menu( [
		'show_home' => true,
		'include'       => '',
		'echo'          => true,
		'link_before'   => '<span class="screen-reader-text">',
		'link_after'    => '</span>',
		'menu_class'    => 'primary-nav',
		'item_id'        => '',
		'echo'            => true,
	] );
}

/**
 * Return the post date in Jalali format (for Persian date support).
 * Requires the jalali library to be installed — falls back to Gregorian.
 *
 * @param int|bool $post_id
 * @return string
 */
function luxe_get_jalali_date( $post_id = false ) {
	$post_id = $post_id ?: get_the_ID();
	$post_date_gmt = get_post( $post_id )->post_date_gmt;

	// If the jalali library is loaded, use it — else just return the WP date format.
	if ( function_exists( 'jdate' ) ) {
		return esc_html( jdate( 'F j، Y', strtotime( $post_date_gmt ) ) );
	}

	return esc_html( get_the_date( '', $post_id ) );
}

/**
 * Output post meta info.
 *
 * @since 1.0.0
 */
function luxe_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	// Convert to Jalali date if Persian context.
	$date_string = luxe_get_jalali_date();
	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	printf(
		'<span class="posted-on">%1$s</span>',
		sprintf(
			'<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			sprintf(
				'<%2$s class="entry-date">%3$s</%2$s>',
				esc_url( get_permalink() ),
				'time',
				$date_string
			)
		)
	);
}

/**
 * Output the post categories and tags.
 *
 * @since 1.0.0
 */
function luxe_entry_footer() {
	if ( ! is_singular() ) {
		return;
	}

	$categories_list = get_the_category_list( ', ' );
	if ( $categories_list ) {
		printf(
			'<span class="cat-links">' . __( ' %1$s', 'luxe-fashion' ) . '</span>',
			$categories_list
		);
	}

	$tags_list = get_the_tag_list( '', __( ', ', 'luxe-fashion' ) );
	if ( $tags_list ) {
		printf(
			'<span class="tags-links">' . __( ' %1$s', 'luxe-fashion' ) . '</span>',
			$tags_list
		);
	}

	// Author info for blog posts.
	if ( get_theme_mod( 'luxe_show_author', true ) ) :
		$byline = sprintf(
			'<span class="byline">%s</span>',
			sprintf(
				'<span class="author-name">%s</span>',
				esc_html( get_the_author() )
			)
		);
		echo ' ' . $byline; // Already escaped.
	endif;
}

/**
 * Output a styled archive title.
 *
 * @return void
 */
function luxe_archive_title() {
	$before = '<h1 class="page-title">';
	$after  = '</h1>';
	if ( is_category() ) {
		$before .= get_the_archive_title();
		$after  = '</h1>';
	} else {
		$before .= get_the_archive_title();
	}
	echo wp_kses_post( $before ) . wp_kses_post( $after );
}

/**
 * Output a styled breadcrumb.
 *
 * @return void
 */
function luxe_breadcrumb() {
	if ( function_exists( 'yoast_breadcrumb' ) ) {
		return;
	}

	// Simple breadcrumb fallback.
	echo '<nav aria-label="breadcrumb" class="breadcrumb">';
	echo '<ol class="breadcrumb-list">';

	$breadcrumb = [
		home_url() => esc_html__( 'Home', 'luxe-fashion' ),
	];

	if ( is_category() ) {
		$breadcrumb[ get_permalink( get_queried_object()->ID ) ] = esc_html( single_term_title( '', false ) );
	} elseif ( is_single() ) {
		$breadcrumb[ '' ] = esc_html( get_the_title() );
	}

	foreach ( $breadcrumb as $url => $name ) {
		echo '<li class="breadcrumb-item">';
		if ( empty( $url ) ) {
			echo '<span>' . esc_html( $name ) . '</span>';
		} else {
			echo '<a href="' . esc_url( $url ) . '">' . esc_html( $name ) . '</a>';
		}
		echo '</li>';
	}
	echo '</ol>';
	echo '</nav>';
}
