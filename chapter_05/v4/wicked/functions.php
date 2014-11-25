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

// Add social media links
function wicked_linklove($content) {
  if(is_single()) {
    $content .= '<div class="linklove">
      Did you love this post? Tell everyone you know, right now!
      ⋮ Paste the markup you received from AddThis here.
    </div>';
  }
  return $content;
}
add_filter('thematic_post','wicked_linklove', 90);

?>