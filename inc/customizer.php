<?php
/**
 * Luxe Fashion — Theme Customizer API
 *
 * @package Luxe_Fashion
 * @since 1.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function luxe_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Add our sections, settings, and controls.
	luxe_customize_register_sections( $wp_customize );
	luxe_customize_register_settings( $wp_customize );
	luxe_customize_register_controls( $wp_customize );
}
add_action( 'customize_register', 'luxe_customize_register' );

/**
 * Register sections.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function luxe_customize_register_sections( $wp_customize ) {
	// Brand Story Section
	$wp_customize->add_section( 'luxe_brand_story_section', array(
		'title'    => esc_html__( 'Brand Story', 'luxe-fashion' ),
		'priority' => 30,
	) );

	// Instagram Section
	$wp_customize->add_section( 'luxe_instagram_section', array(
		'title'    => esc_html__( 'Instagram Feed', 'luxe-fashion' ),
		'priority' => 35,
	) );

	// Newsletter Section
	$wp_customize->add_section( 'luxe_newsletter_section', array(
		'title'    => esc_html__( 'Newsletter', 'luxe-fashion' ),
		'priority' => 40,
	) );

	// Header Section
	$wp_customize->add_section( 'luxe_header', array(
		'title'    => esc_html__( 'Header Settings', 'luxe-fashion' ),
		'priority' => 25,
	) );

	// Homepage Sections
	$wp_customize->add_section( 'luxe_homepage_sections', array(
		'title'    => esc_html__( 'Homepage Sections', 'luxe-fashion' ),
		'priority' => 20,
	) );

	// Layout Section
	$wp_customize->add_section( 'luxe_layout_section', array(
		'title'    => esc_html__( 'Layout', 'luxe-fashion' ),
		'priority' => 45,
	) );
}

/**
 * Register settings.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function luxe_customize_register_settings( $wp_customize ) {
	// Brand Story
	$wp_customize->add_setting( 'luxe_brand_story_enabled', array(
		'default'           => true,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'luxe_sanitize_checkbox',
	) );
	$wp_customize->add_setting( 'luxe_brand_story_content', array(
		'default'           => esc_html__( 'We craft timeless pieces for the modern woman.', 'luxe-fashion' ),
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_kses_post',
	) );

	// Instagram
	$wp_customize->add_setting( 'luxe_instagram_enabled', array(
		'default'           => true,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'luxe_sanitize_checkbox',
	) );
	$wp_customize->add_setting( 'luxe_instagram_username', array(
		'default'           => '',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Newsletter
	$wp_customize->add_setting( 'luxe_newsletter_enabled', array(
		'default'           => true,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'luxe_sanitize_checkbox',
	) );
	$wp_customize->add_setting( 'luxe_newsletter_title', array(
		'default'           => esc_html__( 'Join Our Community', 'luxe-fashion' ),
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_setting( 'luxe_newsletter_description', array(
		'default'           => esc_html__( 'Subscribe for exclusive offers, early access to new collections, and style inspiration.', 'luxe-fashion' ),
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_kses_post',
	) );

	// Hero settings
	$wp_customize->add_setting( 'luxe_hero_image', array(
		'default'           => '',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_setting( 'luxe_hero_title', array(
		'default'           => esc_html__( 'Timeless Elegance for the Modern Woman', 'luxe-fashion' ),
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_setting( 'luxe_hero_subtitle', array(
		'default'           => esc_html__( 'Discover our latest collection of curated fashion pieces designed for the contemporary woman.', 'luxe-fashion' ),
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_setting( 'luxe_lookbook_content', array(
		'default'           => esc_html__( 'Explore curated looks that blend sophistication with modern edge.', 'luxe-fashion' ),
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_kses_post',
	) );

	// Brand Story
	$wp_customize->add_setting( 'luxe_brand_story_text', array(
		'default'           => esc_html__( 'At Luxe Fashion, we believe true style is timeless. Our collections are designed for the modern woman who demands quality, sophistication, and effortless elegance.', 'luxe-fashion' ),
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_kses_post',
	) );

	// Instagram
	$wp_customize->add_setting( 'luxe_instagram_handle', array(
		'default'           => 'luxefashion',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Newsletter
	$wp_customize->add_setting( 'luxe_newsletter_text', array(
		'default'           => esc_html__( 'Get 10% off your first order when you sign up.', 'luxe-fashion' ),
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	// Layout
	$wp_customize->add_setting( 'luxe_show_page_sidebar', array(
		'default'           => true,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'luxe_sanitize_checkbox',
	) );
	$wp_customize->add_setting( 'luxe_show_post_sidebar', array(
		'default'           => false,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'luxe_sanitize_checkbox',
	) );
	$wp_customize->add_setting( 'luxe_show_footer', array(
		'default'           => true,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'luxe_sanitize_checkbox',
	) );
}

/**
 * Register controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function luxe_customize_register_controls( $wp_customize ) {
	// Hero controls
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'luxe_hero_image', array(
		'label'    => esc_html__( 'Hero Background Image', 'luxe-fashion' ),
		'section'  => 'luxe_homepage_sections',
		'settings' => 'luxe_hero_image',
		'type'     => 'image',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'luxe_hero_title', array(
		'label'    => esc_html__( 'Hero Title', 'luxe-fashion' ),
		'section'  => 'luxe_homepage_sections',
		'settings' => 'luxe_hero_title',
		'type'     => 'text',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'luxe_hero_subtitle', array(
		'label'    => esc_html__( 'Hero Subtitle', 'luxe-fashion' ),
		'section'  => 'luxe_homepage_sections',
		'settings' => 'luxe_hero_subtitle',
		'type'     => 'text',
	) ) );

	// Lookbook controls
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'luxe_lookbook_image', array(
		'label'    => esc_html__( 'Lookbook Image', 'luxe-fashion' ),
		'section'  => 'luxe_homepage_sections',
		'settings' => 'luxe_lookbook_image',
		'type'     => 'image',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'luxe_lookbook_content', array(
		'label'    => esc_html__( 'Lookbook Content', 'luxe-fashion' ),
		'section'  => 'luxe_homepage_sections',
		'settings' => 'luxe_lookbook_content',
		'type'     => 'textarea',
	) ) );

	// Brand Story
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'luxe_brand_story_text', array(
		'label'    => esc_html__( 'Brand Story Text', 'luxe-fashion' ),
		'section'  => 'luxe_homepage_sections',
		'settings' => 'luxe_brand_story_text',
		'type'     => 'textarea',
	) ) );

	// Instagram
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'luxe_instagram_handle', array(
		'label'    => esc_html__( 'Instagram Handle', 'luxe-fashion' ),
		'section'  => 'luxe_homepage_sections',
		'settings' => 'luxe_instagram_handle',
		'type'     => 'text',
	) ) );

	// Newsletter
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'luxe_newsletter_text', array(
		'label'    => esc_html__( 'Newsletter Subtitle', 'luxe-fashion' ),
		'section'  => 'luxe_homepage_sections',
		'settings' => 'luxe_newsletter_text',
		'type'     => 'text',
	) ) );

	// Brand Story controls
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'luxe_brand_story_enabled', array(
		'label'     => esc_html__( 'Enable Brand Story Section', 'luxe-fashion' ),
		'section'   => 'luxe_brand_story_section',
		'settings'  => 'luxe_brand_story_enabled',
		'type'      => 'checkbox',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'luxe_brand_story_content', array(
		'label'     => esc_html__( 'Brand Story Content', 'luxe-fashion' ),
		'section'   => 'luxe_brand_story_section',
		'settings'  => 'luxe_brand_story_content',
		'type'      => 'textarea',
	) ) );

	// Instagram controls
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'luxe_instagram_enabled', array(
		'label'     => esc_html__( 'Enable Instagram Feed', 'luxe-fashion' ),
		'section'   => 'luxe_instagram_section',
		'settings'  => 'luxe_instagram_enabled',
		'type'      => 'checkbox',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'luxe_instagram_username', array(
		'label'     => esc_html__( 'Instagram Username', 'luxe-fashion' ),
		'section'   => 'luxe_instagram_section',
		'settings'  => 'luxe_instagram_username',
		'type'      => 'text',
	) ) );

	// Newsletter controls
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'luxe_newsletter_enabled', array(
		'label'     => esc_html__( 'Enable Newsletter Signup', 'luxe-fashion' ),
		'section'   => 'luxe_newsletter_section',
		'settings'  => 'luxe_newsletter_enabled',
		'type'      => 'checkbox',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'luxe_newsletter_title', array(
		'label'     => esc_html__( 'Newsletter Title', 'luxe-fashion' ),
		'section'   => 'luxe_newsletter_section',
		'settings'  => 'luxe_newsletter_title',
		'type'      => 'text',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'luxe_newsletter_description', array(
		'label'     => esc_html__( 'Newsletter Description', 'luxe-fashion' ),
		'section'   => 'luxe_newsletter_section',
		'settings'  => 'luxe_newsletter_description',
		'type'      => 'textarea',
	) ) );

	// Layout controls
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'luxe_show_page_sidebar', array(
		'label'     => esc_html__( 'Show Sidebar on Pages', 'luxe-fashion' ),
		'section'   => 'luxe_layout_section',
		'settings'  => 'luxe_show_page_sidebar',
		'type'      => 'checkbox',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'luxe_show_post_sidebar', array(
		'label'     => esc_html__( 'Show Sidebar on Posts', 'luxe-fashion' ),
		'section'   => 'luxe_layout_section',
		'settings'  => 'luxe_show_post_sidebar',
		'type'      => 'checkbox',
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'luxe_show_footer', array(
		'label'     => esc_html__( 'Show Footer Widgets', 'luxe-fashion' ),
		'section'   => 'luxe_layout_section',
		'settings'  => 'luxe_show_footer',
		'type'      => 'checkbox',
	) ) );
}

/**
 * Sanitize a checkbox value.
 *
 * @param mixed $input
 * @return bool
 */
function luxe_sanitize_checkbox( $input ) {
	return ( isset( $input ) && $input == true ) ? true : false;
}

/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function luxe_customize_preview_js() {
	wp_enqueue_script( 'luxe-customizer-preview', get_template_directory_uri() . '/assets/js/customizer-preview.js', array( 'customize-preview' ), LUXE_THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'luxe_customize_preview_js' );