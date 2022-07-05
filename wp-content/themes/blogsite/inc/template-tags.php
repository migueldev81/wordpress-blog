<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package blogsite
 */

/**
 * Adds a meta box to the post editing screen
 */
function blogsite_featured_meta() {
    add_meta_box( 'blogsite_meta', __( 'Featured Post', 'blogsite' ), 'blogsite_meta_callback', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'blogsite_featured_meta' );
 
/**
 * Outputs the content of the meta box
 */
 
function blogsite_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'blogsite_nonce' );
    $blogsite_stored_meta = get_post_meta( $post->ID );
    ?>
 
 <p>
    <span class="blogsite-row-title"><?php esc_html_e( 'Featured this post on homepage?', 'blogsite' )?></span>
    <div class="blogsite-row-content">
        <label for="blogsite-featured">
            <input type="checkbox" name="blogsite-featured" id="blogsite-featured" value="yes" <?php if ( isset ( $blogsite_stored_meta['blogsite-featured'] ) ) checked( $blogsite_stored_meta['blogsite-featured'][0], 'yes' ); ?> />
            <?php esc_html_e( 'Featured Post', 'blogsite' )?>
        </label>
 
    </div>
</p>   
 
    <?php
}
 
/**
 * Saves the custom meta input
 */
function blogsite_meta_save( $post_id ) {
 
    // Checks save status - overcome autosave, etc.
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'blogsite_nonce' ] ) && wp_verify_nonce( sanitize_text_field( wp_unslash($_POST[ 'blogsite_nonce' ], basename( __FILE__ ) ) ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    //Don't update on Quick Edit
    if (defined('DOING_AJAX') ) {
        return $post_id;
    }    

    //Don't update on Bulk Edit
    if (isset($_REQUEST['bulk_edit'])) {
        return;
    }
 
    // Checks for input and saves - save checked as yes and unchecked at no
    if( isset( $_POST[ 'blogsite-featured' ] ) ) {
        update_post_meta( $post_id, 'blogsite-featured', 'yes' );
    } else {
        update_post_meta( $post_id, 'blogsite-featured', 'no' );
    }
 
}
add_action( 'save_post', 'blogsite_meta_save' );

/**
 * Add admin column for featured posts
 */
add_filter('manage_post_posts_columns', function($columns) {
    return array_merge($columns, ['blogsite-featured' => __('Featured', 'blogsite')]);
}); 

add_action('manage_post_posts_custom_column', function($column_key, $post_id) {
    if ($column_key == 'blogsite-featured') {
        $blogsite_featured = get_post_meta($post_id, 'blogsite-featured', 'yes');
        if ($blogsite_featured == 'yes') {
            echo '<span style="color:green;"><span class="dashicons dashicons-saved"></span></span>';
        } else {
            echo '';
        }
    }
}, 10, 2);

add_filter('manage_edit-post_sortable_columns', function($columns) {
    $columns['blogsite-featured'] = 'blogsite-featured';
    return $columns;
});

add_action('pre_get_posts', function($query) {
    if (!is_admin()) {
        return;
    }
 
    $orderby = $query->get('orderby');
    if ($orderby == 'blogsite-featured') {
        $query->set('meta_key', 'blogsite-featured');
        $query->set('meta_value', 'yes');
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');
    }
});

/**
 * Search Filter 
 */
if ( ! function_exists( 'blogsite_search_filter' ) && ( ! is_admin() ) ) :

function blogsite_search_filter($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}

add_filter('pre_get_posts','blogsite_search_filter');

endif;

/**
 * Filter the except length to 27 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
if ( ! function_exists( 'blogsite_custom_excerpt_length' ) ) :

function blogsite_custom_excerpt_length( $length ) {
    if ( is_admin() ) {
        return $length;
    } else {
       return '27'; 
    }
}
add_filter( 'excerpt_length', 'blogsite_custom_excerpt_length', 999 );

endif;

/**
 * Customize excerpt more.
 */
if ( ! function_exists( 'blogsite_excerpt_more' ) ) :

function blogsite_excerpt_more( $more ) {
    if ( is_admin() ) {
        return $more;
    } else {
        return '... ';
    }
}
add_filter( 'excerpt_more', 'blogsite_excerpt_more' );

endif;

/**
 * Display the first (single) category of post.
 */
if ( ! function_exists( 'blogsite_first_category' ) ) :
function blogsite_first_category() {
    $category = get_the_category();
    if ($category) {
      echo '<a href="' . esc_url( get_category_link( $category[0]->term_id ) ) . '">' . esc_html( $category[0]->name ) .'</a> ';
    }    
}
endif;

/**
 * Flush out the transients used in blogsite_categorized_blog.
 */
if ( ! function_exists( 'blogsite_category_transient_flusher' ) ) :

function blogsite_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'blogsite_categories' );
}
add_action( 'edit_category', 'blogsite_category_transient_flusher' );
add_action( 'save_post',     'blogsite_category_transient_flusher' );

