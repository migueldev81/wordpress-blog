<?php
/**
 * Functions which construct the theme by hooking into WordPress
 *
 * @package blogjr
 */


/*------------------------------------------------
            HEADER HOOK
------------------------------------------------*/

if ( ! function_exists( 'blogjr_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since BlogJr 1.0.0
	 */
	function blogjr_doctype() { ?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php }
endif;
add_action( 'blogjr_doctype_action', 'blogjr_doctype', 10 );

if ( ! function_exists( 'blogjr_head' ) ) :
	/**
	 * head Codes
	 *
	 * @since BlogJr 1.0.0
	 */
	function blogjr_head() { ?>
		<head>
			<meta charset="<?php bloginfo( 'charset' ); ?>">
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
			<link rel="profile" href="http://gmpg.org/xfn/11">
			<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
				<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
			<?php endif; ?>
			<?php wp_head(); ?>
		</head>
	<?php }
endif;
add_action( 'blogjr_head_action', 'blogjr_head', 10 );

if ( ! function_exists( 'blogjr_body_start' ) ) :
	/**
	 * Body start codes
	 *
	 * @since BlogJr 1.0.0
	 */
	function blogjr_body_start() { ?>
		<body <?php body_class(); ?>>
		<?php do_action( 'wp_body_open' ); ?>
	<?php }
endif;
add_action( 'blogjr_body_start_action', 'blogjr_body_start', 10 );


if ( ! function_exists( 'blogjr_page_start' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since BlogJr 1.0.0
	 */
	function blogjr_page_start() { ?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'blogjr' ); ?></a>
	<?php }
endif;
add_action( 'blogjr_page_start_action', 'blogjr_page_start', 10 );


if ( ! function_exists( 'blogjr_loader' ) ) :
	/**
	 * loader html codes
	 *
	 * @since BlogJr 1.0.0
	 */
	function blogjr_loader() { 
		if ( ! blogjr_theme_option( 'enable_loader' ) )
			return;
		
		$loader = blogjr_theme_option( 'loader_type' );
		?>
		<div id="loader">
            <div class="loader-container">
               	<?php echo blogjr_get_svg( array( 'icon' => esc_attr( $loader ) ) ); ?>
            </div>
        </div><!-- #loader -->
	<?php }
endif;
add_action( 'blogjr_page_start_action', 'blogjr_loader', 20 );


if ( ! function_exists( 'blogjr_header_start' ) ) :
	/**
	 * Header starts html codes
	 *
	 * @since BlogJr 1.0.0
	 */
	function blogjr_header_start() { 
		$header_alignment = blogjr_theme_option( 'header_alignment', 'left-align' );
		$header_image = '';
		if ( has_header_image() && 'center-align' == $header_alignment ) {
			$header_image = sprintf( 'style="background-image: url(%s)"', get_header_image() );
		}
		?>
		<header id="masthead" class="site-header <?php echo esc_attr( $header_alignment ); ?>" <?php echo $header_image; ?>>
		<div class="wrapper">
	<?php }
endif;
add_action( 'blogjr_header_start_action', 'blogjr_header_start', 10 );


if ( ! function_exists( 'blogjr_site_branding' ) ) :
	/**
	 * Site branding codes
	 *
	 * @since BlogJr 1.0.0
	 */
	function blogjr_site_branding() { ?>
		<div class="site-branding pull-left">
			<?php
			// site logo
			the_custom_logo();
			?>
			<div class="site-details">
				<?php if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php endif; ?>
				</div><!-- .site-details -->
		</div><!-- .site-branding -->
	<?php }
endif;
add_action( 'blogjr_site_branding_action', 'blogjr_site_branding', 10 );


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
add_action( 'blogjr_primary_nav_action', 'blogjr_primary_nav', 10 );


if ( ! function_exists( 'blogjr_header_ends' ) ) :
	/**
	 * Header ends codes
	 *
	 * @since BlogJr 1.0.0
	 */
	function blogjr_header_ends() { ?>
		</div><!-- .wrapper -->
		</header><!-- #masthead -->
	<?php }
endif;
add_action( 'blogjr_header_ends_action', 'blogjr_header_ends', 10 );


if ( ! function_exists( 'blogjr_site_content_start' ) ) :
	/**
	 * Site content start codes
	 *
	 * @since BlogJr 1.0.0
	 */
	function blogjr_site_content_start() { ?>
		<div id="content" class="site-content">
	<?php }
endif;
add_action( 'blogjr_site_content_start_action', 'blogjr_site_content_start', 10 );


/*------------------------------------------------
            FOOTER HOOK
------------------------------------------------*/

if ( ! function_exists( 'blogjr_site_content_ends' ) ) :
	/**
	 * Site content ends codes
	 *
	 * @since BlogJr 1.0.0
	 */
	function blogjr_site_content_ends() { ?>
		</div><!-- #content -->
	<?php }
endif;
add_action( 'blogjr_site_content_ends_action', 'blogjr_site_content_ends', 10 );


if ( ! function_exists( 'blogjr_footer_start' ) ) :
	/**
	 * Footer start codes
	 *
	 * @since BlogJr 1.0.0
	 */
	function blogjr_footer_start() { ?>
		<footer id="colophon" class="site-footer">
	<?php }
endif;
add_action( 'blogjr_footer_start_action', 'blogjr_footer_start', 10 );


if ( ! function_exists( 'blogjr_site_info' ) ) :
	/**
	 * Site info codes
	 *
	 * @since BlogJr 1.0.0
	 */
	function blogjr_site_info() { 
		$copyright = blogjr_theme_option('copyright_text');
		?>
		<div class="site-info">
            <div class="wrapper column-1 ?>">
            	<?php if ( ! empty( $copyright ) ) : ?>
	                <div class="copyright">
	                	<p>
	                    	<?php 
	                    	echo blogjr_santize_allow_tags( $copyright ); 
	                    	printf( esc_html__( ' BlogJr by %1$s Shark Themes %2$s', 'blogjr' ), '<a href="' . esc_url( 'https://sharkthemes/' ) . '" target="_blank">','</a>' );
	                    	if ( function_exists( 'the_privacy_policy_link' ) ) {
								the_privacy_policy_link( ' | ' );
							}
	                    	?>
	                    </p>
	                </div><!-- .copyright -->
	            <?php endif; ?>
            </div><!-- .wrapper -->    
        </div><!-- .site-info -->
	<?php }
endif;
add_action( 'blogjr_site_info_action', 'blogjr_site_info', 10 );


if ( ! function_exists( 'blogjr_footer_ends' ) ) :
	/**
	 * Footer ends codes
	 *
	 * @since BlogJr 1.0.0
	 */
	function blogjr_footer_ends() { ?>
		</footer><!-- #colophon -->
	<?php }
endif;
add_action( 'blogjr_footer_ends_action', 'blogjr_footer_ends', 10 );


if ( ! function_exists( 'blogjr_slide_to_top' ) ) :
	/**
	 * Footer ends codes
	 *
	 * @since BlogJr 1.0.0
	 */
	function blogjr_slide_to_top() { ?>
		<div class="backtotop">
            <?php echo blogjr_get_svg( array( 'icon' => 'up' ) ); ?>
        </div><!-- .backtotop -->
	<?php }
endif;
add_action( 'blogjr_footer_ends_action', 'blogjr_slide_to_top', 20 );


if ( ! function_exists( 'blogjr_page_ends' ) ) :
	/**
	 * Page ends codes
	 *
	 * @since BlogJr 1.0.0
	 */
	function blogjr_page_ends() { ?>
		</div><!-- #page -->
	<?php }
endif;
add_action( 'blogjr_page_ends_action', 'blogjr_page_ends', 10 );


if ( ! function_exists( 'blogjr_body_html_ends' ) ) :
	/**
	 * Body & Html ends codes
	 *
	 * @since BlogJr 1.0.0
	 */
	function blogjr_body_html_ends() { ?>
		</body>
		</html>
	<?php }
endif;
add_action( 'blogjr_body_html_ends_action', 'blogjr_body_html_ends', 10 );
