<?php
/**
 * Footer Customizer Options
 *
 * @package blogjr
 */

// Add footer section
$wp_customize->add_section( 'blogjr_footer_section', array(
	'title'             => esc_html__( 'Footer Section','blogjr' ),
	'description'       => esc_html__( 'Footer Setting Options', 'blogjr' ),
	'panel'             => 'blogjr_theme_options_panel',
) );

// slide to top enable setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[slide_to_top]', array(
	'default'           => blogjr_theme_option('slide_to_top'),
	'sanitize_callback' => 'blogjr_sanitize_switch',
) );

$wp_customize->add_control( new BlogJr_Switch_Control( $wp_customize, 'blogjr_theme_options[slide_to_top]', array(
	'label'             => esc_html__( 'Show Slide to Top', 'blogjr' ),
	'section'           => 'blogjr_footer_section',
	'on_off_label' 		=> blogjr_show_options(),
) ) );

// copyright text
$wp_customize->add_setting( 'blogjr_theme_options[copyright_text]',
	array(
		'default'       		=> blogjr_theme_option('copyright_text'),
		'sanitize_callback'		=> 'blogjr_santize_allow_tags',
	)
);
$wp_customize->add_control( 'blogjr_theme_options[copyright_text]',
    array(
		'label'      			=> esc_html__( 'Copyright Text', 'blogjr' ),
		'section'    			=> 'blogjr_footer_section',
		'type'		 			=> 'textarea',
    )
);
