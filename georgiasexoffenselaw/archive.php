<?php
/**
 * Category Template
 *
 * @package      GeorgiaSexOffenseLaw
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/*
 * Topic Selection : =topic
 */
function exde_topic_selection(){

	if( ! is_category() )
		return;

    $args = array(
        'taxonomy' => 'category',
        'hide_empty' => true,
        'orderby'    => 'title',
        'order'      => 'ASC',
    );
    $topics = get_terms( $args );

    echo '<div class="topic-selection">';
	echo ea_line_maker( '<a href="#" class="topic-toggle">Select Topic <i class="icon-carat-down"></i></a>' );

    // this must be outside of the line-maker divs since those have overflow:hidden on them, which would hide this
    echo '<ul class="topics">';
    foreach( $topics as $topic ){
        echo '<li class="topic"><a href="' . get_term_link( $topic, 'category' ) . '">' . $topic->name . '</a></li>';
    } // end foreach
    echo '</ul> <!-- .topics -->';
    echo '</div> <!-- .topic-selection -->';
} // end function
add_action( 'ea_after_archive_title', 'exde_topic_selection' );


/**
 * Custom/non-bootstrap Grid - two columns on larger screens
 *
 */
// post-blocks container is just to assist with CSS targeting if need be
function ea_open_post_blocks(){
    echo '<div class="post-blocks">';
} // end function
add_action( 'tha_content_while_before', 'ea_open_post_blocks' );

function ea_close_post_blocks(){
    echo '</div> <!-- .post-blocks -->';
} // end function
add_action( 'tha_content_while_after', 'ea_close_post_blocks', 9 );

function ea_archive_entry_open() {
    echo '<section class="post-block">';
    echo '<div class="post-block-inner">';
}
add_action( 'tha_entry_before', 'ea_archive_entry_open' );

/**
 * Custom/non-bootstrap - Archive Entry Close
 *
 */
function ea_archive_entry_close() {
    echo '</div> <!-- .post-block-inner -->';
    echo '</section> <!-- .post-block  -->';
}
add_action( 'tha_entry_after', 'ea_archive_entry_close' );

/**
 * Archive Navigation
 *
 */
function ea_archive_navigation() {

	// Navigation
	the_posts_navigation();

	// Infinite scroll "Load More"
	global $wp_query;
	$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	if( $wp_query->max_num_pages > $page )
		echo '<div class="post-block load-more"><a class="button" href="#">Load More</a></div>';

}
add_action( 'tha_content_while_after', 'ea_archive_navigation', 8 );

// Build the page
require get_template_directory() . '/index.php';
