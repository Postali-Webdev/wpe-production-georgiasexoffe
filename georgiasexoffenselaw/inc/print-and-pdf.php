<?php
/**
 * Print and PDF icons for singular page/posts
 *
 * @package      GeorgiaSexOffenseLaw
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

function ea_print_and_pdf(){
    if( is_singular() ){
        // requires this plugin for links to work: https://wordpress.org/plugins/pdf-print/
        // turned off the plugins icons /frontend appearance in its backend settings and using its style of hyperlinks
        echo '<div class="print-and-pdf">';
        echo '<a href="' . add_query_arg( 'print', 'print', get_permalink() ) . '"><i class="icon-printer"></i></a>';
        echo '<a href="' . add_query_arg( 'print', 'pdf', get_permalink() ) . '"><i class="icon-PDF"></i></a>';
        echo '</div> <!-- .print-and-pdf -->';
    } // end if
} // end function
add_action( 'tha_content_bottom', 'ea_print_and_pdf' );
