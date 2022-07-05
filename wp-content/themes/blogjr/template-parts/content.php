<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blogjr
 */

$class = 'grid-item';
$class .= has_post_thumbnail() ? '' : ' no-post-thumbnail';
$read_more = blogjr_theme_option( 'read_more_text', esc_html__( 'View Details', 'blogjr' ) );
$column = blogjr_theme_option( 'blog_column_type','column-3' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
	<div class="post-wrapper">
		<?php if ( has_post_thumbnail() ) : ?>
            <div class="featured-image">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'large', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
                </a>
            </div><!-- .recent-image -->
        <?php endif; ?>
        <div class="entry-container">
			<header class="entry-header">
				<?php if ( 'post' === get_post_type() ) : ?>
					<?php blogjr_article_category(); ?>
				<?php
				endif;

				if ( is_singular() ) : ?>
					<h1 class="entry-title"><?php echo blogjr_title_allow_span( get_the_title() ); ?></h1>
				<?php else : ?>
					<h2 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php echo blogjr_title_allow_span( get_the_title() ); ?></a></h2>
				<?php endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
					the_excerpt();

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blogjr' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

			<div class="entry-footer">
                <?php 
                	blogjr_posted_on();
                	
                	if ( blogjr_theme_option( 'show_read_time' ) ) {
                		blogjr_read_time( get_the_content() ); 
                	}
                ?>
            </div><!-- .entry-meta -->

			
		</div><!-- .entry-container -->
	</div><!-- .post-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->
