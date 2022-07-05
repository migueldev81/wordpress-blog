<?php
/**
 * latest blog Customizer Options
 *
 * @package blogjr
 */

// Add blog section
$wp_customize->add_section( 'blogjr_latest_blog_section', array(
	'title'             => esc_html__( 'Latest Blog Section','blogjr' ),
	'description'       => esc_html__( 'Latest Blog Page Options', 'blogjr' ),
	'panel'             => 'blogjr_homepage_sections_panel',
) );

// latest blog menu enable setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[enable_latest_blog]', array(
	'default'           => blogjr_theme_option('enable_latest_blog'),
	'sanitize_callback' => 'blogjr_sanitize_switch',
) );

$wp_customize->add_control( new BlogJr_Switch_Control( $wp_customize, 'blogjr_theme_options[enable_latest_blog]', array(
	'label'             => esc_html__( 'Enable Latest Blog', 'blogjr' ),
	'section'           => 'blogjr_latest_blog_section',
	'on_off_label' 		=> blogjr_show_options(),
) ) );

// latest blog menu enable setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[latest_blog_sidebar]', array(
	'default'           => blogjr_theme_option('latest_blog_sidebar'),
	'sanitize_callback' => 'blogjr_sanitize_switch',
) );

$wp_customize->add_control( new BlogJr_Switch_Control( $wp_customize, 'blogjr_theme_options[latest_blog_sidebar]', array(
	'label'             => esc_html__( 'Enable Sidebar', 'blogjr' ),
	'section'           => 'blogjr_latest_blog_section',
	'on_off_label' 		=> blogjr_show_options(),
) ) );

// latest blog title drop down chooser control and setting
$wp_customize->add_setting( 'blogjr_theme_options[latest_blog_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'          	=> blogjr_theme_option( 'latest_blog_title' ),
) );

$wp_customize->add_control( 'blogjr_theme_options[latest_blog_title]', array(
	'label'             => esc_html__( 'Latest Blog Title', 'blogjr' ),
	'description'       => esc_html__( 'Note: This title is displayed when your homepage displays option is set to latest posts.', 'blogjr' ),
	'section'           => 'blogjr_latest_blog_section',
	'type'				=> 'text',
) );

// alignment control and setting
$wp_customize->add_setting( 'blogjr_theme_options[blog_layout]', array(
	'default'          	=> blogjr_theme_option('blog_layout'),
	'sanitize_callback' => 'blogjr_sanitize_select',
) );

$wp_customize->add_control( 'blogjr_theme_options[blog_layout]', array(
	'label'             => esc_html__( 'Layout', 'blogjr' ),
	'section'           => 'blogjr_latest_blog_section',
	'type'				=> 'radio',
	'choices'			=> array( 
		'left-align' 		=> esc_html__( 'Left Align', 'blogjr' ),
		'center-align' 		=> esc_html__( 'Center Align', 'blogjr' ),
	),
) );

// column control and setting
$wp_customize->add_setting( 'blogjr_theme_options[blog_column_type]', array(
	'default'          	=> blogjr_theme_option('blog_column_type'),
	'sanitize_callback' => 'blogjr_sanitize_select',
) );

$wp_customize->add_control( 'blogjr_theme_options[blog_column_type]', array(
	'label'             => esc_html__( 'Column', 'blogjr' ),
	'section'           => 'blogjr_latest_blog_section',
	'type'				=> 'radio',
	'choices'			=> array( 
		'column-1' 		=> esc_html__( 'One Column', 'blogjr' ),
		'column-zigzag' => esc_html__( 'One Column ZigZag', 'blogjr' ),
		'column-horizontal' => esc_html__( 'One Column Horizontal', 'blogjr' ),
	),
) );
