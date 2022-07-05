<?php
/**
 * Customizer Controls
 *
 * @package blogjr
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) :
	return null;
endif;


/**
 * Customize Control for Switch Control.
 *
 * @see WP_Customize_Control
 */
Class BlogJr_Switch_Control extends WP_Customize_Control{
	public $type = 'switch';
	public $on_off_label = array();

	public function __construct( $manager, $id, $args = array() ){
        $this->on_off_label = $args['on_off_label'];
        parent::__construct( $manager, $id, $args );
    }

	public function render_content(){
    ?>
	    <span class="customize-control-title">
			<?php echo esc_html( $this->label ); ?>
		</span>

		<?php if( $this->description ) : ?>
			<span class="description customize-control-description">
				<?php echo wp_kses_post( $this->description ); ?>
			</span>
		<?php endif;

		$switch_class = ( $this->value() == 'true' ) ? 'switch-on' : '';
		$on_off_label = $this->on_off_label;
		?>
		<div class="onoffswitch <?php echo esc_attr( $switch_class ); ?>">
			<div class="onoffswitch-inner">
				<div class="onoffswitch-active">
					<div class="onoffswitch-switch"><?php echo esc_html( $on_off_label['on'] ) ?></div>
				</div>

				<div class="onoffswitch-inactive">
					<div class="onoffswitch-switch"><?php echo esc_html( $on_off_label['off'] ) ?></div>
				</div>
			</div>	
		</div>
		<input <?php $this->link(); ?> type="hidden" value="<?php echo esc_attr( $this->value() ); ?>"/>
		<?php
    }
}


/**
 * Create a Radio-Image control
 * 
 * 
 * @link https://github.com/reduxframework/kirki/
 * @link http://ottopress.com/2012/making-a-custom-control-for-the-theme-customizer/
 */
Class BlogJr_Radio_Image_Control extends WP_Customize_Control {
	
	/**
	 * Declare the control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'radio-image';
	
	/**
	 * Render the control to be displayed in the Customizer.
	 */
	public function render_content() {
		if ( empty( $this->choices ) )
			return;
		
		$name = '_customize-radio-' . $this->id;
		?>
		<span class="customize-control-title">
			<?php 
			echo esc_attr( $this->label );
			if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>
		</span>
		<div id="input_<?php echo esc_attr( $this->id ); ?>" class="image">
			<?php foreach ( $this->choices as $value => $label ) : ?>
					<label for="<?php echo esc_attr( $this->id ) . $value; ?>">
						<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo esc_attr( $this->id ) . $value; ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
						<img src="<?php echo esc_url( $label ); ?>" alt="<?php echo esc_attr( $value ); ?>" title="<?php echo esc_attr( $value ); ?>">
						</input>
					</label>
			<?php endforeach; ?>
		</div>
	<?php }
}


/**
 * Customize Control for Chosen Select Dropdown.
 *
 * @see WP_Customize_Control
 */
class BlogJr_Dropdown_Chosen_Control extends WP_Customize_Control{
	public $type = 'dropdown_chooser';

	public function render_content(){
		if ( empty( $this->choices ) )
                return;
		?>
            <label>
                <span class="customize-control-title">
                	<?php echo esc_html( $this->label ); ?>
                </span>

                <?php if($this->description){ ?>
	            <span class="description customize-control-description">
	            	<?php echo wp_kses_post($this->description); ?>
	            </span>
	            <?php } ?>

                <select class="blogjr-chosen-select" <?php $this->link(); ?>>
                    <?php
                    foreach ( $this->choices as $value => $label )
                        echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . esc_html( $label ) . '</option>';
                    ?>
                </select>
            </label>
		<?php
	}
}

/**
 * Customize Control for Multiple Chosen Select Dropdown.
 *
 * @see WP_Customize_Control
 */
class BlogJr_Dropdown_Multiple_Chosen_Control extends WP_Customize_Control{
	public $type = 'dropdown_chooser';

	public function render_content(){
		if ( empty( $this->choices ) )
                return;
		?>
            <label>
                <span class="customize-control-title">
                	<?php echo esc_html( $this->label ); ?>
                </span>

                <?php if($this->description){ ?>
	            <span class="description customize-control-description">
	            	<?php echo wp_kses_post($this->description); ?>
	            </span>
	            <?php } ?>

                <select class="blogjr-chosen-select" multiple="multiple" <?php $this->link(); ?>>
                    <?php
                    foreach ( $this->choices as $value => $label )
                        echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . esc_html( $label ) . '</option>';
                    ?>
                </select>
            </label>
		<?php
	}
}


/**
 * Customize Control for Horizontal Line.
 *
 * @see WP_Customize_Control
 */
Class BlogJr_Horizontal_Line extends WP_Customize_Control {
	public $type = 'hr';

	public function render_content() { ?>
		<div>
			<hr style="border: 1px solid #72777c;" />
		</div>
	<?php }
}


/**
 * Upsell customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class BlogJr_Customize_Section_Upsell extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'upsell';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

			<h3 class="accordion-section-title">
				{{ data.title }}

				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{ data.pro_url }}" class="button button-primary alignright" target="_blank">{{ data.pro_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}