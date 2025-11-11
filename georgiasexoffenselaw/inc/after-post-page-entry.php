<?php
/**
 * After Post / Page Entry
 *
 * @package      GeorgiaSexOffenseLaw
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

function ea_after_entry_content(){
    if( is_singular( array( 'post', 'page' ) ) ){
        if( $after_entry_content = ea_cf('ea_after_entry_content') ){
            echo '<div class="after-entry-content">';
            echo '<hr />';
            echo $after_entry_content;
            echo '</div> <!-- .after-entry-content -->';
        }
    } // end if
} // end function
add_action( 'tha_entry_bottom', 'ea_after_entry_content' );
