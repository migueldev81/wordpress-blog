<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package blogjr
 */

get_header(); 
$column = blogjr_theme_option( 'column_type' );
$header_alignment = blogjr_theme_option( 'header_alignment', 'left-align' );
if ( has_header_image() && 'center-align' !== $header_alignment ) : ?>
	<div class="featured-image inner-header-image">
		<?php the_header_image_tag(); ?>
	</div>
<?php endif; ?>

<div class="wrapper page-section">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<header class="page-header">
				<h1 class="page-title"><?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'blogjr' ), '<span>' . get_search_query() . '</span>' );
				?></h1>
			</header><!-- .page-header -->
			<div class="blog-posts-wrapper grid <?php echo esc_attr( $column ) ?>">
				<?php
				if ( have_posts() ) : 

					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>
			</div><!-- #blog-posts-wrapper -->
			<?php  
			/**
			* Hook - blogjr_pagination_action.
			*
			* @hooked blogjr_pagination 
			*/
			do_action( 'blogjr_pagination_action' ); 
			?>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrapper -->
<?php
get_footer();
