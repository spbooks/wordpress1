<?php

// Register the extra Footer Aside
function wicked_footer_aside() {
  register_sidebar(array(
    'name' => 'Main Footer Aside',
    'id' => 'footer-aside',
    'description' => __('A widget area in the footer, above the subsidiary asides.', 'thematic'),
    'before_widget' => thematic_before_widget(),
    'after_widget' => thematic_after_widget(),
    'before_title' => thematic_before_title(),
    'after_title' => thematic_after_title(), )
  );
}
add_action('init', 'wicked_footer_aside');

// Add footer Sidebar Area
function add_wicked_footer_aside() {
  if (is_sidebar_active('footer-aside')) {
    echo thematic_before_widget_area('footer-aside');
    dynamic_sidebar('footer-aside');
    echo thematic_after_widget_area('footer-aside');
  }
}
add_action('thematic_footer','add_wicked_footer_aside', 10);

?>