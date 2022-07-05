<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package blogjr
 */

if ( ! function_exists( 'blogjr_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function blogjr_posted_on() {
		if ( blogjr_meta_option( 'show_date', 'show_single_date' ) ) :
			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}

			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);
			$year = get_the_date( 'Y' );
			$month = get_the_date( 'm' );
			$link = ( is_single() ) ? get_month_link( $year, $month ) : get_permalink();

			$posted_on = '<a href="' . esc_url( $link ) . '" rel="bookmark">' . $time_string . '</a>';

			printf( '<span class="posted-on">%1$s</span>', $posted_on );
		endif;

		if ( blogjr_meta_option( 'show_author', 'show_single_author' ) ) :
			$byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">'  . esc_html( get_the_author() ) . '</a></span>';
			printf( '<span class="byline">%1$s %2$s</span>', esc_html__( 'By', 'blogjr' ), $byline );
		endif;
	}
endif;

if ( ! function_exists( 'blogjr_article_category' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function blogjr_article_category() {
		if ( 'post' === get_post_type() ) {
			if ( blogjr_meta_option( 'show_category', 'show_single_category' ) ) :
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( esc_html__( ', ', 'blogjr' ) );
				if ( $categories_list ) {
					/* translators: 1: list of categories. */
					printf( '<span class="cat-links">' . '%1$s' . '</span>', $categories_list ); // WPCS: XSS OK.
				}
			endif;
		}
	}
endif;

if ( ! function_exists( 'blogjr_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function blogjr_entry_footer() {

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			if ( is_single() && blogjr_meta_option( '', 'show_single_tags' ) ) :
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list();
				if ( $tags_list ) {
					/* translators: 1: list of tags. */
					printf( '<span class="tags-links">' . '%1$s' . '</span>', $tags_list ); // WPCS: XSS OK.
				}
			endif;
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'blogjr' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'blogjr_read_time' ) ) :
	/**
	 * Display read time for post
	 */
	function blogjr_read_time( $content = '' ) {

		if ( empty( $content ) )
			return;

		$words = str_word_count( strip_tags( $content ) );
		$m = ceil( $words / 200 );
		$est = $m . esc_html__( ' min', 'blogjr' ) . ( $m == 1 ? '' : esc_html__( 's', 'blogjr' ) );

		printf( '<span class="read-time">%1$s %2$s</span>', $est, esc_html__( ' read', 'blogjr' ) );
	}
endif;

/**
 * Checks to see if meta option is enabled in archive/blog and single
 */
function blogjr_meta_option( $blog_option = '', $single_option = '' ) {
	if ( is_archive() || is_search() || is_home() ) :
		if ( blogjr_theme_option( $blog_option ) )
			return true;
		else
			return false;
	elseif ( is_single() ) :
		if ( blogjr_theme_option( $single_option ) )
			return true;
		else
			return false;
	else :
		return true;
	endif;
}