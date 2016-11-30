<?php

  // At present only one taxonomy and one term is allowed
  $filter = get_sub_field('lsb_acf_tax_block_books_filters')[0];
  $taxonomy_name = $filter['acf_fc_layout'];
  $taxonomy_term = $filter[$taxonomy_name . '_terms'][0];

  $args = array(
    'posts_per_page' => 6,
    'post_type' => 'lsb_book',
    'orderby' => 'date',
    'order' => 'DESC', // Newest books
    'tax_query' => [
      [
        'taxonomy' => $taxonomy_term->taxonomy,
        'field' => 'term_id',
        'terms' => $taxonomy_term->term_id,
      ]
    ]
  );

  $books = new WP_Query($args);
?>

<div class="lsb-block-header text-sm-center">
  <h1 class="lsb-heading m-t-0"><?= get_sub_field('lsb_tax_block_title') ?></h1>
  <hr>
</div>
<div class="lsb-book-collection">
  <?php while ( $books->have_posts() ) : $books->the_post(); ?>
    <?php get_template_part('templates/content-summary', 'lsb_book'); ?>
  <?php endwhile; ?>
</div>
