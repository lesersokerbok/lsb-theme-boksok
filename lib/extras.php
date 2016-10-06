<?php

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

if(!function_exists('_log')) {
  function _log( $message ) {
    if( WP_DEBUG === true ){
      if( is_array( $message ) || is_object( $message ) ){
        error_log( print_r( $message, true ) );
      } else {
        error_log( $message );
      }
    }
  }
}
