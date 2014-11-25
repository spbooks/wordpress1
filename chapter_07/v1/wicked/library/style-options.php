<?php

function wicked_load_custom_styles() {
  // load the custom options
  global $childoptions;
  foreach ($childoptions as $value) {
    $$value['id'] = get_option($value['id'], $value['std']);
  }
  
  // output a style sheet with the options
  ?>

  <style type="text/css">
    /* <![CDATA[ */
    /* Color Options */
    a, a:link, a:visited,
    #content a,
    #content a:link,
    #content a:visited {color:#<?php echo $wicked_link_color; ?>;}

    <?php if ($wicked_show_logo  == 'true') { ?>

    #blog-title {
      background:transparent url('<?php echo get_bloginfo('stylesheet_directory') ?>/images/header.png') left top no-repeat;
      padding-left: 120px;
      height: 100px;
    }
    
    <?php } ?>

    /* ]]> */
  </style>
  
  <?php
} // end function

add_action('wp_head', 'wicked_load_custom_styles');

?>