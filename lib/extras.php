<?php

function lsb_wp_title($title) {
  if (is_feed()) {
    return $title;
  }  
  $title .= get_bloginfo('name');
  return $title;
}
add_filter('wp_title', 'lsb_wp_title', 10);

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

function is_element_empty($element) {
  $element = trim($element);
  return !empty($element);
}

function lsb_capitalize_title( $term_title ) {
  return ucfirst($term_title);
}
add_filter ( 'single_term_title', 'lsb_capitalize_title', 0 );

function lsb_taxonomy_template( $template ) {
  global $wp_query;
	$paged = get_query_var( 'paged', 1 ); 
	
	if ( is_tax( 'lsb_tax_lsb_cat' ) && $paged > 1 ) {
		$new_template = locate_template( array( 'index.php' ) );
		if ( '' != $new_template ) {
			return $new_template ;
		}
	}

	return $template;
}
add_filter( 'template_include', 'lsb_taxonomy_template', 99 );

