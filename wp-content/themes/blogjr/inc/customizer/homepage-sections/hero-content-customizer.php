<?php
/**
 * Hero Content Customizer Options
 *
 * @package blogjr
 */

// Add hero_content section
$wp_customize->add_section( 'blogjr_hero_content_section', array(
	'title'             => esc_html__( 'Hero Content Section','blogjr' ),
	'description'       => esc_html__( 'Hero Content Setting Options', 'blogjr' ),
	'panel'             => 'blogjr_homepage_sections_panel',
) );

// hero_content menu enable setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[enable_hero_content]', array(
	'default'           => blogjr_theme_option('enable_hero_content'),
	'sanitize_callback' => 'blogjr_sanitize_switch',
) );

$wp_customize->add_control( new BlogJr_Switch_Control( $wp_customize, 'blogjr_theme_options[enable_hero_content]', array(
	'label'             => esc_html__( 'Enable Hero Content', 'blogjr' ),
	'section'           => 'blogjr_hero_content_section',
	'on_off_label' 		=> blogjr_show_options(),
) ) );

// hero_content content type control and setting
$wp_customize->add_setting( 'blogjr_theme_options[hero_content_alignment]', array(
	'default'          	=> blogjr_theme_option('hero_content_alignment'),
	'sanitize_callback' => 'blogjr_sanitize_select',
) );

$wp_customize->add_control( 'blogjr_theme_options[hero_content_alignment]', array(
	'label'             => esc_html__( 'Alignment', 'blogjr' ),
	'section'           => 'blogjr_hero_content_section',
	'type'				=> 'radio',
	'choices'			=> array( 
		'align-left' 		=> esc_html__( 'Left Align', 'blogjr' ),
		'align-center' 		=> esc_html__( 'Center Align', 'blogjr' ),
	),
) );

// hero_content pages drop down chooser control and setting
$wp_customize->add_setting( 'blogjr_theme_options[hero_content_content_page]', array(
	'sanitize_callback' => 'blogjr_sanitize_page_post',
) );

$wp_customize->add_control( new BlogJr_Dropdown_Chosen_Control( $wp_customize, 'blogjr_theme_options[hero_content_content_page]', array(
	'label'             => esc_html__( 'Select Page', 'blogjr' ),
	'section'           => 'blogjr_hero_content_section',
	'choices'			=> blogjr_page_choices(),
) ) );
