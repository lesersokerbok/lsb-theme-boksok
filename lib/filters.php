<?php 

function capitalize_title( $term_title ) {
  return ucfirst($term_title);
}
add_filter ( 'single_term_title', 'capitalize_title', 0 );

function use_taxonomy_template( $template ) {
  global $wp_query;
	
	if ( is_tax( 'lsb_tax_lsb_cat' ) && $wp_query->query['paged'] > 1 ) {
		$new_template = locate_template( array( 'index.php' ) );
		if ( '' != $new_template ) {
			return $new_template ;
		}
	}

	return $template;
}

add_filter( 'template_include', 'use_taxonomy_template', 99 );