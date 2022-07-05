<?php
/**
 * Single Post Customizer Options
 *
 * @package blogjr
 */

// Add excerpt section
$wp_customize->add_section( 'blogjr_single_section', array(
	'title'             => esc_html__( 'Single Post Setting','blogjr' ),
	'description'       => esc_html__( 'Single Post Setting Options', 'blogjr' ),
	'panel'             => 'blogjr_theme_options_panel',
) );

// sidebar layout setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[sidebar_single_layout]', array(
	'sanitize_callback'   => 'blogjr_sanitize_select',
	'default'             => blogjr_theme_option('sidebar_single_layout'),
) );

$wp_customize->add_control(  new BlogJr_Radio_Image_Control ( $wp_customize, 'blogjr_theme_options[sidebar_single_layout]', array(
	'label'               => esc_html__( 'Sidebar Layout', 'blogjr' ),
	'section'             => 'blogjr_single_section',
	'choices'			  => blogjr_sidebar_position(),
) ) );

// Archive date meta setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[show_single_date]', array(
	'default'           => blogjr_theme_option( 'show_single_date' ),
	'sanitize_callback' => 'blogjr_sanitize_switch',
) );

$wp_customize->add_control( new BlogJr_Switch_Control( $wp_customize, 'blogjr_theme_options[show_single_date]', array(
	'label'             => esc_html__( 'Show Date', 'blogjr' ),
	'section'           => 'blogjr_single_section',
	'on_off_label' 		=> blogjr_show_options(),
) ) );

// Archive category meta setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[show_single_category]', array(
	'default'           => blogjr_theme_option( 'show_single_category' ),
	'sanitize_callback' => 'blogjr_sanitize_switch',
) );

$wp_customize->add_control( new BlogJr_Switch_Control( $wp_customize, 'blogjr_theme_options[show_single_category]', array(
	'label'             => esc_html__( 'Show Category', 'blogjr' ),
	'section'           => 'blogjr_single_section',
	'on_off_label' 		=> blogjr_show_options(),
) ) );

// Archive category meta setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[show_single_tags]', array(
	'default'           => blogjr_theme_option( 'show_single_tags' ),
	'sanitize_callback' => 'blogjr_sanitize_switch',
) );

$wp_customize->add_control( new BlogJr_Switch_Control( $wp_customize, 'blogjr_theme_options[show_single_tags]', array(
	'label'             => esc_html__( 'Show Tags', 'blogjr' ),
	'section'           => 'blogjr_single_section',
	'on_off_label' 		=> blogjr_show_options(),
) ) );

// Archive author meta setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[show_single_author]', array(
	'default'           => blogjr_theme_option( 'show_single_author' ),
	'sanitize_callback' => 'blogjr_sanitize_switch',
) );

$wp_customize->add_control( new BlogJr_Switch_Control( $wp_customize, 'blogjr_theme_options[show_single_author]', array(
	'label'             => esc_html__( 'Show Author', 'blogjr' ),
	'section'           => 'blogjr_single_section',
	'on_off_label' 		=> blogjr_show_options(),
) ) );
