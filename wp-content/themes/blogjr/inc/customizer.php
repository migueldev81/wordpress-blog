<?php
/**
 * BlogJr Theme Customizer
 *
 * @package blogjr
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blogjr_customize_register( $wp_customize ) {
	// Load custom control functions.
	require get_template_directory() . '/inc/customizer/controls.php';

	// Load callback functions.
	require get_template_directory() . '/inc/customizer/callbacks.php';

	// Load validation functions.
	require get_template_directory() . '/inc/customizer/validate.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'blogjr_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'blogjr_customize_partial_blogdescription',
		) );
	}

	// Register custom section types.
	$wp_customize->register_section_type( 'BlogJr_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new BlogJr_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'BlogJr Pro', 'blogjr' ),
				'pro_text' => esc_html__( 'Buy Pro', 'blogjr' ),
				'pro_url'  => 'http://www.sharkthemes.com/downloads/blogjr-pro/',
				'priority'  => 10,
			)
		)
	);

	// Add panel for common Home Page Settings
	$wp_customize->add_panel( 'blogjr_homepage_sections_panel' , array(
	    'title'      => esc_html__( 'Homepage Sections','blogjr' ),
	    'description'=> esc_html__( 'BlogJr Homepage Sections Option.', 'blogjr' ),
	    'priority'   => 100,
	) );

	// slider settings
	require get_template_directory() . '/inc/customizer/homepage-sections/slider-customizer.php';

	// hero content settings
	require get_template_directory() . '/inc/customizer/homepage-sections/hero-content-customizer.php';

	// popular settings
	require get_template_directory() . '/inc/customizer/homepage-sections/popular-customizer.php';

	// cta settings
	require get_template_directory() . '/inc/customizer/homepage-sections/cta-customizer.php';

	// latest blog settings
	require get_template_directory() . '/inc/customizer/homepage-sections/latest-blog-customizer.php';

	// Add panel for common Home Page Settings
	$wp_customize->add_panel( 'blogjr_theme_options_panel' , array(
	    'title'      => esc_html__( 'Theme Options','blogjr' ),
	    'description'=> esc_html__( 'BlogJr Theme Options.', 'blogjr' ),
	    'priority'   => 100,
	) );

	// header settings
	require get_template_directory() . '/inc/customizer/header-customizer.php';

	// footer settings
	require get_template_directory() . '/inc/customizer/footer-customizer.php';
	
	// blog/archive settings
	require get_template_directory() . '/inc/customizer/blog-customizer.php';

	// single settings
	require get_template_directory() . '/inc/customizer/single-customizer.php';

	// page settings
	require get_template_directory() . '/inc/customizer/page-customizer.php';

	// global settings
	require get_template_directory() . '/inc/customizer/global-customizer.php';

}
add_action( 'customize_register', 'blogjr_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function blogjr_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function blogjr_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blogjr_customize_preview_js() {
	wp_enqueue_script( 'blogjr-customizer', get_template_directory_uri() . '/assets/js/customizer' . blogjr_min() . '.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'blogjr_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function blogjr_customize_control_js() {
	// Choose from select jquery.
	wp_enqueue_style( 'jquery-chosen', get_template_directory_uri() . '/assets/css/chosen' . blogjr_min() . '.css' );
	wp_enqueue_script( 'jquery-chosen', get_template_directory_uri() . '/assets/js/chosen' . blogjr_min() . '.js', array( 'jquery' ), '1.4.2', true );

	wp_enqueue_style( 'blogjr-customizer-style', get_template_directory_uri() . '/assets/css/customizer' . blogjr_min() . '.css' );
	wp_enqueue_script( 'blogjr-customizer-controls', get_template_directory_uri() . '/assets/js/customizer-controls' . blogjr_min() . '.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'blogjr_customize_control_js' );
