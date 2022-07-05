<?php
/**
 * Options functions
 *
 * @package blogjr
 */

if ( ! function_exists( 'blogjr_show_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function blogjr_show_options() {
        $arr = array(
            'on'        => esc_html__( 'Yes', 'blogjr' ),
            'off'       => esc_html__( 'No', 'blogjr' )
        );
        return apply_filters( 'blogjr_show_options', $arr );
    }
endif;

if ( ! function_exists( 'blogjr_page_choices' ) ) :
    /**
     * List of pages for page choices.
     * @return Array Array of page ids and name.
     */
    function blogjr_page_choices() {
        $pages = get_pages();
        $choices = array();
        $choices[0] = esc_html__( 'None', 'blogjr' );
        foreach ( $pages as $page ) {
            $choices[ $page->ID ] = $page->post_title;
        }
        return $choices;
    }
endif;

if ( ! function_exists( 'blogjr_post_choices' ) ) :
    /**
     * List of posts for post choices.
     * @return Array Array of post ids and name.
     */
    function blogjr_post_choices() {
        $posts = get_posts( array( 'numberposts' => -1 ) );
        $choices = array();
        $choices[0] = esc_html__( 'None', 'blogjr' );
        foreach ( $posts as $post ) {
            $choices[ $post->ID ] = $post->post_title;
        }
        return $choices;
    }
endif;

if ( ! function_exists( 'blogjr_category_choices' ) ) :
    /**
     * List of categories for category choices.
     * @return Array Array of category ids and name.
     */
    function blogjr_category_choices() {
        $args = array(
                'type'          => 'post',
                'child_of'      => 0,
                'parent'        => '',
                'orderby'       => 'name',
                'order'         => 'ASC',
                'hide_empty'    => true,
                'hierarchical'  => 0,
                'taxonomy'      => 'category',
            );
        $categories = get_categories( $args );
        $choices = array();
        $choices[0] = esc_html__( 'None', 'blogjr' );
        foreach ( $categories as $category ) {
            $choices[ $category->term_id ] = $category->name;
        }
        return $choices;
    }
endif;

if ( ! function_exists( 'blogjr_tag_choices' ) ) :
    /**
     * List of tags for category choices.
     * @return Array Array of tag ids and name.
     */
    function blogjr_tag_choices() {
        $args = array(
                'taxonomy' => 'post_tag',
                'hide_empty' => true,
            );
        $tags = get_terms( $args );
        $choices = array();
        $choices[0] = esc_html__( 'None', 'blogjr' );
        foreach ( $tags as $category ) {
            $choices[ $category->term_id ] = $category->name;
        }
        return $choices;
    }
endif;

if ( ! function_exists( 'blogjr_site_layout' ) ) :
    /**
     * site layout
     * @return array site layout
     */
    function blogjr_site_layout() {
        $blogjr_site_layout = array(
            'full'    => esc_url( get_template_directory_uri() ) . '/assets/uploads/full.png',
            'boxed'   => esc_url( get_template_directory_uri() ) . '/assets/uploads/boxed.png',
        );

        $output = apply_filters( 'blogjr_site_layout', $blogjr_site_layout );

        return $output;
    }
endif;

if ( ! function_exists( 'blogjr_sidebar_position' ) ) :
    /**
     * Sidebar position
     * @return array Sidebar position
     */
    function blogjr_sidebar_position() {
        $blogjr_sidebar_position = array(
            'right-sidebar' => esc_url( get_template_directory_uri() ) . '/assets/uploads/right.png',
            'no-sidebar'    => esc_url( get_template_directory_uri() ) . '/assets/uploads/full.png',
            'no-sidebar-content' => esc_url( get_template_directory_uri() ) . '/assets/uploads/boxed.png',
        );

        $output = apply_filters( 'blogjr_sidebar_position', $blogjr_sidebar_position );

        return $output;
    }
endif;

if ( ! function_exists( 'blogjr_get_spinner_list' ) ) :
    /**
     * List of spinner icons options.
     * @return array List of all spinner icon options.
     */
    function blogjr_get_spinner_list() {
        $arr = array(
            'spinner-two-way'       => esc_html__( 'Two Way', 'blogjr' ),
            'spinner-umbrella'      => esc_html__( 'Umbrella', 'blogjr' ),
            'spinner-dots'          => esc_html__( 'Dots', 'blogjr' ),
            'spinner-one-way'       => esc_html__( 'One Way', 'blogjr' ),
        );
        return apply_filters( 'blogjr_spinner_list', $arr );
    }
endif;

if ( ! function_exists( 'blogjr_selected_sidebar' ) ) :
    /**
     * Sidebars options
     * @return array Sidbar positions
     */
    function blogjr_selected_sidebar() {
        $blogjr_selected_sidebar = array(
            'sidebar-1'             => esc_html__( 'Default Sidebar', 'blogjr' ),
            'optional-sidebar'      => esc_html__( 'Optional Sidebar', 'blogjr' ),
        );

        $output = apply_filters( 'blogjr_selected_sidebar', $blogjr_selected_sidebar );

        return $output;
    }
endif;
