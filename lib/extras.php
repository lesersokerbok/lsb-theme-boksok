<?php
/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more($more) {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
}
add_filter('excerpt_more', 'roots_excerpt_more');

/**
 * Manage output of wp_title()
 */
function roots_wp_title($title) {
  if (is_feed()) {
    return $title;
  }

  $title .= get_bloginfo('name');

  return $title;
}
add_filter('wp_title', 'roots_wp_title', 10);

function has_intro() {
  return get_intro_text() || get_intro_choices();
}

function get_intro_text() {
  if( is_tax() ) {
    $tax_term = get_queried_object();
    $intro = get_field('lsb_acf_tax_full_description', $tax_term);
    if( !$intro && $tax_term->description ) {
      $intro = '<p>' . $tax_term->description . '</p>';
    }
    return $intro; 
  } 
}

function get_intro_choices() {
  if( is_tax() ) {
    $tax_term = get_queried_object();
    $tax_term_children_ids = get_term_children( $tax_term->term_id, $tax_term->taxonomy );
    $tax_term_childen = [];
    foreach($tax_term_children_ids as $id) {
      $tax_term_childen[] = get_term_by('id', $id, $tax_term->taxonomy);
    }
    return $tax_term_childen; 
  } 
}
