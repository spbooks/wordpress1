<?php

function wicked_load_custom_styles() {
  // load the custom options
  global $childoptions;
  foreach ($childoptions as $value) {
    $$value['id'] = get_option($value['id'], $value['std']);
  }
  
  wp_enqueue_style(
    'wicked-skin',
    get_bloginfo('stylesheet_directory').'/skins/'.$wicked_color_variant.'/skin.css',
    '', '', 'all'
  );
} // end function

add_action('wp_print_styles', 'wicked_load_custom_styles');

?>