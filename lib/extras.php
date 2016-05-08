<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'mz-community-org') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');


/* As recommended in Roots Discourse, this function is called
 * within div wrap so we can eliminate the container and have
 * full width rows and divs.
*/
function container_class() {
  if ( is_front_page() || 'movies' == get_post_type() ) {
    return 'mdl-grid--no-spacing';
  } else {
    return;
  }
}
//*
