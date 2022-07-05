<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blogjr
 */

get_header(); 
$column = blogjr_theme_option( 'column_type', 'column-2' );
$layout = blogjr_theme_option( 'archive_layout', 'left-align' );
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
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<div class="blog-posts-wrapper grid <?php echo esc_attr( $column ) . ' ' . esc_attr( $layout ); ?>">
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
