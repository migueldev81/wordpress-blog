<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blogjr
 */

get_header(); 

$filter = blogjr_theme_option( 'filter_blog_posts', 'both' );
$blog_layout = blogjr_theme_option( 'blog_layout', 'left-align' );
$cat_filter = blogjr_theme_option( 'blog_filter_category', array() );
$tag_filter = blogjr_theme_option( 'blog_filter_tag', array() );
$latest_blog_title = blogjr_theme_option( 'latest_blog_title', '' );
$column = blogjr_theme_option( 'blog_column_type','column-3' );
if ( 'column-zigzag' == $column ) :
	$column = 'column-1 zigzag';
elseif ( 'column-horizontal' == $column ) :
	$column = 'column-1 horizontal';
endif;

if ( blogjr_check_latest_blog_page_condition() ) : ?>

	<div class="wrapper page-section latest-blog">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<header class="page-header">
					<?php if ( is_home() && is_front_page() ) : 
						if ( ! empty( $latest_blog_title ) ) : ?>
							<h1 class="page-title"><?php echo esc_html( $latest_blog_title ); ?></h1>
						<?php endif;
					else: ?>
						<h1 class="page-title"><?php single_post_title( '', true ); ?></h1>
					<?php endif; ?>
				</header><!-- .page-header -->

				<div class="blog-posts-wrapper grid <?php echo esc_attr( $blog_layout ); ?> <?php echo esc_attr( $column ); ?>">
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
endif;

get_footer();
