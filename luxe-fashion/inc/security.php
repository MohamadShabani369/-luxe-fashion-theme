<?php
/**
 * Security, sanitization, and escaping helpers.
 *
 * Every function is prefixed with `luxe_` and follows the WordPress
 * recommendation: sanitize on input, escape on output.
 *
 * @package Luxe_Fashion
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Safely escape an HTML class list.
 *
 * @param mixed $classes One or more class names (string|array).
 * @return string
 */
function luxe_esc_classes( $classes ) : string {
	if ( ! is_array( $classes ) ) {
		$classes = preg_split( '/\s+/', (string) $classes ) ?: [];
	}

	$clean = [];
	foreach ( $classes as $class ) {
		$class = sanitize_html_class( $class );
		if ( $class !== '' ) {
			$clean[] = $class;
		}
	}

	return esc_attr( implode( ' ', $clean ) );
}

/**
 * Sanitize a string intended for use as an HTML heading level (1–6).
 *
 * @param mixed $level
 * @return int
 */
function luxe_sanitize_heading_level( $level ) : int {
	$level = is_numeric( $level ) ? (int) $level : 2;
	return ( $level >= 1 && $level <= 6 ) ? $level : 2;
}

/**
 * Sanitize a hex color value, including the modern 8-digit alpha form.
 *
 * @param string $color
 * @return string
 */
function luxe_sanitize_hex_color( string $color ) : string {
	// Reuse the core sanitizer when available (it handles # and alpha).
	$core = sanitize_hex_color( $color );
	return is_string( $core ) ? $core : '';
}

/**
 * Sanitize an integer that should be non-negative.
 *
 * @param mixed $value
 * @return int
 */
function luxe_sanitize_positive_int( $value ) : int {
	$int = absint( $value );
	return $int > 0 ? $int : 0;
}

/**
 * Validate and sanitize a URL — returns empty string if invalid.
 *
 * @param string $url
 * @return string
 */
function luxe_sanitize_url( string $url ) : string {
	return esc_url_raw( $url );
}

/**
 * Sanitize a key/value pair array for use in data attributes.
 *
 * @param array $data
 * @return array
 */
function luxe_sanitize_data_attributes( array $data ) : array {
	$clean = [];
	foreach ( $data as $key => $value ) {
		$key   = sanitize_key( (string) $key );
		$value = esc_attr( (string) $value );
		$clean[ $key ] = $value;
	}
	return $clean;
}

/**
 * Return true when the current request is for the front page (static page or posts index).
 *
 * @return bool
 */
function luxe_is_front() : bool {
	return is_front_page() || ( is_home() && ! is_paged() );
}

/**
 * Verify a nonce and bail early if it fails.
 *
 * @param string $nonce_name The nonce field name (action and name are typically identical).
 * @param string $nonce_action The nonce action — usually the same string.
 * @return bool True on success, false on failure (dies with wp_die).
 *
 * @codingStandardsIgnoreStart
 */
function luxe_verify_nonce_or_die( string $nonce_name, string $nonce_action = '' ) : bool {
	if ( empty( $nonce_action ) ) {
		$nonce_action = $nonce_name;
	}

	if ( ! isset( $_POST[ $nonce_name ] ) && ! isset( $_GET[ $nonce_name ] ) ) {
		wp_die( esc_html__( 'Nonce field is missing.', 'luxe-fashion' ), 'nonce_missing', [ 'response' => 403 ] );
	}

	$nonce_value = $_POST[ $nonce_name ] ?? $_GET[ $nonce_name ] ?? '';
	return wp_verify_nonce( $nonce_value, $nonce_action );
}
// @codingStandardsIgnoreEnd
