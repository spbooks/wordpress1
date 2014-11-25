<?php

// Add support for thumbnails
add_theme_support('post-thumbnails');
set_post_thumbnail_size(540, 300, true);
add_image_size('homepage-thumbnail', 300, 200, true);

// output a list of top-level pages
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

// Add an author bio to the end of single post pages
function wicked_showbio($content)  {  
  if (is_single()) {  
    $content .=  '<div id="authorbio">';
    $content .= '<h3>About ' . get_the_author() . '</h3>';
    $content .= '<p>' . get_avatar(get_the_author_meta("user_email"), "50");
    $content .= get_the_author_description() .'</p></div>';  
  } 
  return $content;
}
add_filter('thematic_post','wicked_showbio', '70');

// custom homepage loop
function wicked_indexloop() {
  
  // load the custom options
  global $childoptions;
  foreach ($childoptions as $value) {
    $$value['id'] = get_option($value['id'], $value['std']);
  }
  
  query_posts("posts_per_page=4&cat=" . $wicked_feature_cat);
  $counter = 1;
  if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div id="post-<?php the_ID() ?>" class="<?php thematic_post_class() ?>">
      <?php thematic_postheader();
      if ($counter == 1 && has_post_thumbnail() && !is_paged()) {
        the_post_thumbnail('homepage-thumbnail');
      } ?>
      <div class="entry-content">
        <?php the_excerpt(); ?>
        <a href="<?php the_permalink(); ?>" class="more"><?php echo more_text() ?></a>
        <?php $counter++; ?>
      </div>
    </div><!-- .post -->
  <?php endwhile; else: ?>
    <h2>Eek</h2>
    <p>There are no posts to show!</p>
  <?php endif;
  wp_reset_query();
}

// change widget titles to h4s
function wicked_before_title($content) { 
  $content = '<h4 class="widgettitle">'; 
  return $content;
} 
function wicked_after_title($content) {
  $content = '</h4>'; return $content;
} 
add_filter('thematic_before_title', 'wicked_before_title'); 
add_filter('thematic_after_title', 'wicked_after_title');

// remove index insert aside
function wicked_remove_index_insert() {
  unregister_sidebar('index-insert');
}
add_action('init', 'wicked_remove_index_insert', 20);

// add a pullquote shortcode
function pull_quote_sc($atts, $content = null) {
  extract(shortcode_atts(array(
          'width' => '600',
          'author' => '',
          ), $atts));
  if (!$author == '') {
    $authorname = '<cite><em>' . esc_attr($author) . '</em></cite>';
  } else {
    $authorname = null;
  }
  return '<blockquote class="pull-quote" style="width=' . esc_attr($width) . '">
    <p>' . $content . '</p>' . $authorname . '</blockquote>';
}
add_shortcode("pullquote", "pull_quote_sc");

// include custom widget areas
include('library/widget-areas.php');

// include theme options
include('library/options.php');
// include style options stylesheets
include('library/style-options.php');

?>