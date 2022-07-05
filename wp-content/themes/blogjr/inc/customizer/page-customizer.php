<?php
/**
 * Page Customizer Options
 *
 * @package blogjr
 */

// Add excerpt section
$wp_customize->add_section( 'blogjr_page_section', array(
	'title'             => esc_html__( 'Page Setting','blogjr' ),
	'description'       => esc_html__( 'Page Setting Options', 'blogjr' ),
	'panel'             => 'blogjr_theme_options_panel',
) );

// sidebar layout setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[sidebar_page_layout]', array(
	'sanitize_callback'   => 'blogjr_sanitize_select',
	'default'             => blogjr_theme_option('sidebar_page_layout'),
) );

$wp_customize->add_control(  new BlogJr_Radio_Image_Control ( $wp_customize, 'blogjr_theme_options[sidebar_page_layout]', array(
	'label'               => esc_html__( 'Sidebar Layout', 'blogjr' ),
	'section'             => 'blogjr_page_section',
	'choices'			  => blogjr_sidebar_position(),
) ) );
