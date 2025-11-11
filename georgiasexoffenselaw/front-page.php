<?php
/**
 * Front Page
 *
 * @package      GeorgiaSexOffenseLaw
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

// h1 front page
add_filter( 'ea_h1_site_title', '__return_true' );

// Don't show the 'after entry content' on this page - this prevents it from showing for posts in the featured posts loop
remove_action( 'tha_entry_bottom', 'ea_after_entry_content' );


function ea_home_content(){

    // Home Slider
    // ********************************************************************************
    $slides = ea_cf( 'ea_home_slider', false );
	if( $slides ) {
	    echo '<div class="home-top">';
	    echo '<div class="wrap">';
	    echo '<div class="row justify-content-md-center">';
	    echo '<div class="col-md-10">';
	    echo '<div class="home-slider slick-slider">';
	    foreach( $slides as $slide ){
	        echo '<div class="slide">';
            echo '<h6><a href="' . get_category_link( ea_first_term( 'category', 'id', $slide['slider_post'] ) ) . '">' . ea_first_term( 'category', 'name', $slide['slider_post'] ) . '</a></h6>';
            echo '<h2 class="large"><a href="' . get_permalink( $slide['slider_post'] ) . '">' . get_the_title( $slide['slider_post'] ) . '</a></h2>';
	        echo '</div> <!-- .slide -->';
	    } // end foreach
	    echo '</div> <!-- .home-slider -->';
	    echo '</div> <!-- .col-md-10 -->';
	    echo '</div> <!-- .row -->';
	    echo '</div> <!-- .wrap -->';
	    echo '</div> <!-- .home-top -->';
	}


    // Featured Posts
    // ********************************************************************************

    $featured_posts = ea_cf( 'ea_featured_posts', false );
    if( $featured_posts ){

        $ids = wp_list_pluck( $featured_posts, 'featured_post' );
        $loop = new WP_Query( array(
            'posts_per_page' => 8,
            'post__in' => $ids,
            'orderby' => 'post__in'
        ) );
        if( $loop->have_posts() ):

		    echo '<div class="featured-posts">';
		    echo '<div class="wrap">';
		    echo '<div class="post-blocks">';

			while( $loop->have_posts() ): $loop->the_post();
            	get_template_part( 'partials/archive', 'home' );
        	endwhile;

	        echo '</div> <!-- .post-blocks -->';
	        echo '</div> <!-- .wrap -->';
	        echo '</div> <!-- .featured-posts -->';

		endif; wp_reset_postdata();
	}

    // About Section
    // ********************************************************************************
    echo '<div class="about">';
    echo '<div class="wrap">';

	echo ea_line_maker( '<h5 class="title">About</h5>' );

    echo '<div class="section-content">';
    echo apply_filters( 'ea_the_content', ea_cf('ea_home_about') );
    echo '</div> <!-- .section-content -->';

    echo '</div> <!-- .wrap -->';
    echo '</div> <!-- .about -->';









} // end function


// Build the page
get_header();
ea_home_content();
get_footer();
