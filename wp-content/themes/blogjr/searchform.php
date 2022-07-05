<?php
/**
 * template for displaying search forms
 *
 * @package blogjr
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="s">
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'blogjr' ); ?></span>
	</label>
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'blogjr' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><?php echo blogjr_get_svg( array( 'icon' => 'search' ) ); ?><span class="screen-reader-text"><?php echo esc_html_x( 'Search', 'submit button', 'blogjr' ); ?></span></button>
</form>
