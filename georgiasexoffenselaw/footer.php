<?php
/**
 * Site Footer
 *
 * @package      GeorgiaSexOffenseLaw
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/


echo '</div>'; // .site-inner
tha_footer_before();
echo '<footer class="site-footer" role="contentinfo"><div class="wrap">';
tha_footer_top();

$title = 'GSOL';
$title = is_front_page() ? '<span class="title">' . $title . '</span>' : '<a class="title" href="' . home_url() . '">' . $title . '</a>';
echo '<div class="lower-site-title">' . ea_line_maker( $title ) . '</div>';

// =socials
ea_social_links();

echo '<p>' . ea_cf('ea_footer_content', false, array( 'type' => 'theme_option' ) ) . '</p>';

tha_footer_bottom();
echo '</div></footer>';
tha_footer_after();

echo '</div> <!-- .site-container -->';
tha_body_bottom();
wp_footer();

echo '</body></html>';
