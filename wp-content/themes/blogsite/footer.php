<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blogsite
 */

?>

	</div><!-- #content .site-content -->
	
	<footer id="colophon" class="site-footer">

		<?php if ( is_active_sidebar( 'footer' ) ) { ?>

			<div class="footer-columns clear">

				<div class="container clear">

					<?php dynamic_sidebar( 'footer' ); ?>

				</div><!-- .container -->

			</div><!-- .footer-columns -->

		<?php } ?>

		<div class="clear"></div>

		<div id="site-bottom" class="<?php if ( !is_active_sidebar( 'footer' ) ) { echo 'no-footer-widgets'; } ?> clear">

			<div class="container">

			<?php 
				if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu', 'menu_class' => 'footer-nav' ) );
				}
			?>	
			
			<div class="site-info">
				<?php
					$blogsite_theme = wp_get_theme();
				?>

				&copy; <?php echo esc_html( date("o") ); ?> <a href="<?php echo esc_url( home_url() ); ?>"><?php echo esc_html( get_bloginfo('name') ); ?></a> - <a target="_blank" href="<?php echo esc_url( $blogsite_theme->get( 'AuthorURI' ) ); ?>"><?php esc_html_e('WordPress Theme', 'blogsite'); ?></a> <?php esc_html_e('by', 'blogsite'); ?> <a target="_blank" href="<?php echo esc_url( $blogsite_theme->get( 'AuthorURI' ) ); ?>"><?php esc_html_e('WPEnjoy', 'blogsite'); ?></a>
			</div><!-- .site-info -->

			</div><!-- .container -->

		</div>
		<!-- #site-bottom -->
							
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php if ( get_theme_mod('back-top-on', true) ) : ?>

	<div id="back-top">
		<a href="#top" title="<?php echo esc_html('Back to top', 'blogsite'); ?>"><span class="genericon genericon-collapse"></span></a>
	</div>

<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
