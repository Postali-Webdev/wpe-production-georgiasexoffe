<?php
/**
 * Single Post Template
 *
 * @package      GeorgiaSexOffenseLaw
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
 **/




/**
 * Related Posts : =related
 *
 */
function ea_related_posts(){

    // uses Posts2Posts plugin
    $connected = new WP_Query( array(
        'connected_type' => 'posts_to_posts',
        'connected_items' => get_queried_object(),
        'nopaging' => true,
    ) );

    if ( $connected->have_posts() ) :
        echo '<div class="related-posts">';

        echo '<div class="section-title">' . ea_line_maker( '<h5 class="title">Related Posts</h5>' ) . '</div>';

        echo '<div class="post-blocks">';
        while ( $connected->have_posts() ) : $connected->the_post();
            get_template_part( 'partials/archive', 'related' );
        endwhile; wp_reset_postdata();
        echo '</div> <!-- .post-blocks -->';

        echo '</div> <!-- .related-posts -->';
    endif;

} // end function
add_action( 'tha_content_bottom', 'ea_related_posts' );

// Build the page
require get_template_directory() . '/index.php';
