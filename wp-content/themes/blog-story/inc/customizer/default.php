<?php
/**
 * Default theme options.
 *
 * @package Blog Story
 */

if ( ! function_exists( 'blog_story_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
function blog_story_get_default_theme_options() {

	$defaults = array();

	// Top Bar
	$defaults['show_header_contact_info'] 				= false;
    $defaults['show_header_social_links'] 				= false;
    $defaults['header_social_links']					= array();

    // Front Page Content
	$defaults['enable_frontpage_content'] 				= true;

	// Theme Options
	$defaults['custom_theme_color'] 					= '#000';
	$defaults['show_header_image']		    			= 'header-image-enable';
	$defaults['show_page_title']		    			= 'page-title-enable';
	$defaults['layout_options_blog']					= 'no-sidebar';
	$defaults['layout_options_archive']					= 'no-sidebar';
	$defaults['layout_options_page']					= 'no-sidebar';	
	$defaults['layout_options_single']					= 'right-sidebar';	
	$defaults['excerpt_length']							= 10;
	$defaults['your_latest_posts_title']				= esc_html__('Blog','blog-story');

	//Footer section 		
	$defaults['copyright_text']							= esc_html__( 'Copyright &copy; 2022 All rights reserved.', 'blog-story' );

	// Pass through filter.
	$defaults = apply_filters( 'blog_story_filter_default_theme_options', $defaults );
	return $defaults;
}

endif;

/**
*  Get theme options
*/
if ( ! function_exists( 'blog_story_get_option' ) ) :

	/**
	 * Get theme option
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function blog_story_get_option( $key ) {

		$default_options = blog_story_get_default_theme_options();
		if ( empty( $key ) ) {
			return;
		}

		$theme_options = (array)get_theme_mod( 'theme_options' );
		$theme_options = wp_parse_args( $theme_options, $default_options );

		$value = null;

		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}

		return $value;

	}

endif;