<?php
// Allow Featured Images
add_theme_support( 'post-thumbnails' );

// Don't resize Featured Images
function my_thumbnail_size() {
  set_post_thumbnail_size();
}
add_action('after_setup_theme', 'my_thumbnail_size', 11);

// Wrap video embed code in DIV for responsive goodness
add_filter( 'embed_oembed_html', 'my_oembed_filter', 10, 4 ) ;
function my_oembed_filter($html, $url, $attr, $post_ID) {
  $return = '<div class="video">'.$html.'</div>';
  return $return;
}

// Format the index page pagination
function FG_posts_pagination($args = array()) {
  if ($GLOBALS['wp_query']->max_num_pages <= 1) return;
  
  $prev_link = get_previous_posts_link($args['prev_text']);
  $next_link = get_next_posts_link($args['next_text']);
  
  $template  = apply_filters( 'FG_navigation_markup_template', '
  <nav class="navigation" role="navigation">
    <div class="nav-links">%1$s%2$s</div>
  </nav>', $args);

  echo sprintf($template, $prev_link, $next_link);
}
add_filter('previous_posts_link_attributes', 'posts_link_attributes_prev');
add_filter('next_posts_link_attributes', 'posts_link_attributes_next');
function posts_link_attributes_prev() { return 'class="prev"'; }
function posts_link_attributes_next() { return 'class="next"'; }

// Format the single post pagination
function FG_post_pagination($args = array()) {
  $prev_link = get_previous_post_link('%link', $args['prev_text']);
  $next_link = get_next_post_link('%link', $args['next_text']);

  // Only add markup if there's somewhere to navigate to.
  if ( $prev_link || $next ) {
    echo _navigation_markup($prev_link . $next_link, ' ', ' ');
  }
}
add_filter('previous_post_link', 'post_link_attributes_prev');
add_filter('next_post_link', 'post_link_attributes_next');
function post_link_attributes_prev($output) { return str_replace('<a href=', '<a class="prev" href=', $output); }
function post_link_attributes_next($output) { return str_replace('<a href=', '<a class="next" href=', $output); }


// Set length of blog index except
function wpdocs_custom_excerpt_length( $length ) {
  return 300;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

// Break excerpt at sentence end
function end_with_sentence( $excerpt ) {
  $allowed_ends = array('.', '!', '?', '...');
  $number_sentences = 2;
  $excerpt_chunk = $excerpt;

  for($i = 0; $i < $number_sentences; $i++){
    $lowest_sentence_end[$i] = 100000000000000000;
    foreach($allowed_ends as $allowed_end) {
      $sentence_end = strpos( $excerpt_chunk, $allowed_end);
      if ($sentence_end !== false && $sentence_end < $lowest_sentence_end[$i]) {
        $lowest_sentence_end[$i] = $sentence_end + strlen( $allowed_end );
      }
      $sentence_end = false;
    }

    $sentences[$i] = substr( $excerpt_chunk, 0, $lowest_sentence_end[$i]);
    $excerpt_chunk = substr( $excerpt_chunk, $lowest_sentence_end[$i]);
  }

  return implode('', $sentences);
}
add_filter('get_the_excerpt', 'end_with_sentence');
?>