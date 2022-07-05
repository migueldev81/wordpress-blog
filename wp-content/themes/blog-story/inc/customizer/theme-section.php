<?php
/**
 * Theme Options.
 *
 * @package Blog Story
 */

$default = blog_story_get_default_theme_options();

// Add Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
	'title'      => __( 'Theme Options', 'blog-story' ),
	'priority'   => 150,
	'capability' => 'edit_theme_options',
	)
);

// Page Title
$wp_customize->add_section('section_page_title', 
	array(    
	'title'       => __('Page Title', 'blog-story'),
	'panel'       => 'theme_option_panel'    
	)
);

// Show / Hide Page Title
$wp_customize->add_setting( 'theme_options[show_page_title]', array(
	'default'           => $default['show_page_title'],
	'sanitize_callback' => 'blog_story_sanitize_select',
) );

$wp_customize->add_control( 'theme_options[show_page_title]', array(
	'label'              => esc_html__( 'Display Page Title', 'blog-story' ),
	'section'            => 'section_page_title',
	'type'               => 'select',
	'choices' 	         => array(		
		'page-title-enable' 	 => 'Yes',						
		'page-title-disable'     => 'No',
	),	
) );

// Sidebar Layout
$wp_customize->add_section('section_sidebar_layout', array(    
	'title'       => __('Sidebar Layout', 'blog-story'),
	'panel'       => 'theme_option_panel'    
));

