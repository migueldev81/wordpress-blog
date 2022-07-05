<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blogjr
 */

/**
 * blogjr_doctype_action hook
 *
 * @hooked blogjr_doctype -  10
 *
 */
do_action( 'blogjr_doctype_action' );

/**
 * blogjr_head_action hook
 *
 * @hooked blogjr_head -  10
 *
 */
do_action( 'blogjr_head_action' );

/**
 * blogjr_body_start_action hook
 *
 * @hooked blogjr_body_start -  10
 *
 */
do_action( 'blogjr_body_start_action' );
 
/**
 * blogjr_page_start_action hook
 *
 * @hooked blogjr_page_start -  10
 * @hooked blogjr_loader -  20
 *
 */
do_action( 'blogjr_page_start_action' );

/**
 * blogjr_header_start_action hook
 *
 * @hooked blogjr_header_start -  10
 *
 */
do_action( 'blogjr_header_start_action' );

/**
 * blogjr_site_branding_action hook
 *
 * @hooked blogjr_site_branding -  10
 *
 */
do_action( 'blogjr_site_branding_action' );

/**
 * blogjr_primary_nav_action hook
 *
 * @hooked blogjr_primary_nav -  10
 *
 */
do_action( 'blogjr_primary_nav_action' );

/**
 * blogjr_header_ends_action hook
 *
 * @hooked blogjr_header_ends -  10
 *
 */
do_action( 'blogjr_header_ends_action' );

/**
 * blogjr_site_content_start_action hook
 *
 * @hooked blogjr_site_content_start -  10
 *
 */
do_action( 'blogjr_site_content_start_action' );

/**
 * blogjr_primary_content_action hook
 *
 * @hooked blogjr_add_slider_section -  10
 *
 */
do_action( 'blogjr_primary_content_action' );