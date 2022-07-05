<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Enqueue service.
 *
 * @package Oceanly_News
 */

/**
 * Enqueue theme styles and scripts.
 */
class Oceanly_News_Enqueue implements Oceanly\Serviceable {
	/**
	 * Register service features.
	 */
	public function register() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_filter( 'oceanly_fonts_url', array( $this, 'fonts_url' ) );
	}

	/**
	 * Enqueue styles and scripts.
	 */
	public function enqueue_scripts() {
		// Child theme stylesheet.
		wp_enqueue_style( 'oceanly-news-style', get_stylesheet_directory_uri() . '/style.min.css', array(), OCEANLY_NEWS_VERSION );
		wp_style_add_data( 'oceanly-news-style', 'rtl', 'replace' );
	}

	/**
	 * Register Google fonts.
	 */
	public function fonts_url() {
		$fonts_url = apply_filters( 'oceanly_news_fonts_url', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Source+Serif+Pro:ital,wght@0,400;0,600;1,400;1,600&display=swap' );

		return esc_url_raw( $fonts_url );
	}
}
