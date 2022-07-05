<?php get_header(); ?>	

	<div id="primary" class="content-area clear">	

		<?php get_template_part('template-parts/content', 'featured'); ?>

		<main id="main" class="site-main clear">		

			<div id="recent-content" class="content-loop">

				<?php

				// Define custom query args
				$args = array( 
	  				'paged' => get_query_var('paged')
				);  

				$wp_query = new WP_Query($args);	

				if ( $wp_query->have_posts() ) :	
				
				/* Start the Loop */
				while ( $wp_query->have_posts() ) : $wp_query->the_post();

					get_template_part('template-parts/content', 'loop');

				endwhile;

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; 

				?>

			</div><!-- #recent-content -->		

			<?php get_template_part( 'template-parts/pagination', '' ); ?>

		</main><!-- .site-main -->

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
