<?php
/**
 * Theme functions and definitions
 *
 * @package blogjr_dark
 */ 


if ( ! function_exists( 'blogjr_dark_enqueue_styles' ) ) :
	/**
	 * Load assets.
	 *
	 * @since 1.0.0
	 */
	function blogjr_dark_enqueue_styles() {
		wp_enqueue_style( 'blogjr-style-parent', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'blogjr-dark-style', get_stylesheet_directory_uri() . '/style.css', array( 'blogjr-style-parent' ), '1.0.0' );
	}
endif;
add_action( 'wp_enqueue_scripts', 'blogjr_dark_enqueue_styles', 99 );

function blogjr_dark_setup() {
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'social' 	=> esc_html__( 'Social Menu', 'blogjr' ),
	) );
}
add_action( 'after_setup_theme', 'blogjr_dark_setup' );

function blogjr_dark_remove_action() {
	add_action( 'customize_register', 'blogjr_dark_remove_control' );
	add_action( 'customize_register', 'blogjr_dark_add_control' );
}
add_action( 'init', 'blogjr_dark_remove_action');

function blogjr_dark_remove_control( $wp_customize ) {
    $wp_customize->remove_control('blogjr_theme_options[blog_column_type]');
}

function blogjr_dark_add_control( $wp_customize ) {

	// header social menu setting and control.
	$wp_customize->add_setting( 'blogjr_theme_options[enable_header_social_menu]', array(
		'default'           => blogjr_theme_option( 'enable_header_social_menu' ),
		'sanitize_callback' => 'blogjr_sanitize_switch',
	) );

	$wp_customize->add_control( new BlogJr_Switch_Control( $wp_customize, 'blogjr_theme_options[enable_header_social_menu]', array(
		'label'             => esc_html__( 'Enable Social Menu in Header', 'blogjr-dark' ),
		'section'           => 'blogjr_header_section',
		'on_off_label' 		=> blogjr_show_options(),
	) ) );

	$wp_customize->add_control( 'blogjr_theme_options[blog_layout]', array(
		'label'             => esc_html__( 'Layout', 'blogjr-dark' ),
		'section'           => 'blogjr_latest_blog_section',
		'type'				=> 'radio',
		'choices'			=> array( 
			'left-align' 		=> esc_html__( 'Left Align', 'blogjr-dark' ),
			'center-align' 		=> esc_html__( 'Center Align', 'blogjr-dark' ),
			'image-focus-dark' 		=> esc_html__( 'Image Focus Dark', 'blogjr-dark' ),
		),
	) );

	$wp_customize->add_control( 'blogjr_theme_options[blog_column_type]', array(
		'label'             => esc_html__( 'Column', 'blogjr-dark' ),
		'section'           => 'blogjr_latest_blog_section',
		'type'				=> 'radio',
		'choices'			=> array( 
			'column-3' 		=> esc_html__( 'Three Column', 'blogjr-dark' ),
			'column-4' 		=> esc_html__( 'Four Column', 'blogjr-dark' ),
		),
	) );

}

if ( ! function_exists( 'blogjr_dark_theme_defaults' ) ) :
    /**
     * Customize theme defaults.
     *
     * @since 1.0.0
     *
     * @param array $defaults Theme defaults.
     * @param array Custom theme defaults.
     */
    function blogjr_dark_theme_defaults( $defaults ) {
        $defaults['enable_header_social_menu'] = false;
        $defaults['header_alignment'] = 'center-align';
        $defaults['enable_slider'] = false;
        $defaults['slider_width'] = 'container-width';
        $defaults['slider_layout'] = 'center-align';
        $defaults['blog_layout'] = 'image-focus-dark';
        $defaults['blog_column_type'] = 'column-3';
        $defaults['show_read_time'] = false;

        return $defaults;
    }
endif;
add_filter( 'blogjr_default_theme_options', 'blogjr_dark_theme_defaults', 99 );

if ( ! function_exists( 'blogjr_primary_nav' ) ) :
	/**
	 * Primary nav codes
	 *
	 * @since BlogJr 1.0.0
	 */
	function blogjr_primary_nav() { ?>
		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <span class="screen-reader-text"><?php esc_html_e( 'Menu', 'blogjr' ); ?></span>
                <svg viewBox="0 0 40 40" class="icon-menu">
                    <g>
                        <rect y="7" width="40" height="2"/>
                        <rect y="19" width="40" height="2"/>
                        <rect y="31" width="40" height="2"/>
                    </g>
                </svg>
                <?php echo blogjr_get_svg( array( 'icon' => 'close' ) ); ?>
            </button>
			<?php
				$search = '';

				if ( blogjr_theme_option( 'enable_header_social_menu' ) && has_nav_menu( 'social' ) ) :
					$search .= '<li class="social-menu">';
					$search .= wp_nav_menu( array(
		            		'theme_location'  	=> 'social',
		            		'container' 		=> false,
		            		'menu_id' 			=> 'social-icons',
	        				'menu_class' 		=> 'menu',
		            		'depth'           	=> 1,
		            		'echo' 				=> false,
		        			'link_before' 		=> '<span class="screen-reader-text">',
							'link_after' 		=> '</span>',
		            	) );
					$search .= '</li>';
				endif;

				if ( blogjr_theme_option( 'enable_header_search' ) ) :
					$search .= '<li class="search-form"><a href="#" class="search">';
					$search .= blogjr_get_svg( array( 'icon' => 'search' ) );
					$search .= '</a><div id="search">';
					$search .= get_search_form( $echo = false ); 
					$search .= '</div></li>';
				endif;
	             	                	
				wp_nav_menu( array(
					'theme_location' => 'primary',
        			'container' => 'div',
        			'container_class' => 'wrapper',
        			'menu_class' => 'menu nav-menu',
        			'menu_id' => 'primary-menu',
        			'fallback_cb' => 'blogjr_menu_fallback_cb',
        			'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s' . $search . '</ul>',
				) );
			?>
		</nav><!-- #site-navigation -->
	<?php }
endif;
