<?php
/**
 * Callbacks functions
 *
 * @package blogjr
 */

if ( ! function_exists( 'blogjr_theme_color_custom_enable' ) ) :
	/**
	 * Check if theme color is custom.
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function blogjr_theme_color_custom_enable( $control ) {
		return 'custom' == $control->manager->get_setting( 'blogjr_theme_options[theme_color]' )->value();
	}
endif;
