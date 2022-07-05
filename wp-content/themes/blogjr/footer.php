<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blogjr
 */

/**
 * blogjr_site_content_ends_action hook
 *
 * @hooked blogjr_site_content_ends -  10
 *
 */
do_action( 'blogjr_site_content_ends_action' );

/**
 * blogjr_footer_start_action hook
 *
 * @hooked blogjr_footer_start -  10
 *
 */
do_action( 'blogjr_footer_start_action' );

/**
 * blogjr_site_info_action hook
 *
 * @hooked blogjr_site_info -  10
 *
 */
do_action( 'blogjr_site_info_action' );

/**
 * blogjr_footer_ends_action hook
 *
 * @hooked blogjr_footer_ends -  10
 * @hooked blogjr_slide_to_top -  20
 *
 */
do_action( 'blogjr_footer_ends_action' );

/**
 * blogjr_page_ends_action hook
 *
 * @hooked blogjr_page_ends -  10
 *
 */
do_action( 'blogjr_page_ends_action' );

wp_footer();

/**
 * blogjr_body_html_ends_action hook
 *
 * @hooked blogjr_body_html_ends -  10
 *
 */
do_action( 'blogjr_body_html_ends_action' );
