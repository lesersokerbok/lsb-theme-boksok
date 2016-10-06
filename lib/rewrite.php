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
 * Removes category base.
 *
 * @return void
 */
function remove_lsb_cat_url_permastruct() {
	global $wp_rewrite, $wp_version;
  $wp_rewrite->extra_permastructs['lsb_tax_lsb_cat']['struct'] = '%lsb_tax_lsb_cat%';
}

/**
 * Adds our custom category rewrite rules.
 *
 * @param  array $category_rewrite Category rewrite rules.
 *
 * @return array
 */
function remove_base_lsb_cat_url_rewrite_rules( $lsb_cat_rewrite ) {
	global $wp_rewrite;
  $taxonomy = get_taxonomy('lsb_tax_lsb_cat');
  $tax_name = $taxonomy->name;
	$lsb_cat_rewrite = array();
	$lsb_cat_terms = get_terms( array( 'taxonomy' => $tax_name, 'hide_empty' => false ) );

	foreach ( $lsb_cat_terms as $term ) {
		$term_slug = $term->slug;
	
		$lsb_cat_rewrite[ '(' . $term_slug . ')/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$' ] = 'index.php?' . $tax_name . '=$matches[1]&feed=$matches[2]';
		$lsb_cat_rewrite[ '(' . $term_slug . ')/page/?([0-9]{1,})/?$' ] = 'index.php?' . $tax_name . '=$matches[1]&paged=$matches[2]';
		$lsb_cat_rewrite[ '(' . $term_slug . ')/?$' ] = 'index.php?' . $tax_name . '=$matches[1]';
	}

	// Redirect support from Old Tax Base
	$old_lsb_cat_base = $taxonomy->rewrite['slug'];
  var_dump($old_lsb_cat_base);
	$old_lsb_cat_base = trim( $old_lsb_cat_base, '/' );
	$lsb_cat_rewrite[ $old_lsb_cat_base . '/(.*)$' ] = 'index.php?lsb_cat_redirect=$matches[1]';

	return $lsb_cat_rewrite;
}

function remove_base_lsb_cat_url_query_vars( $public_query_vars ) {
	$public_query_vars[] = 'lsb_cat_redirect';

	return $public_query_vars;
}

/**
 * Handles category redirects.
 *
 * @param $query_vars Current query vars.
 *
 * @return array $query_vars, or void if category_redirect is present.
 */
function remove_base_lsb_cat_url_request( $query_vars ) {
	if ( isset( $query_vars['lsb_cat_redirect'] ) ) {
		$catlink = trailingslashit( get_option( 'home' ) ) . user_trailingslashit( $query_vars['lsb_cat_redirect'], 'lsb_tax_lsb_cat' );
		status_header( 301 );
		header( "Location: $catlink" );
		exit;
	}

	return $query_vars;
}