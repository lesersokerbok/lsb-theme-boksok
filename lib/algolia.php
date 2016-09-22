<?php

function mb_blacklist_custom_post_type( array $blacklist ) {
  
    // ACF
    $blacklist[] = 'acf-field-group';
    $blacklist[] = 'acf-field';

    return $blacklist;
}

add_filter( 'algolia_post_types_blacklist', 'mb_blacklist_custom_post_type' );