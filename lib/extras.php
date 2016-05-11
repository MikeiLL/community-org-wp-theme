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

/**
 * Returns the post type for the queried data on the current page.
 * This is useful for loading template parts for custom post types
 * before entering the loop and outputting those posts.
 *
 * @return string The post type of the queried data for the current page.
 */
function get_post_type_outside_loop() {
	global $wp_query;
	if ( isset( $wp_query->query['post_type'] ) )
		return $wp_query->query['post_type'];
	return '';
}


/**
 * Returns the first 75 words of post content, HTML not counted.
 * We use this so we can have intaractive excerpts.
 *
 * @param type $var $excerpt_word_count Number of words to return.
 * @return string post excerpt including allowed HTML tags.
 * @source: http://wordpress.stackexchange.com/questions/141125/allow-html-in-excerpt
 */

function wpse_allowedtags($excerpt_word_count = 75) {
    // Add custom tags to this string
        return '<script>,<style>,<br>,<em>,<i>,<ul>,<ol>,<li>,<a>,<p>,<img>,<video>,<audio>';
    }

if ( ! function_exists( 'wpse_custom_wp_trim_excerpt' ) ) :

    function wpse_custom_wp_trim_excerpt($wpse_excerpt) {
    $raw_excerpt = $wpse_excerpt;
        if ( '' == $wpse_excerpt ) {

            $wpse_excerpt = get_the_content('');
            $wpse_excerpt = strip_shortcodes( $wpse_excerpt );
            $wpse_excerpt = apply_filters('the_content', $wpse_excerpt);
            $wpse_excerpt = str_replace(']]>', ']]&gt;', $wpse_excerpt);
            $wpse_excerpt = strip_tags($wpse_excerpt, wpse_allowedtags()); /*IF you need to allow just certain tags. Delete if all tags are allowed */

            //Set the excerpt word count and only break after sentence is complete.
                //$excerpt_word_count = 75;
                $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);
                $tokens = array();
                $excerptOutput = '';
                $count = 0;

                // Divide the string into tokens; HTML tags, or words, followed by any whitespace
                preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $wpse_excerpt, $tokens);

                foreach ($tokens[0] as $token) {

                    if ($count >= $excerpt_length && preg_match('/[\,\;\?\.\!]\s*$/uS', $token)) {
                    // Limit reached, continue until , ; ? . or ! occur at the end
                        $excerptOutput .= trim($token);
                        break;
                    }

                    // Add words to complete sentence
                    $count++;

                    // Append what's left of the token
                    $excerptOutput .= $token;
                }

            $wpse_excerpt = trim(force_balance_tags($excerptOutput));

                $excerpt_end = ' <a href="'. esc_url( get_permalink() ) . '">' . '&nbsp;&raquo;&nbsp;' . sprintf(__( 'Read more about: %s &nbsp;&raquo;', 'brnsville' ), get_the_title()) . '</a>';
                $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);

                //$pos = strrpos($wpse_excerpt, '</');
                //if ($pos !== false)
                // Inside last HTML tag
                //$wpse_excerpt = substr_replace($wpse_excerpt, $excerpt_end, $pos, 0); /* Add read more next to last word */
                //else
                // After the content
                $wpse_excerpt .= $excerpt_more; /*Add read more in new paragraph */

            return $wpse_excerpt;

        }
        return apply_filters(__NAMESPACE__ . '\\wpse_custom_wp_trim_excerpt', $wpse_excerpt, $raw_excerpt);
    }

endif;

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', __NAMESPACE__ . '\\wpse_custom_wp_trim_excerpt');
