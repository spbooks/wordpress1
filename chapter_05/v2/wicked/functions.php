<?php

function wicked_footer_pagelinks() {
  echo '<ul id="simplepages">';
  wp_list_pages('depth=1&sort_column=menu_order&title_li=');
  echo '</ul>';
}

?>