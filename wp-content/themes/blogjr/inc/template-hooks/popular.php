<?php
/**
 * Popular hook
 *
 * @package blogjr
 */

if ( ! function_exists( 'blogjr_add_popular_section' ) ) :
    /**
    * Add popular section
    *
    *@since BlogJr 1.0.0
    */
    function blogjr_add_popular_section() {

        // Check if popular is enabled on frontpage
        $popular_enable = apply_filters( 'blogjr_section_status', 'enable_popular', '' );

        if ( ! $popular_enable )
            return false;

        if ( ! is_singular() ) {
            $paged = get_query_var( 'paged' );
            if ( $paged !== 0 )
                return false;
        }

        // Get popular section details
        $section_details = array();
        $section_details = apply_filters( 'blogjr_filter_popular_section_details', $section_details );

        if ( empty( $section_details ) ) 
            return;

        // Render popular section now.
        blogjr_render_popular_section( $section_details );
    }
endif;
add_action( 'blogjr_primary_content_action', 'blogjr_add_popular_section', 10 );


if ( ! function_exists( 'blogjr_get_popular_section_details' ) ) :
    /**
    * popular section details.
    *
    * @since BlogJr 1.0.0
    * @param array $input popular section details.
    */
    function blogjr_get_popular_section_details( $input ) {

        $content = array();
        $post_ids = array();

        for ( $i = 1; $i <= 3; $i++ )  :
            $post_ids[] = blogjr_theme_option( 'popular_content_post_' . $i );
        endfor;

        $args = array(
            'post_type'         => 'post',
            'post__in'          =>  ( array ) $post_ids,
            'posts_per_page'    => 3,
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
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : '';

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
// popular section content details.
add_filter( 'blogjr_filter_popular_section_details', 'blogjr_get_popular_section_details' );


if ( ! function_exists( 'blogjr_render_popular_section' ) ) :
  /**
   * Start popular section
   *
   * @return string popular content
   * @since BlogJr 1.0.0
   *
   */
   function blogjr_render_popular_section( $content_details = array() ) {
        if ( empty( $content_details ) )
            return;

        $title = blogjr_theme_option( 'popular_title', '' );
        ?>
    	<div id="popular-posts" class="relative homepage-section">
            <div class="page-section wrapper">
                <?php if ( ! empty( $title ) ) : ?>
                    <header class="page-header">
                        <h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
                    </header>
                <?php endif; ?>

                <div class="section-content left-align column-3">
                    <?php foreach ( $content_details as $content ) : ?>
                        <article class="hentry">
                            <div class="post-wrapper">
                                <?php if ( ! empty( $content['image'] ) ) : ?>
                                    <div class="featured-image">
                                        <a href="<?php echo esc_url( $content['url'] ); ?>">
                                            <img src="<?php echo esc_url( $content['image'] ); ?>" alt="<?php echo esc_attr( $content['title'] ); ?>">
                                        </a>
                                    </div><!-- .recent-image -->
                                <?php endif; ?>

                                <div class="entry-container">
                                    <div class="entry-meta">
                                        <span class="posted-on">
                                            <a href="<?php echo esc_url( $content['url'] ); ?>">
                                                <time>
                                                    <?php echo esc_html( get_the_date( get_option('date_format'), $content['id'] ) ); ?>
                                                </time>
                                            </a>
                                        </span>
                                    </div>

                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo blogjr_title_allow_span( $content['title'] ); ?></a></h2>
                                    </header>

                                </div><!-- .entry-container -->
                            </div><!-- .post-wrapper -->
                        </article>
                    <?php endforeach; ?>
                </div><!-- .section-content -->
            </div><!-- .wrapper -->
        </div><!-- #popular-posts -->
    <?php 
    }
endif;