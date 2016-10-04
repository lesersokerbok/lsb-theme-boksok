<?php

  $cover_grid_title = $lsb_partials_args['title'];
  $cover_grid_tax_term = $lsb_partials_args['cover_grid_tax_term'];

  $args = array(
    'posts_per_page' => 6,
    'post_type' => 'lsb_book',
    'orderby' => 'date',
    'order' => 'ASC',
    'tax_query' => [
      [
        'taxonomy' => $cover_grid_tax_term->taxonomy,
        'field' => 'term_id',
        'terms' => $cover_grid_tax_term->term_id,
      ]
    ]
  );

  if( is_tax() ) {
    $lsb_page_taxt_term = get_queried_object();
    $args['tax_query']['relation'] = 'AND';
    $args['tax_query'][] = [
      'taxonomy' => $lsb_page_taxt_term->taxonomy,
      'field' => 'term_id',
      'terms' => $lsb_page_taxt_term->term_id,
    ];
  }

  $books = get_posts($args);

  foreach($books as $book) {
    $image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $book->ID ), "medium" );
    $image_attr = [];
    $image_attr['data-width'] = $image_data[1];
    $image_attr['data-height'] = $image_data[2];
    $book->thumbnail = get_the_post_thumbnail( $book, 'medium', $image_attr );
    $book->permalink = get_permalink( $book->ID );
  }
?>

<?php if( $cover_grid_title ) : ?>
<h1 class="lsb-heading-small"><a href="<?= get_term_link($cover_grid_tax_term) ?>"><?= $cover_grid_title ?></a></h1>
<?php endif ?>
<div class="block-lsb-cover-grid" data-grid="images">
  <?php foreach($books as $book): ?>
    <a href="<?php echo $book->permalink ?>"><?php echo $book->thumbnail ?></a>
  <?php endforeach ?>
</div>