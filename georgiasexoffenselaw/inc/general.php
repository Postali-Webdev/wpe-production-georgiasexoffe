<?php
/**
 * General Functions
 *
 * @package      GeorgiaSexOffenseLaw
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Body Classes
 *
 */
function ea_archive_body_classes( $classes ) {

	// Blog Archive
	if( is_home() || is_archive() || is_search() ) {
        $classes[] = 'archive';
    }

	// Standard layout (content less wide then header/footer)
	$standard = apply_filters( 'ea_standard_body_class', is_singular() || is_page()  ); // override this at the template level if need be
	if( $standard )
		$classes[] = 'layout-standard';

	// Site Background
	$bg = false;
	if( is_singular() )
		$bg = ea_cf( 'ea_page_bg' );
	if( is_category() )
		$bg = ea_cf( 'ea_page_bg', get_queried_object_id(), array( 'type' => 'term_meta' ) );
	if( empty( $bg ) || 'bg_default' == $bg )
		$bg = ea_cf( 'ea_default_page_bg', false, array( 'type' => 'theme_option' ) );
	$classes[] = esc_attr( $bg );

	return $classes;
}
add_filter( 'body_class', 'ea_archive_body_classes' );

/**
 * Archive Header
 *
 */
function ea_archive_header() {

	$title = $description = false;

	if( is_search() )
		$title = 'Search Results for: <em>' . get_search_query() . '</em>';
	if( is_archive() ) {
		$title = get_the_archive_title();
		$description = get_the_archive_description();
	}

	if( empty( $title ) && empty( $description ) )
		return;

	echo '<header class="archive-intro">';
	if( ! empty( $title ) )
		echo '<h1 class="archive-title">' . $title . '</h1>';
	    do_action( 'ea_after_archive_title' );
	if( ! empty( $description ) )
		echo '<div class="archive-description">' . apply_filters( 'ea_the_content', $description ) . '</div>';
	echo '</header>';

}
add_action( 'tha_content_while_before', 'ea_archive_header' );
