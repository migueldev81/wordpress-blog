<?php
/**
 * Blog Story Theme Customizer
 *
 * @package Blog Story
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blog_story_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Load customize sanitize.
	include get_template_directory() . '/inc/customizer/sanitize.php';

	// Load customize sanitize.
	include get_template_directory() . '/inc/customizer/active-callback.php';

	// Load topbar sections option.
	include get_template_directory() . '/inc/customizer/topbar.php';

	// Load header sections option.
	include get_template_directory() . '/inc/customizer/theme-section.php';
	
}
add_action( 'customize_register', 'blog_story_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blog_story_customize_preview_js() {
	wp_enqueue_script( 'blog_story_customizer', get_template_directory_uri() . '/inc/customizer/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'blog_story_customize_preview_js' );
/**
 *
 */
function blog_story_customize_backend_scripts() {

	wp_enqueue_style( 'blog-story-fontawesome-all', get_template_directory_uri() . '/assets/css/all.css' );

	wp_enqueue_style( 'blog-story-admin-customizer-style', get_template_directory_uri() . '/inc/customizer/css/customizer-style.css' );

	wp_enqueue_script( 'blog-story-admin-customizer', get_template_directory_uri() . '/inc/customizer/js/customizer-script.js', array( 'jquery', 'customize-controls' ), '20151215', true );
}
add_action( 'customize_controls_enqueue_scripts', 'blog_story_customize_backend_scripts', 10 );

if ( ! function_exists( 'blog_story_inline_css' ) ) :
	// Add Custom Css
	function blog_story_inline_css() {
		
		$custom_theme_color = blog_story_get_option('custom_theme_color' );

		$custom_theme_color_css = '';
		if ( ( '#cfac9f' == $custom_theme_color ) ) {
			$custom_theme_color = '';
		}

		$custom_theme_color_css = '

		button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"],
		.menu-toggle:hover,
		.menu-toggle:focus,
		.pagination .page-numbers.current,
		.pagination .page-numbers:hover,
		.pagination .page-numbers:focus,
		.tags-links a,
		.reply a,
		.btn,
		.slick-prev,
		.slick-next,
		.slick-dots li button:hover,
		.slick-dots li.slick-active button,
		.widget_tag_cloud .tagcloud a,
		#colophon .widget_search form.search-form button.search-submit,
		.backtotop {
		    background-color: '.esc_attr( $custom_theme_color ).';
		}

		.logged-in-as a:hover,
		.logged-in-as a:focus,
		a,
		.main-navigation ul.nav-menu > li:hover > a,
		.main-navigation ul.nav-menu > li.focus > a,
		.main-navigation ul.nav-menu .current_page_item > a,
		.main-navigation ul.nav-menu .current-menu-item > a,
		.main-navigation ul.nav-menu .current_page_ancestor > a,
		.main-navigation ul.nav-menu .current-menu-ancestor > a,
		.post-navigation a:hover, 
		.posts-navigation a:hover,
		.post-navigation a:focus, 
		.posts-navigation a:focus,
		.pagination .page-numbers,
		.pagination .page-numbers.dots:hover,
		.pagination .page-numbers.dots:focus,
		.pagination .page-numbers.prev,
		.pagination .page-numbers.next,
		#secondary a:hover,
		#secondary a:focus,
		#secondary ul li a:hover,
		#secondary ul li a:focus,
		.page-header small,
		.post-categories a,
		.cat-links:before,
		.entry-meta a:hover,
		.entry-meta a:focus,
		.comment-meta .url:hover,
		.comment-meta .url:focus,
		.comment-metadata a:hover,
		.comment-metadata a:focus,
		.comment-metadata a:hover time,
		.comment-metadata a:focus time,
		.entry-title a:hover,
		.entry-title a:focus,
		#colophon a:hover,
		#colophon a:focus {
		    color: '.esc_attr( $custom_theme_color ).';
		}

		button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"],
		.widget_search form.search-form input[type="search"]:focus,
		.tags-links a,
		.reply a,
		.btn {
		    border-color: '.esc_attr( $custom_theme_color ).';
		}

		@media screen and (min-width: 1024px) {
			.main-navigation ul.nav-menu .current_page_item > a, 
		    .main-navigation ul.nav-menu .current-menu-item > a, 
		    .main-navigation ul.nav-menu .current_page_ancestor > a, 
		    .main-navigation ul.nav-menu .current-menu-ancestor > a,
		    .main-navigation ul.nav-menu > li:hover > a, 
		    .main-navigation ul.nav-menu > li.focus > a {
		        color: '.esc_attr( $custom_theme_color ).';
		    }

		    .main-navigation ul ul li:hover > a,
    		.main-navigation ul ul li.focus > a {
		        background-color: '.esc_attr( $custom_theme_color ).';
		    }
		}
		';
			
		$css = $custom_theme_color_css;	
		wp_add_inline_style( 'blog-story-style', $css );
	}
endif;
add_action( 'wp_enqueue_scripts', 'blog_story_inline_css', 10 );