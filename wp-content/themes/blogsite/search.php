<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blogsite
 */

get_header(); ?>

	<div id="primary" class="content-area clear">

		<main id="main" class="site-main clear">

			<div id="recent-content" class="content-loop">

				<div class="breadcrumbs clear">
					<span class="breadcrumbs-nav">
						<a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Home', 'blogsite'); ?></a>
						<span class="post-category"><?php printf( esc_html( 'Search Results for %s', 'blogsite' ), '"' . get_search_query() . '"' ); ?></span>
					</span>							
					<h1>
						<?php printf( esc_html( 'Search Results for %s', 'blogsite' ), '"' . get_search_query() . '"' ); ?>			
					</h1>	
				</div><!-- .breadcrumbs -->
				<?php

				if ( have_posts() ) :	
							
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'search' );

					endwhile;

					else :

						get_template_part( 'template-parts/content', 'none' );

					?>

				<?php endif; ?>

			</div>

			<?php get_template_part( 'template-parts/pagination', '' ); ?>

		</main><!-- .site-main -->

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

