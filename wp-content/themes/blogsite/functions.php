<?php
/**
 * blogsite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package blogsite
 */

if ( ! function_exists( 'blogsite_setup' ) ) :

function blogsite_setup() {

	load_theme_textdomain( 'blogsite', get_template_directory() . '/languages' );

	add_theme_support( "wp-block-styles" );
	add_theme_support( "responsive-embeds" );
	add_theme_support( "align-wide" );
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Add theme support for Custom Logo.
	// Custom logo.
	$logo_width  = 300;
	$logo_height = 70;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	$args = array(
		'height'      => $logo_height,
		'width'       => $logo_width,
		'flex-height' => true,
		'flex-width'  => true,
	);

	add_theme_support('custom-logo', $args);
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'blogsite' ),
		'footer' => esc_html__( 'Footer Menu', 'blogsite' ),	
		'mobile' => esc_html__( 'Mobile Menu', 'blogsite' ),			
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'blogsite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

    add_editor_style( array( 'assets/css/editor-style.css', '' ) ); 
}
endif;
add_action( 'after_setup_theme', 'blogsite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
// Set content-width.
global $content_width;

if ( ! isset( $content_width ) ) {
	$content_width = 790;
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blogsite_sidebar_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'blogsite' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'blogsite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Home Sidebar (optional)', 'blogsite' ),
		'id'            => 'home-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'blogsite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Columns', 'blogsite' ),
		'id'            => 'footer',
		'description'   => esc_html__( 'Add widgets here.', 'blogsite' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget footer-column %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );			

}
add_action( 'widgets_init', 'blogsite_sidebar_init' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * SVG Icons.
 */
require get_template_directory() . '/inc/classes/class-blogsite-svg-icons.php';

/**
 * Menu Walker.
 */
require get_template_directory() . '/inc/classes/class-blogsite-walker-page.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load about page.
 */
require get_template_directory() . '/inc/about.php';

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

// Block Styles.
require get_template_directory() . '/inc/block-styles.php';

/**
 * Registers custom widgets.
 */
function blogsite_widgets_init() {       
                                
    require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-recent.php';
    register_widget( 'BlogSite_Recent_Widget' );     

    require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-most-commented.php';
    register_widget( 'BlogSite_Most_Commented_Widget' );        

    require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-category-posts.php';
    register_widget( 'BlogSite_Category_Posts_Widget' );   

    require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-tabs.php';
    register_widget( 'BlogSite_Tabs_Widget' ); 
    
}

add_action( 'widgets_init', 'blogsite_widgets_init' );

/**
 * Enqueues scripts and styles.
 */
function blogsite_scripts() {

    // load jquery if it isn't

    wp_enqueue_script('jquery');

    //  Enqueues Javascripts
    wp_enqueue_script( 'blogsite-superfish', get_template_directory_uri() . '/assets/js/superfish.js', array(), '', true );
    wp_enqueue_script( 'blogsite-html5', get_template_directory_uri() . '/assets/js/html5.js', array(), '', true );
	wp_enqueue_script( 'blogsite-bxslider', get_template_directory_uri() . '/assets/js/jquery.bxslider.js', array(), '', true ); 
    wp_enqueue_script( 'tabslet', get_template_directory_uri() . '/assets/js/jquery.tabslet.js', array(), '20220617', true );	           	
	wp_enqueue_script( 'blogsite-index', get_template_directory_uri() . '/assets/js/index.js', array(), '20220617', true );
	wp_enqueue_script( 'blogsite-custom', get_template_directory_uri() . '/assets/js/jquery.custom.js', array(), '20220617', true );

    // Enqueues CSS styles
    wp_enqueue_style( 'blogsite-fontawesome-style',   get_template_directory_uri() . '/assets/css/font-awesome.css' );
    wp_enqueue_style( 'blogsite-genericons-style',   get_template_directory_uri() . '/genericons/genericons.css' );     
    wp_enqueue_style( 'blogsite-style', get_stylesheet_uri(), array(), '20220617' );     
    wp_enqueue_style( 'blogsite-responsive-style',   get_template_directory_uri() . '/responsive.css', array(), '20220617' ); 
	
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }    
}
add_action( 'wp_enqueue_scripts', 'blogsite_scripts' );

/**
 * Post Thumbnails.
 */
if ( function_exists( 'add_theme_support' ) ) { 
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 300, 300, true ); // default Post Thumbnail dimensions (cropped)
    add_image_size( 'blogsite_featured_large_thumb', 630, 359, true ); 
    add_image_size( 'blogsite_featured_small_thumb', 440, 226, true );  
    add_image_size( 'blogsite_post_thumb', 300, 300, true ); 
    add_image_size( 'blogsite_widget_thumb', 300, 150, true );     
}

// Disable WordPress 5.5+ Lazy Load
add_filter( 'wp_lazy_loading_enabled', '__return_false' );

// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );

// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );