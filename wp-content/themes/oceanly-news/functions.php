<?php
/**
 * This is the child theme for Oceanly theme.
 *
 * (See https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 *
 * @package Oceanly_News
 */

defined( 'ABSPATH' ) || die();

define( 'OCEANLY_NEWS_VERSION', '1.0.6' );

/**
 * Set child theme services.
 *
 * @param  array $services Parent theme services.
 * @return array
 */
function oceanly_news_services( $services ) {
	require get_stylesheet_directory() . '/inc/classes/class-oceanly-news-enqueue.php';
	require get_stylesheet_directory() . '/inc/classes/class-oceanly-news-select-multiple.php';
	require get_stylesheet_directory() . '/inc/classes/class-oceanly-news-featured-posts.php';
	require get_stylesheet_directory() . '/inc/classes/class-oceanly-news-related-posts.php';
	require get_stylesheet_directory() . '/inc/classes/class-oceanly-news-upsell.php';

	array_push( $services, Oceanly_News_Enqueue::class );
	array_push( $services, Oceanly_News_Featured_Posts::class );
	array_push( $services, Oceanly_News_Related_Posts::class );
	array_push( $services, Oceanly_News_Upsell::class );

	return $services;
}
add_filter( 'oceanly_services', 'oceanly_news_services' );

/**
 * Load child theme text domain and remove welcome hooks of parent theme.
 */
function oceanly_news_setup() {
	load_child_theme_textdomain( 'oceanly-news', get_stylesheet_directory() . '/languages' );

	remove_action( 'admin_menu', 'oceanly_create_menu' );
	remove_action( 'admin_notices', 'oceanly_welcome_notice' );
}
add_action( 'after_setup_theme', 'oceanly_news_setup', 11 );

/**
 * Welcome page.
 */
require get_stylesheet_directory() . '/inc/welcome-page.php';

/**
 * Recommended plugins.
 */
require get_stylesheet_directory() . '/inc/recommended-plugins.php';
