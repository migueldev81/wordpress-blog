<?php
/**
 * Block Styles
 */

if ( function_exists( 'register_block_style' ) ) {
	/**
	 * Register block styles.
	 */
	function blogsite_register_block_styles() {
		// Image: Borders.
		register_block_style(
			'core/image',
			array(
				'name'  => 'blogsite-border',
				'label' => esc_html__( 'Borders', 'blogsite' ),
			)
		);
	}
	add_action( 'init', 'blogsite_register_block_styles' );
}
