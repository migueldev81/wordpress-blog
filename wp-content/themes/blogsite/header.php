<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blogsite
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="HandheldFriendly" content="true">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
	//wp_body_open hook from WordPress 5.2
	if ( function_exists( 'wp_body_open' ) ) {
	    wp_body_open();
	} else { 
	    do_action( 'wp_body_open' ); 
	}
?>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'blogsite' ); ?></a>

	<header id="masthead" class="site-header clear">

		<?php
			the_custom_header_markup();
		?>

		<div class="container">

			<div class="site-branding">

				<?php if ( has_custom_logo() ) { ?>

					<div id="logo">
						<?php the_custom_logo(); ?>
					</div><!-- #logo -->

				<?php } ?>

				<?php if (display_header_text()==true) { ?>

					<div class="site-title-desc">

						<div class="site-title <?php if (empty(get_bloginfo('description'))) { echo 'no-desc'; } ?>">
							<h1><a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo('name'); ?></a></h1>
						</div><!-- .site-title -->	

						<div class="site-description">
							<?php bloginfo('description'); ?>
						</div><!-- .site-desc -->

					</div><!-- .site-title-desc -->

				<?php } ?>

			</div><!-- .site-branding -->		

			<nav id="primary-nav" class="primary-navigation">

				<?php 
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'sf-menu', 'link_before' => '<span class="menu-text">','link_after'=>'</span>' ) );
					}
				?>

			</nav><!-- #primary-nav -->

			<div class="header-search">
				<form id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="search" name="s" class="search-input" placeholder="<?php esc_attr_e('Search', 'blogsite'); ?>" autocomplete="off">
					<button type="submit" class="search-submit"><span class="genericon genericon-search"></span></button>		
				</form>
			</div><!-- .header-search -->

			<div class="header-toggles">
				<button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
					<span class="toggle-inner">
						<span class="toggle-icon">
							<?php blogsite_the_theme_svg( 'ellipsis' ); ?>
						</span>
						<span class="toggle-text"><?php esc_html_e( 'Menu', 'blogsite' ); ?></span>
					</span>
				</button><!-- .nav-toggle -->
			</div><!-- .header-toggles -->
			
		</div><!-- .container -->

	</header><!-- #masthead -->	

	<div class="menu-modal cover-modal header-footer-group" data-modal-target-string=".menu-modal">

		<div class="menu-modal-inner modal-inner">

			<div class="menu-wrapper section-inner">

				<div class="menu-top">

					<button class="toggle close-nav-toggle fill-children-current-color" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".menu-modal">
						<span class="toggle-text"><?php esc_html_e( 'Close Menu', 'blogsite' ); ?></span>
						<?php blogsite_the_theme_svg( 'cross' ); ?>
					</button><!-- .nav-toggle -->

					<?php

					$mobile_menu_location = '';

					// If the mobile menu location is not set, use the primary location as fallbacks, in that order.
					if ( has_nav_menu( 'mobile' ) ) {
						$mobile_menu_location = 'mobile';
					} elseif ( has_nav_menu( 'primary' ) ) {
						$mobile_menu_location = 'primary';
					}

					?>

					<nav class="mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'blogsite' ); ?>" role="navigation">

						<ul class="modal-menu reset-list-style">

						<?php
						if ( $mobile_menu_location ) {

							wp_nav_menu(
								array(
									'container'      => '',
									'items_wrap'     => '%3$s',
									'show_toggles'   => true,
									'theme_location' => $mobile_menu_location,
								)
							);

						} else {

							wp_list_pages(
								array(
									'match_menu_classes' => true,
									'show_toggles'       => true,
									'title_li'           => false,
									'walker'             => new BlogSite_Walker_Page(),
								)
							);

						}
						?>

						</ul>

					</nav>

				</div><!-- .menu-top -->

			</div><!-- .menu-wrapper -->

		</div><!-- .menu-modal-inner -->

	</div><!-- .menu-modal -->	

<div class="header-space"></div>

<div id="content" class="site-content container <?php if( (!is_active_sidebar( 'home-sidebar' )) && (!is_active_sidebar( 'sidebar-1' )) ) { echo 'is_full_width'; } ?> clear">
