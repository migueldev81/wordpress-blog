<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blog Story
 */
/**
* Hook - blog_story_action_doctype.
*
* @hooked blog_story_doctype -  10
*/
do_action( 'blog_story_action_doctype' );
?>
<head>
<?php
/**
* Hook - blog_story_action_head.
*
* @hooked blog_story_head -  10
*/
do_action( 'blog_story_action_head' );
?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>

<?php

/**
* Hook - blog_story_action_before.
*
* @hooked blog_story_page_start - 10
*/
do_action( 'blog_story_action_before' );

/**
*
* @hooked blog_story_header_start - 10
*/
do_action( 'blog_story_action_before_header' );

/**
*
*@hooked blog_story_site_branding - 10
*@hooked blog_story_header_end - 15 
*/
do_action('blog_story_action_header');

/**
*
* @hooked blog_story_content_start - 10
*/
do_action( 'blog_story_action_before_content' );

/**
 * Banner start
 * 
 * @hooked blog_story_banner_header - 10
*/
do_action( 'blog_story_banner_header' );  
