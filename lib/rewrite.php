<?php

function lsb_rewrite_bases() {
  $GLOBALS['wp_rewrite']->author_base        = __('skribent', 'lsb');
  $GLOBALS['wp_rewrite']->search_base        = __('sok', 'lsb');
  $GLOBALS['wp_rewrite']->comments_base      = __('kommentarer', 'lsb');
  $GLOBALS['wp_rewrite']->pagination_base    = __('side', 'lsb');
}

/* actions */
add_action( 'init',             'remove_lsb_cat_url_permastruct' );
add_action( 'init',             'lsb_rewrite_bases');

/* filters */
add_filter( 'lsb_tax_lsb_cat_rewrite_rules', 'remove_base_lsb_cat_url_rewrite_rules' );
add_filter( 'query_vars',                    'remove_base_lsb_cat_url_query_vars' );    // Adds 'category_redirect' query variable
add_filter( 'request',                       'remove_base_lsb_cat_url_request' );       // Redirects if 'category_redirect' is set

function remove_category_url_refresh_rules() {
	global $wp_rewrite;
	$wp_rewrite->flush_rules();
}

/**
 * Removes tax base.
 *
 * @return void
 */
function remove_lsb_cat_url_permastruct() {
	global $wp_rewrite, $wp_version;
  $wp_rewrite->extra_permastructs['lsb_tax_lsb_cat']['struct'] = '%lsb_tax_lsb_cat%';
}

/**
 * Adds our custom tax rewrite rules.
 *
 * @param  array $tax_rewrite Category rewrite rules.
 *
 * @return array
 */
function remove_base_lsb_cat_url_rewrite_rules( $tax_rewrite ) {
	global $wp_rewrite;
  $taxonomy = get_taxonomy('lsb_tax_lsb_cat');
  $tax_name = $taxonomy->name;
	$tax_rewrite = array();
	$lsb_cat_terms = get_terms( array( 'taxonomy' => $tax_name, 'hide_empty' => false ) );

	foreach ( $lsb_cat_terms as $term ) {
		$term_slug = $term->slug;
	
		$tax_rewrite[ '(' . $term_slug . ')/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$' ] = 'index.php?' . $tax_name . '=$matches[1]&feed=$matches[2]';
		$tax_rewrite[ '(' . $term_slug . ')/' . $wp_rewrite->pagination_base . '/?([0-9]{1,})/?$' ] = 'index.php?' . $tax_name . '=$matches[1]&paged=$matches[2]';
		$tax_rewrite[ '(' . $term_slug . ')/?$' ] = 'index.php?' . $tax_name . '=$matches[1]';
	}

	// Redirect support from Old Tax Base
	$old_lsb_cat_base = $taxonomy->rewrite['slug'];
  var_dump($old_lsb_cat_base);
	$old_lsb_cat_base = trim( $old_lsb_cat_base, '/' );
	$tax_rewrite[ $old_lsb_cat_base . '/(.*)$' ] = 'index.php?lsb_cat_redirect=$matches[1]';

	return $tax_rewrite;
}

function remove_base_lsb_cat_url_query_vars( $public_query_vars ) {
	$public_query_vars[] = 'lsb_cat_redirect';
  $public_query_vars[] = get_taxonomy('lsb_tax_lsb_cat')->rewrite['slug'];

	return $public_query_vars;
}

/**
 * Handles tax redirects.
 *
 * @param $query_vars Current query vars.
 *
 * @return array $query_vars, or void if lsb_cat_redirect is present.
 */
function remove_base_lsb_cat_url_request( $query_vars ) {
  $taxonomy = get_taxonomy('lsb_tax_lsb_cat');
  
  $redirect_query_vars = array();
  $redirect_query_vars[] = 'lsb_cat_redirect';
  $redirect_query_vars[] = $taxonomy->rewrite['slug'];

  foreach( $redirect_query_vars as $query_var) {
    if ( isset( $query_vars[ $query_var ] ) ) {
		  $redirect_base = trailingslashit( get_option( 'home' ) ) . user_trailingslashit( $query_vars[ $query_var ], $taxonomy->name );
      // Remove redirect query var and add remaining query vars to redirect url
      // This is needed to be in complience with public boksok plugin sending people to "boksok.no/s=sommer&hovedkategori=litt-a-lese
      unset($query_vars[ $query_var ]);
      $redirect_url = add_query_arg( $query_vars, $redirect_base );
		  
      status_header( 301 );
		  header( "Location: $redirect_url" );
		  exit;
	  } 
  }

  return $query_vars;
}