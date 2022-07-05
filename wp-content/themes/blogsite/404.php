<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package blogsite
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" >

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( '404 Error - Page Not Found', 'blogsite' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'Sorry, but it looks like nothing was found at this location. You may try one of the links below or do a search.', 'blogsite' ); ?></p>

					<p>
					<?php
						get_search_form(); 
					?>
					</p>

					<?php
						the_widget( 'WP_Widget_Recent_Posts' );
					?>

					<?php
						/* translators: %1$s: smiley */
						$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'blogsite' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
						echo '<p></p>';
						the_widget( 'WP_Widget_Tag_Cloud' );
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
