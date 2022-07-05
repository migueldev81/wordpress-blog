<?php
/**
 * Hero Content hook
 *
 * @package blogjr
 */

if ( ! function_exists( 'blogjr_add_hero_content_section' ) ) :
    /**
    * Add hero_content section
    *
    *@since BlogJr 1.0.0
    */
    function blogjr_add_hero_content_section() {

        // Check if hero_content is enabled on frontpage
        $hero_content_enable = apply_filters( 'blogjr_section_status', 'enable_hero_content', '' );

        if ( ! $hero_content_enable )
            return false;

        if ( ! is_singular() ) {
            $paged = get_query_var( 'paged' );
            if ( $paged !== 0 )
                return false;
        }

        // Get hero_content section details
        $section_details = array();
        $section_details = apply_filters( 'blogjr_filter_hero_content_section_details', $section_details );

        if ( empty( $section_details ) ) 
            return;

        // Render hero_content section now.
        blogjr_render_hero_content_section( $section_details );
    }
endif;
add_action( 'blogjr_primary_content_action', 'blogjr_add_hero_content_section', 10 );


if ( ! function_exists( 'blogjr_get_hero_content_section_details' ) ) :
    /**
    * hero_content section details.
    *
    * @since BlogJr 1.0.0
    * @param array $input hero_content section details.
    */
    function blogjr_get_hero_content_section_details( $input ) {

        // Content type.
        $content = array();
        $page_id = blogjr_theme_option( 'hero_content_content_page' );
        
        $args = array(
            'post_type'         => 'page',
            'page_id'           =>  absint( $page_id ),
            'posts_per_page'    => 1,
            );                    


        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();

                // Push to the main array.
                array_push( $content, $page_post );
            endwhile;
        endif;
        wp_reset_postdata();
            
        if ( ! empty( $content ) )
            $input = $content;
       
        return $input;
    }
endif;
// hero_content section content details.
add_filter( 'blogjr_filter_hero_content_section_details', 'blogjr_get_hero_content_section_details' );


if ( ! function_exists( 'blogjr_render_hero_content_section' ) ) :
    /**
    * Start hero_content section
    *
    * @return string hero_content content
    * @since BlogJr 1.0.0
    *
    */
    function blogjr_render_hero_content_section( $content_details = array() ) {
        $hero_content_alignment  = blogjr_theme_option( 'hero_content_alignment','align-center' );
        if ( empty( $content_details ) )
            return;

        foreach ( $content_details as $content ) : ?>
        	<div id="hero-content-section" class="relative homepage-section wrapper <?php echo esc_attr( $hero_content_alignment ); ?>">
                <div class="entry-container">
                    <header class="entry-header">
                        <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo blogjr_title_allow_span( $content['title'] ); ?></a></h2>
                    </header>
                </div>
            </div><!-- #hero_content-section -->
        <?php endforeach;
    }
endif;