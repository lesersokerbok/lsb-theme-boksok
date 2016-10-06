<?php 

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


// Adding lsb_cat_filtering when selecting a lsb_category

add_filter('query_vars', 'lsb_add_lsb_cat_filter' ); 
add_filter('body_class', 'lsb_append_lsb_cat_filter', 10 );
add_filter('term_link', 'lsb_append_lsb_cat_filter', 10 );
add_filter('post_type_link', 'lsb_append_lsb_cat_filter', 10 );

function lsb_add_lsb_cat_filter( $public_query_vars ) {
	$public_query_vars[] = 'filter';
	return $public_query_vars;
}

function lsb_append_lsb_cat_filter( $object ) {
	$lsb_cat_filter = get_query_var( 'filter', 'none' ); 

	if( is_tax('lsb_tax_lsb_cat') ) {
		$taxonomy = get_queried_object();
		$lsb_cat_filter = $taxonomy->slug;
	}

	if(is_array($object)) {
		$object[] = 'filter-' . $lsb_cat_filter;
	} else if(is_string($object) && $lsb_cat_filter !== 'none') {
		$object = add_query_arg( array('filter' => $lsb_cat_filter), $object );
	}

	return $object;
}