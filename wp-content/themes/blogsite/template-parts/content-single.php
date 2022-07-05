<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blogsite
 */	
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="breadcrumbs">
		<span class="breadcrumbs-nav">
			<a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Home', 'blogsite'); ?></a>
			<span class="post-category"><?php blogsite_first_category(); ?></span>
			<span class="post-title"><?php the_title(); ?></span>
		</span>
	</div>

	<header class="entry-header">	

		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>

		<?php get_template_part( 'template-parts/entry-meta', 'single' ); ?>

		<?php
		endif; ?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php

			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'blogsite' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blogsite' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<div class="entry-tags">

		<?php if (has_tag()) { ?><span class="tag-links"><?php the_tags(' ', ' '); ?></span><?php } ?>
			
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'blogsite' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</div><!-- .entry-tags -->

</article><!-- #post-## -->

<div class="entry-footer">

	<div class="share-icons">
		
		<?php get_template_part('template-parts/entry', 'share'); ?>

	</div><!-- .share-icons -->

</div><!-- .entry-footer -->

<div class="author-box clear">
	<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 120 ); ?></a>
	<div class="author-meta">	
		<div class="author-name">
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><?php the_author_meta('display_name'); ?></a>
		</div>	
		<div class="author-desc">
			<?php echo esc_html( the_author_meta('description') ); ?>
		</div>
	</div>
</div><!-- .author-box -->

<?php	 
	// Get the taxonomy terms of the current page for the specified taxonomy.
	$terms = wp_get_post_terms( get_the_ID(), 'category', array( 'fields' => 'ids' ) );

	// Bail if the term empty.
	if ( empty( $terms ) ) {
		return;
	}

	// Posts query arguments.
	$query = array(
		'post__not_in' => array( get_the_ID() ),
		'tax_query'    => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'id',
				'terms'    => $terms,
				'operator' => 'IN'
			)
		),
		'posts_per_page' => 6,
		'post_type'      => 'post',
	);

	// Allow dev to filter the query.
	$args = apply_filters( 'blogsite_related_posts_args', $query );

	// The post query
	$blogsite_related = new WP_Query( $args );

	if ( $blogsite_related->have_posts() ) : $i = 1; ?>

		<div class="entry-related clear">
			<h3><?php esc_html_e('Related Posts', 'blogsite'); ?></h3>
			<div class="content-loop clear">
				<?php while ( $blogsite_related->have_posts() ) : $blogsite_related->the_post(); ?>
					<?php
					$class = ( 0 == $i % 3 ) ? 'hentry last' : 'hentry';

					get_template_part('template-parts/content', 'loop');

					?>

				<?php $i++; endwhile; ?>
			</div><!-- .related-posts -->
		</div><!-- .entry-related -->

	<?php endif;

	// Restore original Post Data.
	wp_reset_postdata();
?>