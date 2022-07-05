<?php
/**
 * Global Customizer Options
 *
 * @package blogjr
 */

// Add Global section
$wp_customize->add_section( 'blogjr_global_section', array(
	'title'             => esc_html__( 'Global Setting','blogjr' ),
	'description'       => esc_html__( 'Global Setting Options', 'blogjr' ),
	'panel'             => 'blogjr_theme_options_panel',
) );

// site layout setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[site_layout]', array(
	'sanitize_callback'   => 'blogjr_sanitize_select',
	'default'             => blogjr_theme_option('site_layout'),
) );

$wp_customize->add_control(  new BlogJr_Radio_Image_Control ( $wp_customize, 'blogjr_theme_options[site_layout]', array(
	'label'               => esc_html__( 'Site Layout', 'blogjr' ),
	'section'             => 'blogjr_global_section',
	'choices'			  => blogjr_site_layout(),
) ) );

// loader setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[enable_loader]', array(
	'default'           => blogjr_theme_option( 'enable_loader' ),
	'sanitize_callback' => 'blogjr_sanitize_switch',
) );

$wp_customize->add_control( new BlogJr_Switch_Control( $wp_customize, 'blogjr_theme_options[enable_loader]', array(
	'label'             => esc_html__( 'Enable Loader', 'blogjr' ),
	'section'           => 'blogjr_global_section',
	'on_off_label' 		=> blogjr_show_options(),
) ) );

// loader type control and setting
$wp_customize->add_setting( 'blogjr_theme_options[loader_type]', array(
	'default'          	=> blogjr_theme_option('loader_type'),
	'sanitize_callback' => 'blogjr_sanitize_select',
) );

$wp_customize->add_control( 'blogjr_theme_options[loader_type]', array(
	'label'             => esc_html__( 'Loader Type', 'blogjr' ),
	'section'           => 'blogjr_global_section',
	'type'				=> 'select',
	'choices'			=> blogjr_get_spinner_list(),
) );