endif;

/**
 * Disable specified widgets.
 */
if ( ! function_exists( 'blogsite_disable_specified_widgets' ) ) :

function blogsite_disable_specified_widgets( $sidebars_widgets ) {

    if ( isset($sidebars_widgets['header-ad']) ) {
        if ( is_array($sidebars_widgets['header-ad']) ) {
               foreach($sidebars_widgets['header-ad'] as $i => $widget) {
                    if( (strpos($widget, 'wpenjoy-') === false) ) {
                       unset($sidebars_widgets['header-ad'][$i]);
                    }
               }
        }     
    }

    if ( isset($sidebars_widgets['content-ad']) ) {
        if ( is_array($sidebars_widgets['content-ad']) ) {
               foreach($sidebars_widgets['content-ad'] as $i => $widget) {
                    if( (strpos($widget, 'wpenjoy-') === false) ) {
                       unset($sidebars_widgets['content-ad'][$i]);
                    }
               }
        }
    }                

    return $sidebars_widgets;
}
add_filter( 'sidebars_widgets', 'blogsite_disable_specified_widgets' );

endif;

/*
 * Limit Tags Count 
 */
//Register tag cloud filter callback
add_filter('widget_tag_cloud_args', 'blogsite_tag_widget_limit');
 
//Limit number of tags inside widget
function blogsite_tag_widget_limit($args){
 
//Check if taxonomy option inside widget is set to tags
if(isset($args['taxonomy']) && $args['taxonomy'] == 'post_tag'){
  $args['number'] = '30'; //Limit number of tags
}
 
return $args;
}

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function blogsite_skip_link_focus_fix() {
    // The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
    ?>
    <script>
    /(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
    </script>
    <?php
}
add_action( 'wp_print_footer_scripts', 'blogsite_skip_link_focus_fix' );

/**
 * Twenty Twenty SVG Icon helper functions
 *
 * @package blogsite
 * @subpackage blogsite
 * @since BlogSite 1.0
 */

if ( ! function_exists( 'blogsite_the_theme_svg' ) ) {
    /**
     * Output and Get Theme SVG.
     * Output and get the SVG markup for an icon in the BlogSite_SVG_Icons class.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function blogsite_the_theme_svg( $svg_name, $group = 'ui', $color = '' ) {
        echo blogsite_get_theme_svg( $svg_name, $group, $color ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in blogsite_get_theme_svg().
    }
}

if ( ! function_exists( 'blogsite_get_theme_svg' ) ) {

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function blogsite_get_theme_svg( $svg_name, $group = 'ui', $color = '' ) {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            BlogSite_SVG_Icons::get_svg( $svg_name, $group, $color ),
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );

        if ( ! $svg ) {
            return false;
        }
        return $svg;
    }
}


/**
 * Miscellaneous
 */

/**
 * Toggles animation duration in milliseconds.
 *
 * @return int Duration in milliseconds
 */
function blogsite_toggle_duration() {
    /**
     * Filters the animation duration/speed used usually for submenu toggles.
     *
     * @since BlogSite 1.0
     *
     * @param int $duration Duration in milliseconds.
     */
    $duration = apply_filters( 'blogsite_toggle_duration', 250 );

    return $duration;
}


/**
 * Menus
 */

/**
 * Filters classes of wp_list_pages items to match menu items.
 *
 * Filter the class applied to wp_list_pages() items with children to match the menu class, to simplify.
 * styling of sub levels in the fallback. Only applied if the match_menu_classes argument is set.
 *
 * @param string[] $css_class    An array of CSS classes to be applied to each list item.
 * @param WP_Post  $page         Page data object.
 * @param int      $depth        Depth of page, used for padding.
 * @param array    $args         An array of arguments.
 * @param int      $current_page ID of the current page.
 * @return array CSS class names.
 */
function blogsite_filter_wp_list_pages_item_classes( $css_class, $page, $depth, $args, $current_page ) {

    // Only apply to wp_list_pages() calls with match_menu_classes set to true.
    $match_menu_classes = isset( $args['match_menu_classes'] );

    if ( ! $match_menu_classes ) {
        return $css_class;
    }

    // Add current menu item class.
    if ( in_array( 'current_page_item', $css_class, true ) ) {
        $css_class[] = 'current-menu-item';
    }

    // Add menu item has children class.
    if ( in_array( 'page_item_has_children', $css_class, true ) ) {
        $css_class[] = 'menu-item-has-children';
    }

    return $css_class;

}

add_filter( 'blogsite_page_css_class', 'blogsite_filter_wp_list_pages_item_classes', 10, 5 );

/**
 * Adds a Sub Nav Toggle to the Expanded Menu and Mobile Menu.
 *
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @param WP_Post  $item  Menu item data object.
 * @param int      $depth Depth of menu item. Used for padding.
 * @return stdClass An object of wp_nav_menu() arguments.
 */
function blogsite_add_sub_toggles_to_main_menu( $args, $item, $depth ) {

    // Add sub menu toggles to the Expanded Menu with toggles.
    if ( isset( $args->show_toggles ) && $args->show_toggles ) {

        // Wrap the menu item link contents in a div, used for positioning.
        $args->before = '<div class="ancestor-wrapper">';
        $args->after  = '';

        // Add a toggle to items with children.
        if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

            $toggle_target_string = '.menu-modal .menu-item-' . $item->ID . ' > .sub-menu';
            $toggle_duration      = blogsite_toggle_duration();

            // Add the sub menu toggle.
            $args->after .= '<button class="toggle sub-menu-toggle fill-children-current-color" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="' . absint( $toggle_duration ) . '" aria-expanded="false"><span class="screen-reader-text">' . __( 'Show sub menu', 'blogsite' ) . '</span>' . blogsite_get_theme_svg( 'chevron-down' ) . '</button>';

        }

        // Close the wrapper.
        $args->after .= '</div><!-- .ancestor-wrapper -->';

        // Add sub menu icons to the primary menu without toggles.
    } elseif ( 'primary' === $args->theme_location ) {
        if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {
            $args->after = '<span class="icon"></span>';
        } else {
            $args->after = '';
        }
    }

    return $args;

}

add_filter( 'nav_menu_item_args', 'blogsite_add_sub_toggles_to_main_menu', 10, 3 );

/*
 * Customize archive title
 */
add_filter( 'get_the_archive_title', function ($title) {    
    if ( is_category() ) {    
            $title = single_cat_title( '', false );    
        } elseif ( is_tag() ) {    
            $title = single_tag_title( '', false );    
        } elseif ( is_author() ) {    
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;    
        } elseif ( is_tax() ) {
            $title = single_term_title( '', false );
        } elseif (is_post_type_archive()) {
            $title = post_type_archive_title( '', false );
        }
    return $title;    
});

/*
 * Remove parentheses from categories widget
 */
function blogsite_categories_postcount_filter ($variable) {
   $variable = str_replace('(', '<span class="post-count"> ', $variable);
   $variable = str_replace(')', ' </span>', $variable);
   return $variable;
}
add_filter('wp_list_categories','blogsite_categories_postcount_filter');

/*
 * Admin Notice
 */
function blogsite_notice() {
    
    global $current_user;
    
    $theme = wp_get_theme();

    $user_id = $current_user->ID;
    
    if (!get_user_meta($user_id, 'blogsite_notice_ignore')) {
        
        echo '<div class="notice-success notice"><p>'. esc_html('Thank you for installing the BlogSite theme!','blogsite') . '</p><p><a class="button-secondary" href="' . esc_url( $theme->get( 'ThemeURI' ) ) . '" target="_blank">' . esc_html( 'Theme Demo', 'blogsite' ) . '</a> '. '&nbsp;' . ' <a class="button-secondary" href="' . esc_url( $theme->get( 'AuthorURI' ) . '/documentation/blogsite' ) . '" target="_blank">' . esc_html( 'Documentation', 'blogsite' ) . '</a></p><p><a href="?blogsite-ignore-notice">' . esc_html( 'Dismiss', 'blogsite' ) . '</a></p></div>';
        
    }
    
}
add_action('admin_notices', 'blogsite_notice');

/*
 * Admin Notice Ignore
 */    
function blogsite_notice_ignore() {
    
    global $current_user;
    
    $user_id = $current_user->ID;
    
    if (isset($_GET['blogsite-ignore-notice'])) {
        
        add_user_meta($user_id, 'blogsite_notice_ignore', 'true', true);
        
    }
    
}
add_action('admin_init', 'blogsite_notice_ignore');

/* Add Menu Link to Admin Bar */
function blogsite_custom_toolbar_link($wp_admin_bar) {
    $args = array(
        'id' => 'blogsite-pro',
        'title' => esc_html('Upgrade to PRO Theme', 'blogsite'), 
        'href' => esc_url( wp_get_theme()->get( 'AuthorURI' ) . '/themes/blogsite-pro' ), 
        'meta' => array(
            'target'=> '_blank',
        )
    );
    $wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'blogsite_custom_toolbar_link', 999);

/* Admin Style */
function blogsite_admin_init() {
    if ( is_admin() ) {
        wp_enqueue_style("blogsite-admin-css", get_template_directory_uri() . "/assets/css/admin-style.css", false, "1.0", "all");
    }
}
add_action( 'admin_enqueue_scripts', 'blogsite_admin_init' );