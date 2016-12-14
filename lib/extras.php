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

function lsb_excerpt($excerpt) {
  if( empty(trim($excerpt)) ) {
    if( get_post_type() == 'lsb_book') {
      global $post;
      $excerpt = wp_strip_all_tags( get_the_lsb_book_review($post), true );
      return wp_trim_words($excerpt, 40);
    }
  }
  return $excerpt; 
}
add_filter( 'get_the_excerpt', 'lsb_excerpt' );

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
	
	if ( is_tax( 'lsb_tax_lsb_cat' ) && !is_search() &&
      ( !get_field('lsb_page_sections', get_queried_object()) || count(get_field('lsb_page_sections', get_queried_object())) == 0 || $paged > 1 ) ) {

		$new_template = locate_template( array( 'index.php' ) );
		if ( '' != $new_template ) {
			return $new_template ;
		}
	}

	return $template;
}
add_filter( 'template_include', 'lsb_taxonomy_template', 99 );

function lsb_taxonomy_offset(&$query) {

  //Before anything else, make sure this is the right query...
  if ( ! $query->is_tax('lsb_tax_lsb_cat') || !get_field('lsb_page_sections', get_queried_object()) || count(get_field('lsb_page_sections', get_queried_object())) == 0 ) {
    return;
  }

  $ppp = get_option('posts_per_page');

  //Next, detect and handle pagination...
  if ( $query->is_paged ) {

    $page_offset = ($query->query_vars['paged']-2) * $ppp;

    //Apply adjust page offset
    $query->set('offset', $page_offset );

  } else {
    $query->set( 'posts_per_page', 3 );
  }
}
add_action('pre_get_posts', 'lsb_taxonomy_offset', 1 );

function lsb_taxonomy_offset_pagination($found_posts, $query) {

    //Before anything else, make sure this is the right query...
    if ( ! $query->is_tax('lsb_tax_lsb_cat') || !get_field('lsb_page_sections', get_queried_object()) || count(get_field('lsb_page_sections', get_queried_object())) == 0 ) {
      return $found_posts;
    }

    $ppp = get_option('posts_per_page');
    return $found_posts + $ppp;
}
add_filter('found_posts', 'lsb_taxonomy_offset_pagination', 1, 2 );

