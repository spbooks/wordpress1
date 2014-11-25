<?php

function wicked_footer_pagelinks() {
  echo '<ul id="simplepages">';
  wp_list_pages('depth=1&sort_column=menu_order&title_li=');
  echo '</ul>';
}

// Add a favicon
function wicked_favicon() {
  echo '<link rel="shortcut icon" href="' . get_bloginfo('stylesheet_directory') . '/images/favicon.ico"/>';
}
add_action('wp_head', 'wicked_favicon');

?>