// Blog Layout
$wp_customize->add_setting('theme_options[layout_options_blog]', 
	array(
	'default' 			=> $default['layout_options_blog'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_story_sanitize_select'
	)
);

$wp_customize->add_control(new blog_story_Image_Radio_Control($wp_customize, 'theme_options[layout_options_blog]', 
	array(		
	'label' 	=> __('Blog Layout', 'blog-story'),
	'section' 	=> 'section_sidebar_layout',
	'settings'  => 'theme_options[layout_options_blog]',
	'type' 		=> 'radio-image',
	'choices' 	=> array(		
		'left-sidebar' 	=> get_template_directory_uri() . '/assets/images/left-sidebar.png',						
		'right-sidebar' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
		'no-sidebar' 	=> get_template_directory_uri() . '/assets/images/no-sidebar.png',
		),	
	))
);

// Archive Layout
$wp_customize->add_setting('theme_options[layout_options_archive]', 
	array(
	'default' 			=> $default['layout_options_archive'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_story_sanitize_select'
	)
);

$wp_customize->add_control(new blog_story_Image_Radio_Control($wp_customize, 'theme_options[layout_options_archive]', 
	array(		
	'label' 	=> __('Archive Layout', 'blog-story'),
	'section' 	=> 'section_sidebar_layout',
	'settings'  => 'theme_options[layout_options_archive]',
	'type' 		=> 'radio-image',
	'choices' 	=> array(		
		'left-sidebar' 	=> get_template_directory_uri() . '/assets/images/left-sidebar.png',						
		'right-sidebar' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
		'no-sidebar' 	=> get_template_directory_uri() . '/assets/images/no-sidebar.png',
		),	
	))
);


// Page Layout
$wp_customize->add_setting('theme_options[layout_options_page]', 
	array(
	'default' 			=> $default['layout_options_page'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_story_sanitize_select'
	)
);

$wp_customize->add_control(new blog_story_Image_Radio_Control($wp_customize, 'theme_options[layout_options_page]', 
	array(		
	'label' 	=> __('Page Layout', 'blog-story'),
	'section' 	=> 'section_sidebar_layout',
	'settings'  => 'theme_options[layout_options_page]',
	'type' 		=> 'radio-image',
	'choices' 	=> array(		
		'left-sidebar' 	=> get_template_directory_uri() . '/assets/images/left-sidebar.png',						
		'right-sidebar' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
		'no-sidebar' 	=> get_template_directory_uri() . '/assets/images/no-sidebar.png',
		),	
	))
);

// Single Post Layout
$wp_customize->add_setting('theme_options[layout_options_single]', 
	array(
	'default' 			=> $default['layout_options_single'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_story_sanitize_select'
	)
);

$wp_customize->add_control(new blog_story_Image_Radio_Control($wp_customize, 'theme_options[layout_options_single]', 
	array(		
	'label' 	=> __('Single Post Layout', 'blog-story'),
	'section' 	=> 'section_sidebar_layout',
	'settings'  => 'theme_options[layout_options_single]',
	'type' 		=> 'radio-image',
	'choices' 	=> array(		
		'left-sidebar' 	=> get_template_directory_uri() . '/assets/images/left-sidebar.png',						
		'right-sidebar' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
		'no-sidebar' 	=> get_template_directory_uri() . '/assets/images/no-sidebar.png',
		),	
	))
);

// Excerpt Length
$wp_customize->add_section('section_excerpt_length', 
	array(    
	'title'       => __('Excerpt Length', 'blog-story'),
	'panel'       => 'theme_option_panel'    
	)
);

$wp_customize->add_setting( 'theme_options[excerpt_length]', array(
	'default'           => $default['excerpt_length'],
	'sanitize_callback' => 'blog_story_sanitize_number_range',
) );
$wp_customize->add_control( 'theme_options[excerpt_length]', array(
	'label'       => esc_html__( 'Excerpt Length', 'blog-story' ),
	'section'     => 'section_excerpt_length',
	'type'        => 'number',
	'input_attrs' => array( 'min' => 1, 'max' => 200, 'style' => 'width: 80px;' ),
) );

// Blog Settings
$wp_customize->add_section('section_blog_setting', 
	array(    
	'title'       => __('Blog Title', 'blog-story'),
	'panel'       => 'theme_option_panel'    
	)
);

// Blog Title
$wp_customize->add_setting( 'theme_options[your_latest_posts_title]',
	array(
	'default'           => $default['your_latest_posts_title'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'blog_story_sanitize_textarea_content',
	'transport'         => 'refresh',
	)
);
$wp_customize->add_control( 'theme_options[your_latest_posts_title]',
	array(
	'label'    => __( 'Blog Title', 'blog-story' ),
	'section'  => 'section_blog_setting',
	'type'     => 'text',
	)
);

// Footer Setting Section starts
$wp_customize->add_section('section_footer', 
	array(    
	'title'       => __('Footer Setting', 'blog-story'),
	'panel'       => 'theme_option_panel'    
	)
);

// Setting copyright_text.
$wp_customize->add_setting( 'theme_options[copyright_text]',
	array(
	'default'           => $default['copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'         => 'refresh',
	)
);
$wp_customize->add_control( 'theme_options[copyright_text]',
	array(
	'label'    => __( 'Copyright Text', 'blog-story' ),
	'section'  => 'section_footer',
	'type'     => 'text',
	'priority' => 100,
	)
);

// Homepage Static setting and control.
$wp_customize->add_setting( 'theme_options[enable_frontpage_content]', array(
	'default'             => $default['enable_frontpage_content'],
	'sanitize_callback'   => 'blog_story_sanitize_checkbox',
) );

$wp_customize->add_control( 'theme_options[enable_frontpage_content]', array(
	'label'       	=> __( 'Enable Content', 'blog-story' ),
	'description' 	=> __( 'Click to enable content on static front page only.', 'blog-story' ),
	'section'     	=> 'static_front_page',
	'type'        	=> 'checkbox',
) );

// Show / Hide Frontpage Content
$wp_customize->add_setting( 'theme_options[enable_frontpage_content]', array(
	'default'             => $default['enable_frontpage_content'],
	'sanitize_callback'   => 'blog_story_sanitize_checkbox',
) );

$wp_customize->add_control( 'theme_options[enable_frontpage_content]', array(
	'label'       	=> esc_html__( 'Enable Homepage Content', 'blog-story' ),
	'description' 	=> esc_html__( 'Enable content on A static page.', 'blog-story' ),
	'section'     	=> 'static_front_page',
	'type'        	=> 'checkbox',
) );

// Show / Hide Header Image
$wp_customize->add_setting( 'theme_options[show_header_image]', array(
	'default'           => $default['show_header_image'],
	'sanitize_callback' => 'blog_story_sanitize_select',
) );

$wp_customize->add_control( 'theme_options[show_header_image]', array(
	'label'              => esc_html__( 'Display Header Image', 'blog-story' ),
	'section'            => 'header_image',
	'type'               => 'select',
	'choices' 	         => array(		
		'header-image-enable' 	   => 'Yes',						
		'header-image-disable'     => 'No',
	),	
) );

// Theme Color
$wp_customize->add_setting( 'theme_options[custom_theme_color]', array(
	'default'           => $default['custom_theme_color'],
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_options[custom_theme_color]', array(
	'label'             => esc_html__( 'Custom Theme Color', 'blog-story' ),
	'section'           => 'colors',
) ) );