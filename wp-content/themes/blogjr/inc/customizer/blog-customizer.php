<?php
/**
 * Blog / Archive / Search Customizer Options
 *
 * @package blogjr
 */

// Add blog section
$wp_customize->add_section( 'blogjr_blog_section', array(
	'title'             => esc_html__( 'Archive Page Setting','blogjr' ),
	'description'       => esc_html__( 'Archive/Search Page Setting Options', 'blogjr' ),
	'panel'             => 'blogjr_theme_options_panel',
) );

// sidebar layout setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[sidebar_layout]', array(
	'sanitize_callback'   => 'blogjr_sanitize_select',
	'default'             => blogjr_theme_option('sidebar_layout'),
) );

$wp_customize->add_control(  new BlogJr_Radio_Image_Control ( $wp_customize, 'blogjr_theme_options[sidebar_layout]', array(
	'label'               => esc_html__( 'Sidebar Layout', 'blogjr' ),
	'description'         => esc_html__( 'Note: Option for Archive and Search Page.', 'blogjr' ),
	'section'             => 'blogjr_blog_section',
	'choices'			  => blogjr_sidebar_position(),
) ) );

// alignment control and setting
$wp_customize->add_setting( 'blogjr_theme_options[archive_layout]', array(
	'default'          	=> blogjr_theme_option('archive_layout'),
	'sanitize_callback' => 'blogjr_sanitize_select',
) );

$wp_customize->add_control( 'blogjr_theme_options[archive_layout]', array(
	'label'             => esc_html__( 'Layout', 'blogjr' ),
	'section'           => 'blogjr_blog_section',
	'type'				=> 'radio',
	'choices'			=> array( 
		'left-align' 		=> esc_html__( 'Left Align', 'blogjr' ),
		'center-align' 		=> esc_html__( 'Center Align', 'blogjr' ),
		'image-focus' 		=> esc_html__( 'Image Focus', 'blogjr' ),
		'image-focus-outline' => esc_html__( 'Image Focus Content Outline', 'blogjr' ),
	),
) );

// column control and setting
$wp_customize->add_setting( 'blogjr_theme_options[column_type]', array(
	'default'          	=> blogjr_theme_option('column_type'),
	'sanitize_callback' => 'blogjr_sanitize_select',
) );

$wp_customize->add_control( 'blogjr_theme_options[column_type]', array(
	'label'             => esc_html__( 'Column Layout', 'blogjr' ),
	'description'         => esc_html__( 'Note: Option for Archive and Search Page.', 'blogjr' ),
	'section'           => 'blogjr_blog_section',
	'type'				=> 'radio',
	'choices'			=> array( 
		'column-1' 		=> esc_html__( 'One Column', 'blogjr' ),
		'column-2' 		=> esc_html__( 'Two Column', 'blogjr' ),
		'column-3' 		=> esc_html__( 'Three Column', 'blogjr' ),
		'column-4' 		=> esc_html__( 'Four Column', 'blogjr' ),
		'column-5' 		=> esc_html__( 'Five Column', 'blogjr' ),
	),
) );

// pagination control and setting
$wp_customize->add_setting( 'blogjr_theme_options[pagination_type]', array(
	'default'          	=> blogjr_theme_option('pagination_type'),
	'sanitize_callback' => 'blogjr_sanitize_select',
) );

$wp_customize->add_control( 'blogjr_theme_options[pagination_type]', array(
	'label'             => esc_html__( 'Pagination Type', 'blogjr' ),
	'section'           => 'blogjr_blog_section',
	'type'				=> 'radio',
	'choices'			=> array( 
		'default' 		=> esc_html__( 'Default', 'blogjr' ),
		'numeric' 		=> esc_html__( 'Numeric', 'blogjr' ),
		'infinite' 		=> esc_html__( 'Infinite', 'blogjr' ),
		'click' 		=> esc_html__( 'Load More Button', 'blogjr' ),
	),
) );

// excerpt count control and setting
$wp_customize->add_setting( 'blogjr_theme_options[excerpt_count]', array(
	'default'          	=> blogjr_theme_option('excerpt_count'),
	'sanitize_callback' => 'blogjr_sanitize_number_range',
	'validate_callback' => 'blogjr_validate_excerpt_count',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'blogjr_theme_options[excerpt_count]', array(
	'label'             => esc_html__( 'Excerpt Length', 'blogjr' ),
	'description'       => esc_html__( 'Note: Min 1 & Max 50.', 'blogjr' ),
	'section'           => 'blogjr_blog_section',
	'type'				=> 'number',
	'input_attrs'		=> array(
		'min'	=> 1,
		'max'	=> 50,
		),
) );

// Archive date meta setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[show_date]', array(
	'default'           => blogjr_theme_option( 'show_date' ),
	'sanitize_callback' => 'blogjr_sanitize_switch',
) );

$wp_customize->add_control( new BlogJr_Switch_Control( $wp_customize, 'blogjr_theme_options[show_date]', array(
	'label'             => esc_html__( 'Show Date', 'blogjr' ),
	'section'           => 'blogjr_blog_section',
	'on_off_label' 		=> blogjr_show_options(),
) ) );

// Archive category meta setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[show_category]', array(
	'default'           => blogjr_theme_option( 'show_category' ),
	'sanitize_callback' => 'blogjr_sanitize_switch',
) );

$wp_customize->add_control( new BlogJr_Switch_Control( $wp_customize, 'blogjr_theme_options[show_category]', array(
	'label'             => esc_html__( 'Show Category', 'blogjr' ),
	'section'           => 'blogjr_blog_section',
	'on_off_label' 		=> blogjr_show_options(),
) ) );

// Archive author meta setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[show_author]', array(
	'default'           => blogjr_theme_option( 'show_author' ),
	'sanitize_callback' => 'blogjr_sanitize_switch',
) );

$wp_customize->add_control( new BlogJr_Switch_Control( $wp_customize, 'blogjr_theme_options[show_author]', array(
	'label'             => esc_html__( 'Show Author', 'blogjr' ),
	'section'           => 'blogjr_blog_section',
	'on_off_label' 		=> blogjr_show_options(),
) ) );

// Archive read time meta setting and control.
$wp_customize->add_setting( 'blogjr_theme_options[show_read_time]', array(
	'default'           => blogjr_theme_option( 'show_read_time' ),
	'sanitize_callback' => 'blogjr_sanitize_switch',
) );

$wp_customize->add_control( new BlogJr_Switch_Control( $wp_customize, 'blogjr_theme_options[show_read_time]', array(
	'label'             => esc_html__( 'Show Read Time', 'blogjr' ),
	'section'           => 'blogjr_blog_section',
	'on_off_label' 		=> blogjr_show_options(),
) ) );
