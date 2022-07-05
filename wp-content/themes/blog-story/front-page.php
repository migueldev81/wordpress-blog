<?php
/**
 * The template for displaying home page.
 * @package Blog Story
 */

if ( 'posts' != get_option( 'show_on_front' ) ) { 
    get_header(); ?>
    <?php 
    if( true == blog_story_get_option('enable_frontpage_content') ) { ?>
        <div class="wrapper section-gap">
            <?php include( get_page_template() ); ?>
        </div>
    <?php }
    get_footer();
} 
elseif ('posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
} 