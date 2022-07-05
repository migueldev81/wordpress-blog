<?php
/**
 * Default Theme Customizer Values
 *
 * @package blogjr
 */

function blogjr_get_default_theme_options() {
	$blogjr_default_options = array(
		// default options

		// Header Section
		'header_alignment'		=> 'left-align',

		// Slider
		'enable_slider'			=> false,
		'slider_entire_site'	=> false,
		'slider_arrow'			=> true,
		'slider_auto_slide'		=> false,
		'slider_column'			=> 1,
		'slider_width' 			=> 'full-width',
		'slider_layout' 		=> 'left-align',

		// Hero Content
		'enable_hero_content'	=> false,
		'hero_content_alignment'	=> 'align-center',

		// Popular
		'enable_popular'		=> false,

		// Call to action
		'enable_cta'			=> false,
		'cta_width'				=> 'full-width',
		'cta_btn_label'			=> esc_html__( 'Read Blog', 'blogjr' ),

		// Latest Blog
		'enable_latest_blog'	=> true,
		'latest_blog_sidebar'	=> false,
		'latest_blog_title'		=> esc_html__( 'Latest Blogs', 'blogjr' ),
		'blog_column_type'		=> 'column-zigzag',
		'blog_layout'			=> 'left-align',

		// Footer
		'slide_to_top'			=> true,
		'copyright_text'		=> esc_html__( 'Copyright &copy; 2020 | All Rights Reserved.', 'blogjr' ),

		// blog / archive
		'excerpt_count'			=> 20,
		'pagination_type'		=> 'numeric',
		'sidebar_layout'		=> 'right-sidebar',
		'archive_layout'		=> 'left-align',
		'column_type'			=> 'column-2',
		'show_date'				=> true,
		'show_category'			=> true,
		'show_author'			=> true,
		'show_read_time'		=> true,

		// single post
		'sidebar_single_layout'	=> 'right-sidebar',
		'show_single_date'		=> true,
		'show_single_category'	=> true,
		'show_single_tags'		=> true,
		'show_single_author'	=> true,

		// page
		'sidebar_page_layout'	=> 'right-sidebar',

		// global
		'enable_header_search'	=> true,
		'enable_loader'			=> false,
		'loader_type'			=> 'spinner-dots',
		'site_layout'			=> 'full',
	);

	$output = apply_filters( 'blogjr_default_theme_options', $blogjr_default_options );
	return $output;
}