<?php
/**
 * demo import
 *
 * @package blogjr
 */

/**
 * Imports predefine demos.
 * @return [type] [description]
 */
function blogjr_intro_text( $default_text ) {
    $default_text .= sprintf( '<p class="about-description">%1$s <a href="%2$s">%3$s</a></p>', esc_html__( 'Get demo content files for BlogJr Theme.', 'blogjr' ),
    esc_url( 'https://sharkthemes.com/downloads/blogjr' ), esc_html__( 'Click Here', 'blogjr' ) );

    return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'blogjr_intro_text' );
