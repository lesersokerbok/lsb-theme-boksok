<?php 

function capitalize_title( $term_title ) {
  return ucfirst($term_title);
}
add_filter ( 'single_term_title', 'capitalize_title', 0 );