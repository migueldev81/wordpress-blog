/**
 * Scripts within the customizer controls window.
 *
 */

jQuery( document ).ready(function($) {

    /********* Chosen Select Custom control ***********/
    $(".blogjr-chosen-select").chosen({
        width: "100%"
    });

    //Switch Control
    $('body').on('click', '.onoffswitch', function(){
        var $this = $(this);
        if($this.hasClass('switch-on')){
            $(this).removeClass('switch-on');
            $this.next('input').val( false ).trigger('change')
        }else{
            $(this).addClass('switch-on');
            $this.next('input').val( true ).trigger('change')
        }
    });


    /********* Multi Input Custom control ***********/
    $( document ).on( 'click', '.customize_multi_add_field', blogjr_customize_multi_add_field )
        .on( 'change', '.customize_multi_single_field', blogjr_customize_multi_single_field )
        .on( 'click', '.customize_multi_remove_field', blogjr_customize_multi_remove_field )

    $( '.customize_multi_input' ).each(function() {
        var $this = $( this );
        var multi_saved_value = $this.find( '.customize_multi_value_field' ).val();
        if (multi_saved_value.length > 0) {
            var multi_saved_values = multi_saved_value.split( "|" );
            $this.find( '.customize_multi_fields' ).empty();
            var $control = $this.parents( '.customize_multi_input' );
            $.each(multi_saved_values, function( index, value ) {
                $this.find( '.customize_multi_fields' ).append( '<div class="set"><input type="text" value="' + value + '" class="customize_multi_single_field" /><span class="customize_multi_remove_field"><span class="dashicons dashicons-no-alt"></span></span></div>' );
            });
        }
    });
    function blogjr_customize_multi_add_field(e) {
        var $this = $( e.currentTarget );
        e.preventDefault();
            var $control = $this.parents( '.customize_multi_input' );
            $control.find( '.customize_multi_fields' ).append( '<div class="set"><input type="text" value="" class="customize_multi_single_field" /><span class="customize_multi_remove_field"><span class="dashicons dashicons-no-alt"></span></span></div>' );
            blogjr_customize_multi_write( $control );
    }

    function blogjr_customize_multi_single_field() {
        var $control = $( this ).parents( '.customize_multi_input' );
        blogjr_customize_multi_write( $control );
    }

    function blogjr_customize_multi_remove_field(e) {
        e.preventDefault();
        var $this = $( this );
        var $control = $this.parents( '.customize_multi_input' );
        $this.parent().remove();
        blogjr_customize_multi_write( $control );
    }

    function blogjr_customize_multi_write( $element) {
        var customize_multi_val = '';
        $element.find( '.customize_multi_fields .customize_multi_single_field' ).each(function() {
            customize_multi_val += $( this ).val() + '|';
        });
        $element.find( '.customize_multi_value_field' ).val( customize_multi_val.slice( 0, -1 ) ).change();
    }

    $(document).on("click", ".upload_image_button", function (e) {
        e.preventDefault();
        var $button = $(this);
 
 
        // Create the media frame.
        var file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select or upload image',
            library: { // remove these to show all
                type: 'image' // specific mime
            },
            button: {
                text: 'Select'
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });
 
        // When an image is selected, run a callback.
        file_frame.on('select', function () {
            // We set multiple to false so only get one image from the uploader
            var attachment = file_frame.state().get('selection').first().toJSON();
 
            $button.prev('input').val(attachment.url);
 
        });
 
        // Finally, open the modal
        file_frame.open();
   });

});

( function( api ) {
    // Deep linking for menus
    wp.customize.bind('ready', function() {
        jQuery('a.menu_locations').click(function(e) {
            e.preventDefault();
            wp.customize.section( 'menu_locations' ).focus()
        });
    });
} )( wp.customize );


( function( api ) {
    // upsell 
    api.sectionConstructor['upsell'] = api.Section.extend( {
        // No events for this type of section.
        attachEvents: function () {},
        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    } );
} )( wp.customize );