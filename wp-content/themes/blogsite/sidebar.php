<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blogsite
 */


?>

<aside id="secondary" class="widget-area sidebar">

	<?php if ( is_home() && is_active_sidebar( 'home-sidebar' ) ) { ?>

		<?php dynamic_sidebar( 'home-sidebar' ); ?>

	<?php } else { ?>

	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	
	<?php } ?>

</aside><!-- #secondary -->

