<?php

function get_term_name($term) {
  $make_lowercase = $term->taxonomy !== 'lsb_tax_author'
    && $term->taxonomy !== 'lsb_tax_illustrator'
    && $term->taxonomy !== 'lsb_tax_translator'
    && $term->taxonomy !== 'lsb_tax_publisher';

  if($make_lowercase) {
    return strtolower($term->name);
  } else {
    return $term->name;
  }
}

function make_tags($terms, $args) {

  $defaults = array(
	  'label' => "",
    'container_class' => "lsb-tags"
  );
  $args = wp_parse_args( $args, $defaults );

  if(empty($terms)) {
    return;
  }

  $tags = [];

  if(!empty($args['label'])) {
    $tags[] = '<span class="lsb-tag lsb-tag-label">' . $args['label'] . '</span>';
  }

  foreach ( $terms as $term ) {
    $link = get_term_link( $term, $term->taxonomy );
    $tag = '<span class="lsb-tag">';
    if($term->taxonomy == 'lsb_tax_author' || $term->taxonomy == 'lsb_tax_illustrator' || $term->taxonomy == 'lsb_tax_translator') {
      $tag .= '<span class="icon icon-user"></span>';
    }
    $tag .= '<a href="' . esc_url( $link ) . '">' . get_term_name($term) . '</a>';
    $tag .= '</span>';
    $tags[] = $tag;
  }

  return '<span class="' . $args['container_class'] . '">'  . join( ' ', $tags ) . '</span>';
} 

function make_meta($meta, $args) {

  $defaults = array(
	  'label' => "",
    'container_class' => "lsb-tags"
  );
  $args = wp_parse_args( $args, $defaults );

  if( empty($meta) ) {
    return;
  }

  $tags = [];

  if(!empty($args['label'])) {
    $tags[] = '<span class="lsb-tag lsb-tag-label">' . $args['label'] . '</span>';
  }
  $tags[] = '<span class="lsb-tag">' . $meta . '</span>';

  return '<span class="' . $args['container_class'] . '">' . join( ' ', $tags ) . '</span>';
}

function make_term_button($term) {
  if ( empty($term) ) {
    return;
  }

  $url = get_term_link( $term );
  $name = get_term_name( $term );
  $icon = get_field('lsb_acf_tax_term_icon', $term );
  $style = '';

  if( !empty($icon) ) {
    $bg_url = esc_url($icon['sizes']['medium']);
    $bg_width = $icon['sizes'][ 'medium-width' ];
	  $bg_height = $icon['sizes'][ 'medium-height' ];

    $bg_size = '40px auto';

    if($bg_height > $bg_width) {
      $bg_size = 'auto 40px';
      $bg_width = 40/$bg_height*$bg_width;
      $style = 'background-position: 10px 2px;';
    } else {
      $bg_width = '40';
      $style = 'background-position: 10px center;';
    }

    $style .= 'background-image: url(' . $bg_url . ');';
    $style .= 'background-size: ' . $bg_size . ';';
    $style .= 'padding-left: ' . ($bg_width + 17) . 'px;';
    $style .= 'background-repeat: no-repeat;';

    return '<a class="btn btn-default" style="' . $style . '" href="' . $url . '">' . $name . '</a>';

  } else if($term->taxonomy == 'lsb_tax_author' || $term->taxonomy == 'lsb_tax_illustrator' || $term->taxonomy == 'lsb_tax_translator') {
    return '<a class="btn btn-default" href="' . $url . '"><span class="icon icon-user"></span><span>' . $name . '<span></a>';
  }

  return '<a class="btn btn-default" href="' . $url . '">' . $name . '</a>';

}

function make_term_buttons($terms) {
  if(empty($terms)) {
    return;
  }

  $buttons = [];
  foreach ( $terms as $term ) {
    $buttons[] = make_term_button($term);
  }
  return join( ' ', $buttons );
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
    $terms = array_merge($terms, get_the_terms($book, 'lsb_tax_series'));
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

function get_lsb_book_publishers($book) {
  $terms = [];
  if(get_the_terms($book, 'lsb_tax_publisher')) {
    $terms = array_merge($terms, get_the_terms($book, 'lsb_tax_publisher'));
  }
  return $terms;
}

function get_lsb_book_genres($book) {
  $terms = [];
  if(get_the_terms($book, 'lsb_tax_genre')) {
    $terms = array_merge($terms, get_the_terms($book, 'lsb_tax_genre'));
  }
  return $terms;
}

function get_lsb_book_categories($book) {
  $terms = [];
  if(get_the_terms($book, 'lsb_tax_lsb_cat')) {
    $terms = array_merge($terms, get_the_terms($book, 'lsb_tax_lsb_cat'));
  }
  return $terms;
}

function get_lsb_book_language($book) {
  $terms = [];
  if(get_the_terms($book, 'lsb_tax_language')) {
    $terms = array_merge($terms, get_the_terms($book, 'lsb_tax_language'));
  }
  return $terms;
}

function get_lsb_book_isbn($book) {
  return get_field('lsb_isbn', $book);
}

function get_lsb_book_pages($book) {
  return get_field('lsb_pages', $book);
}

function get_lsb_book_year($book) {
  return get_field('lsb_published_year', $book);
}

function get_the_lsb_book_thumbnail_url() {
  $book_thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( $book->ID ), "thumbnail" );
  return $book_thumbnail_data[0];
}

function get_the_lsb_book_thumbnail($book) {
  $book_thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( $book->ID ), "medium" );
  $book_thumbnail_url = $book_thumbnail_data[0];
  $book_tumbnail_dimension = ( $book_thumbnail_data[1] > $book_thumbnail_data[2] ) ? 'landscape' : 'portrait';
  return get_the_post_thumbnail($book, 'medium', ['class' => $book_tumbnail_dimension]);
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

function has_lsb_book_embeds($book) {
  return have_rows('lsb_oembeds', $book);
}
