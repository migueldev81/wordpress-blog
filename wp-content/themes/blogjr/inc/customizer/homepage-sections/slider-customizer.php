<?php
/**
 * Slider Customizer Options
 *
 * @package blogjr
 */

// Add slider section
$wp_customize->add_section( 'blogjr_slider_section', array(
	'title'             => esc_html__( 'Slider Section','blogjr' ),
	'description'       => esc_html__( 'Slider Setting Options', 'blogjr' ),
	'panel'             => 'blogjr_homepage_sections_panel',
) );

// slider menu enable setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[enable_slider]', array(
	'default'           => blogjr_theme_option('enable_slider'),
	'sanitize_callback' => 'blogjr_sanitize_switch',
) );

$wp_customize->add_control( new BlogJr_Switch_Control( $wp_customize, 'blogjr_theme_options[enable_slider]', array(
	'label'             => esc_html__( 'Enable Slider', 'blogjr' ),
	'section'           => 'blogjr_slider_section',
	'on_off_label' 		=> blogjr_show_options(),
) ) );

// slider social menu enable setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[slider_entire_site]', array(
	'default'           => blogjr_theme_option('slider_entire_site'),
	'sanitize_callback' => 'blogjr_sanitize_switch',
) );

$wp_customize->add_control( new BlogJr_Switch_Control( $wp_customize, 'blogjr_theme_options[slider_entire_site]', array(
	'label'             => esc_html__( 'Show Entire Site', 'blogjr' ),
	'section'           => 'blogjr_slider_section',
	'on_off_label' 		=> blogjr_show_options(),
) ) );

// slider arrow control enable setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[slider_arrow]', array(
	'default'           => blogjr_theme_option('slider_arrow'),
	'sanitize_callback' => 'blogjr_sanitize_switch',
) );

$wp_customize->add_control( new BlogJr_Switch_Control( $wp_customize, 'blogjr_theme_options[slider_arrow]', array(
	'label'             => esc_html__( 'Show Arrow Controller', 'blogjr' ),
	'section'           => 'blogjr_slider_section',
	'on_off_label' 		=> blogjr_show_options(),
) ) );

// slider auto slide control enable setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[slider_auto_slide]', array(
	'default'           => blogjr_theme_option('slider_auto_slide'),
	'sanitize_callback' => 'blogjr_sanitize_switch',
) );

$wp_customize->add_control( new BlogJr_Switch_Control( $wp_customize, 'blogjr_theme_options[slider_auto_slide]', array(
	'label'             => esc_html__( 'Auto Slide', 'blogjr' ),
	'section'           => 'blogjr_slider_section',
	'on_off_label' 		=> blogjr_show_options(),
) ) );

// slider trasnition control and setting
$wp_customize->add_setting( 'blogjr_theme_options[slider_width]', array(
	'default'          	=> blogjr_theme_option('slider_width'),
	'sanitize_callback' => 'blogjr_sanitize_select',
) );

$wp_customize->add_control( 'blogjr_theme_options[slider_width]', array(
	'label'             => esc_html__( 'Slider Width', 'blogjr' ),
	'section'           => 'blogjr_slider_section',
	'type'				=> 'radio',
	'choices'			=> array( 
		'full-width' 		=> esc_html__( 'Full Width', 'blogjr' ),
		'container-width' 	=> esc_html__( 'Container Width', 'blogjr' ),
	),
) );

for ( $i = 1; $i <= 5; $i++ ) :

	// slider posts drop down chooser control and setting
	$wp_customize->add_setting( 'blogjr_theme_options[slider_content_post_' . $i . ']', array(
		'sanitize_callback' => 'blogjr_sanitize_page_post',
	) );

	$wp_customize->add_control( new BlogJr_Dropdown_Chosen_Control( $wp_customize, 'blogjr_theme_options[slider_content_post_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Post %d', 'blogjr' ), $i ),
		'section'           => 'blogjr_slider_section',
		'choices'			=> blogjr_post_choices(),
	) ) );

endfor;
