<?php
/**
 * Slider hook
 *
 * @package blogjr
 */

if ( ! function_exists( 'blogjr_add_slider_section' ) ) :
    /**
    * Add slider section
    *
    *@since BlogJr 1.0.0
    */
    function blogjr_add_slider_section() {

        // Check if slider is enabled on frontpage
        $slider_enable = apply_filters( 'blogjr_section_status', 'enable_slider', 'slider_entire_site' );

        if ( ! $slider_enable )
            return false;

        if ( ! is_singular() ) {
            $paged = get_query_var( 'paged' );
            if ( $paged !== 0 )
                return false;
        }

        // Get slider section details
        $section_details = array();
        $section_details = apply_filters( 'blogjr_filter_slider_section_details', $section_details );

        if ( empty( $section_details ) ) 
            return;

        // Render slider section now.
        blogjr_render_slider_section( $section_details );
    }
endif;
add_action( 'blogjr_primary_content_action', 'blogjr_add_slider_section', 10 );


if ( ! function_exists( 'blogjr_get_slider_section_details' ) ) :
    /**
    * slider section details.
    *
    * @since BlogJr 1.0.0
    * @param array $input slider section details.
    */
    function blogjr_get_slider_section_details( $input ) {

        $content = array();
        $post_ids = array();

        for ( $i = 1; $i <= 5; $i++ )  :
            $post_ids[] = blogjr_theme_option( 'slider_content_post_' . $i );
        endfor;
        
        $args = array(
            'post_type'         => 'post',
            'post__in'          =>  ( array ) $post_ids,
            'posts_per_page'    => 5,
            'orderby'           => 'post__in',
            'ignore_sticky_posts' => true,
            );                    


        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : '';
                $page_post['date']     = get_the_date( get_option( 'date_format' ) );
                $page_post['author']     = get_the_author();

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
// slider section content details.
add_filter( 'blogjr_filter_slider_section_details', 'blogjr_get_slider_section_details' );


if ( ! function_exists( 'blogjr_render_slider_section' ) ) :
  /**
   * Start slider section
   *
   * @return string slider content
   * @since BlogJr 1.0.0
   *
   */
   function blogjr_render_slider_section( $content_details = array() ) {
        if ( empty( $content_details ) )
            return;

        $slider_control = blogjr_theme_option( 'slider_arrow' );
        $auto_slide = blogjr_theme_option('slider_auto_slide', false );
        $slider_width = blogjr_theme_option( 'slider_width', 'full-width' );
        $slider_layout = blogjr_theme_option( 'slider_layout', 'left-align' );
        $column = blogjr_theme_option( 'slider_column', 1 );
        $class = array();
        ?>
    	<div id="custom-header" class="homepage-section">
            <div class="section-content banner-slider <?php echo ( 'container-width' == $slider_width ) ? 'wrapper' : ''; ?> <?php echo esc_attr( $slider_layout ); ?> <?php echo 'column-' . absint( $column ); ?>" data-slick='{"slidesToShow": <?php echo absint( $column ); ?>, "slidesToScroll": 1, "infinite": true, "speed": 1200, "dots": false, "arrows":<?php echo $slider_control ? 'true' : 'false'; ?>, "autoplay": <?php echo $auto_slide ? 'true' : 'false'; ?>, "fade": <?php echo ( $column == 1 ) ? 'true' : 'false'; ?>, "draggable": true }'>
                <?php foreach ( $content_details as $content ) : ?>
                    <div class="custom-header-content-wrapper slide-item">
                        <div class="overlay"></div>
                        <?php if ( ! empty( $content['image'] ) ) : ?>
                            <img src="<?php echo esc_url( $content['image'] ); ?>" alt="<?php echo esc_attr( $content['title'] ); ?>">
                        <?php endif; ?>

                        <div class="wrapper">
                            <div class="custom-header-content">
                                <span class="cat-links">
                                    <?php the_category( ', ', '', $content['id'] ); ?>
                                </span>

                                <h2><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo blogjr_title_allow_span( $content['title'] ); ?></a></h2>

                                <div class="entry-meta">
                                    <a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo wp_kses_post( $content['author'] ); ?></a>
                                    <a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['date'] ); ?></a>
                                </div>

                                <a href="<?php echo esc_url( $content['url'] ); ?>" class="btn btn-transparent"><?php echo blogjr_get_svg( array( 'icon' => 'angle-right' ) ); ?></a>
                            </div><!-- .custom-header-content -->
                        </div><!-- .wrapper -->
                    </div><!-- .custom-header-content-wrapper -->
                <?php endforeach; ?>
            </div><!-- .banner-slider -->
        </div><!-- #custom-header -->
    <?php 
    }
endif;