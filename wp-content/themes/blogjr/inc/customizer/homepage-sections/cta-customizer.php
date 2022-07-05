<?php
/**
 * Call to Action Customizer Options
 *
 * @package blogjr
 */

// Add cta section
$wp_customize->add_section( 'blogjr_cta_section', array(
	'title'             => esc_html__( 'Call to Action Section','blogjr' ),
	'description'       => esc_html__( 'Call to Action Setting Options', 'blogjr' ),
	'panel'             => 'blogjr_homepage_sections_panel',
) );

// cta menu enable setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[enable_cta]', array(
	'default'           => blogjr_theme_option('enable_cta'),
	'sanitize_callback' => 'blogjr_sanitize_switch',
) );

$wp_customize->add_control( new BlogJr_Switch_Control( $wp_customize, 'blogjr_theme_options[enable_cta]', array(
	'label'             => esc_html__( 'Enable Call to Action', 'blogjr' ),
	'section'           => 'blogjr_cta_section',
	'on_off_label' 		=> blogjr_show_options(),
) ) );

// cta trasnition control and setting
$wp_customize->add_setting( 'blogjr_theme_options[cta_width]', array(
	'default'          	=> blogjr_theme_option('cta_width'),
	'sanitize_callback' => 'blogjr_sanitize_select',
) );

$wp_customize->add_control( 'blogjr_theme_options[cta_width]', array(
	'label'             => esc_html__( 'Call to Action Width', 'blogjr' ),
	'section'           => 'blogjr_cta_section',
	'type'				=> 'radio',
	'choices'			=> array( 
		'full-width' 		=> esc_html__( 'Full Width', 'blogjr' ),
		'container-width' 	=> esc_html__( 'Container Width', 'blogjr' ),
	),
) );

// cta pages drop down chooser control and setting
$wp_customize->add_setting( 'blogjr_theme_options[cta_content_page]', array(
	'sanitize_callback' => 'blogjr_sanitize_page_post',
) );

$wp_customize->add_control( new BlogJr_Dropdown_Chosen_Control( $wp_customize, 'blogjr_theme_options[cta_content_page]', array(
	'label'             => esc_html__( 'Select Page', 'blogjr' ),
	'section'           => 'blogjr_cta_section',
	'choices'			=> blogjr_page_choices(),
) ) );

// cta btn label drop down chooser control and setting
$wp_customize->add_setting( 'blogjr_theme_options[cta_btn_label]', array(
	'default'           => blogjr_theme_option('cta_btn_label'),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'blogjr_theme_options[cta_btn_label]', array(
	'label'             => esc_html__( 'Button Label', 'blogjr' ),
	'section'           => 'blogjr_cta_section',
	'type'				=> 'text',
) );