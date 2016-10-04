<?php

function make_tags($terms, $args) {
  if(empty($terms)) {
    return;
  }

  $tags = [];

  if(!empty($args['label'])) {
    $tags[] = '<span class="lsb-tag lsb-tag-label">' . $args['label'] . '</span>';
  }

  foreach ( $terms as $term ) {
    $link = get_term_link( $term, $term->taxonomy );
    $tag = '<span class="lsb-tag ' . $args['tag_class'] . '">';
    if($term->taxonomy == 'lsb_tax_author' || $term->taxonomy == 'lsb_tax_illustrator' || $term->taxonomy == 'lsb_tax_translator') {
      $tag .= '<span class="icon icon-user"></span>';
    }
    $tag .= '<a href="' . esc_url( $link ) . '">' . $term->name . '</a>';
    $tag .= '</span>';
    $tags[] = $tag;
  }

  return '<span class="' . $args['container_class'] . '">' . join( ' ', $tags ) . '</span>' . $args['after'];
} 

function get_lsb_book_creators($book) {
  $terms = [];
  if(get_the_terms($book, 'lsb_tax_author')) {
    $terms = array_merge($terms, get_the_terms($book, 'lsb_tax_author'));
  }
  if(get_the_terms($book, 'lsb_tax_illustrator')) {
    $terms = array_merge($terms, get_the_terms($book, 'lsb_tax_illustrator'));
  }
  if(get_the_terms($book, 'lsb_tax_translator')) {
    $terms = array_merge($terms, get_the_terms($book, 'lsb_tax_translator'));
  }
  return $terms;
}

function get_lsb_book_topics($book) {
  $terms = [];
  if(get_the_terms($book, 'lsb_tax_topic')) {
    $terms = array_merge($terms, get_the_terms($book, 'lsb_tax_topic'));
  }
  return $terms;
}

function get_lsb_book_part_of($book) {
  $terms = [];
  if(get_the_terms($book, 'lsb_tax_series')) {
    $terms = array_merge($terms, get_the_terms($book, 'lsb_tax_serie'));
  }
  if(get_the_terms($book, 'lsb_tax_list')) {
    $terms = array_merge($terms, get_the_terms($book, 'lsb_tax_list'));
  }
  return $terms;
}

function get_lsb_book_audience($book) {
  $terms = [];
  if(get_the_terms($book, 'lsb_tax_age')) {
    $terms = array_merge($terms, get_the_terms($book, 'lsb_tax_age'));
  }
  if(get_the_terms($book, 'lsb_tax_audience')) {
    $terms = array_merge($terms, get_the_terms($book, 'lsb_tax_audience'));
  }
  return $terms;
}

function get_the_lsb_book_thumbnail_url() {
  $book_thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( $book->ID ), "thumbnail" );
  return $book_thumbnail_data[0];
}

function get_the_lsb_book_thumbnail($book) {
  $book_thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( $book->ID ), "thumbnail" );
  $book_thumbnail_url = $book_thumbnail_data[0];
  $book_tumbnail_dimension = ( $book_thumbnail_data[1] > $book_thumbnail_data[2] ) ? 'landscape' : 'portrait';
  return get_the_post_thumbnail($book, 'thumbnail', ['class' => $book_tumbnail_dimension]);
}

function get_the_lsb_book_cover($book) {
  $book_thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( $book->ID ), 'large');
  $book_thumbnail_url = $book_thumbnail_data[0];
  $book_tumbnail_dimension = ( $book_thumbnail_data[1] > $book_thumbnail_data[2] ) ? 'landscape' : 'portrait';
  return get_the_post_thumbnail($book, 'large', ['class' => $book_tumbnail_dimension]);
}

function has_lsb_book_review($book) {
  return !empty( get_the_lsb_book_review($book) );
} 

function get_the_lsb_book_review($book) {
  return get_field('lsb_review', $book);
}

function has_lsb_book_quote($book) {
  return !empty( get_the_lsb_book_quote($book) );
} 

function get_the_lsb_book_quote($book) {
  return get_field('lsb_quote', $book);
}