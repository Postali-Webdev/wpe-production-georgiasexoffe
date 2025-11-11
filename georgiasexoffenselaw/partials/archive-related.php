<?php
/**
 * Archive partial
 *
 * @package      GeorgiaSexOffenseLaw
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
 *  =related
**/

// Don't show the 'after entry content' - this prevents it from showing for posts in the related posts loop
remove_action( 'tha_entry_bottom', 'ea_after_entry_content' );


echo '<div class="post-block">';
echo '<div class="post-block-inner">';

echo '<article class="' . join( ' ', get_post_class() ) . '">';

	echo '<header class="entry-header">';
    echo '<h6><a href="' . get_category_link( ea_first_term( 'category', 'id', get_the_ID() ) ) . '">' . ea_first_term( 'category', 'name', get_the_ID() ) . '</a></h6>';
    echo '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . get_the_title() . '</a></h2>';
	echo '</header>';

	echo '<div class="entry-content">';
		tha_entry_content_before();
        the_excerpt();
		tha_entry_content_after();
	echo '</div>';

	echo '<footer class="entry-footer">';
		tha_entry_bottom();
	echo '</footer>';

echo '</article>';

echo '</div> <!-- .post-block-inner -->';
echo '</div> <!-- .post-block  -->';
