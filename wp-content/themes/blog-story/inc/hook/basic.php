<?php
/**
 * Basic theme functions.
 *
 * This file contains hook functions attached to core hooks.
 *
 * @package Blog Story
 */

if( ! function_exists( 'blog_story_primary_navigation_fallback' ) ) :

	/**
	 * Fallback for primary navigation.
	 *
	 * @since 1.0.0
	 */
	function blog_story_primary_navigation_fallback() {
		
		echo '<ul>';
			echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' .esc_html__( 'Home', 'blog-story' ). '</a></li>';
			wp_list_pages( array(
			'title_li' => '',
			'depth'    => 1,
			'number'   => 5,
			) );
		echo '</ul>';

	}

endif;


if ( ! class_exists( 'WP_Customize_Control' ) )
  return NULL;

/**
 * Class blog_story_Dropdown_Taxonomies_Control
 */
class blog_story_Dropdown_Taxonomies_Control extends WP_Customize_Control {

    /**
     * Render the control's content.
     *
     * @since 3.4.0
     */
    public function render_content() {
        $dropdown = wp_dropdown_categories(
            array(
                'name'              => 'blog-story-dropdown-categories-' . $this->id,
                'echo'              => 0,
                'show_option_none'  => __( '&mdash; Select &mdash;', 'blog-story' ),
                'option_none_value' => '0',
                'selected'          => $this->value(),
                'hide_empty'        => 0,                   

            )
        ); 
        
        $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

        printf(
            '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s <span class="description customize-control-description"></span>%s </label>',
            esc_html($this->label),
            esc_html($this->description),
            $dropdown

        );
    }

}

 /**
 * Customize Control for Repeater Text.
 *
 * @since 1.0.0
 *
 * @see WP_Customize_Control
 */
class blog_story_Repeater_Text_Control extends WP_Customize_Control {

    /**
     * Control type.
     *
     * @access public
     * @var string
     */
    public $type = 'repeater-text';

    /**
     * Render content.
     *
     * @since 1.0.0
     */
    public function render_content() {
        ?>
        <?php if ( ! empty( $this->label ) ) : ?>
            <h3><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span></h3>
        <?php endif; ?>
        <?php if ( ! empty( $this->description ) ) : ?>
            <span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
        <?php endif; ?>
        <label class="repeater-text-input">
            <input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="repeater-text-value" <?php $this->link(); ?> />
            <div class="repeater-text-fields">
                <div class="set">
                    <input type="text" value="" class="repeater-text-single-field" />
                    <span class="btn-remove-field"><span class="dashicons dashicons-no-alt"></span></span>
                </div>
            </div>
            <a href="#" class="button button-primary btn-add-field"><?php esc_html_e( 'Add New', 'blog-story' ) ?></a>
        </label><!-- .repeater-text-input -->
        <?php
    }
}

/**
 * Customizer Controls
 *
 * @package Blog Story
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) :
    return null;
endif;