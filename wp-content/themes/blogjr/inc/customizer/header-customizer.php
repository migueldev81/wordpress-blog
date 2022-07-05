<?php
/**
 * Header Customizer Options
 *
 * @package blogjr
 */

// Add header section
$wp_customize->add_section( 'blogjr_header_section', array(
	'title'             => esc_html__( 'Header Section','blogjr' ),
	'description'       => esc_html__( 'Header Setting Options', 'blogjr' ),
	'panel'             => 'blogjr_theme_options_panel',
) );

// header search setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[enable_header_search]', array(
	'default'           => blogjr_theme_option( 'enable_header_search' ),
	'sanitize_callback' => 'blogjr_sanitize_switch',
) );

$wp_customize->add_control( new BlogJr_Switch_Control( $wp_customize, 'blogjr_theme_options[enable_header_search]', array(
	'label'             => esc_html__( 'Enable Search in Header', 'blogjr' ),
	'section'           => 'blogjr_header_section',
	'on_off_label' 		=> blogjr_show_options(),
) ) );

// header alignment control and setting
$wp_customize->add_setting( 'blogjr_theme_options[header_alignment]', array(
	'default'          	=> blogjr_theme_option('header_alignment'),
	'sanitize_callback' => 'blogjr_sanitize_select',
) );

$wp_customize->add_control( 'blogjr_theme_options[header_alignment]', array(
	'label'             => esc_html__( 'Header Alignment', 'blogjr' ),
	'section'           => 'blogjr_header_section',
	'type'				=> 'radio',
	'choices'			=> array( 
		'left-align' 		=> esc_html__( 'Left Align', 'blogjr' ),
		'center-align' 		=> esc_html__( 'Center Align', 'blogjr' ),
	),
) );

