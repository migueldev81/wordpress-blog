<?php
/**
 * Popular Customizer Options
 *
 * @package blogjr
 */

// Add popular section
$wp_customize->add_section( 'blogjr_popular_section', array(
	'title'             => esc_html__( 'Popular Section','blogjr' ),
	'description'       => esc_html__( 'Popular Setting Options', 'blogjr' ),
	'panel'             => 'blogjr_homepage_sections_panel',
) );

// popular enable setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[enable_popular]', array(
	'default'           => blogjr_theme_option('enable_popular'),
	'sanitize_callback' => 'blogjr_sanitize_switch',
) );

$wp_customize->add_control( new BlogJr_Switch_Control( $wp_customize, 'blogjr_theme_options[enable_popular]', array(
	'label'             => esc_html__( 'Enable Popular', 'blogjr' ),
	'section'           => 'blogjr_popular_section',
	'on_off_label' 		=> blogjr_show_options(),
) ) );

// popular title control and setting
$wp_customize->add_setting( 'blogjr_theme_options[popular_title]', array(
	'default'          	=> blogjr_theme_option('popular_title'),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'blogjr_theme_options[popular_title]', array(
	'label'             => esc_html__( 'Title', 'blogjr' ),
	'section'           => 'blogjr_popular_section',
	'type'				=> 'text',
) );

for ( $i = 1; $i <= 3; $i++ ) :

	// popular posts drop down chooser control and setting
	$wp_customize->add_setting( 'blogjr_theme_options[popular_content_post_' . $i . ']', array(
		'sanitize_callback' => 'blogjr_sanitize_page_post',
	) );

	$wp_customize->add_control( new BlogJr_Dropdown_Chosen_Control( $wp_customize, 'blogjr_theme_options[popular_content_post_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Post %d', 'blogjr' ), $i ),
		'section'           => 'blogjr_popular_section',
		'choices'			=> blogjr_post_choices(),
	) ) );

endfor;
