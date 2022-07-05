<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blogjr
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="page-header">
		<?php blogjr_article_category(); ?>
		<h1 class="page-title"><?php echo blogjr_title_allow_span( get_the_title() ); ?></h1>
	</header><!-- .entry-header -->
	
    <div class="entry-container">
    	<div class="entry-meta">
			<?php blogjr_posted_on(); ?>
		</div><!-- .entry-meta -->
		
		<div class="entry-content">
			<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blogjr' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<div class="entry-meta">
            <?php blogjr_entry_footer(); ?>
        </div><!-- .entry-meta -->
	</div><!-- .entry-container -->
</article><!-- #post-<?php the_ID(); ?> -->
