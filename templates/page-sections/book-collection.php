<?php

  $terms = [];
  $filters = [];

  if(get_sub_field('lsb_page_section_filters')) {
    $filters = get_sub_field('lsb_page_section_filters');
  }

  foreach($filters as $filter) {
    $new_terms = $filter[$filter['acf_fc_layout'] . '_terms'];
    if($new_terms) {
      $terms = array_merge($terms, $new_terms);
    }
  }

  $tax_query = [];

  if(count($terms) > 0) {
    $tax_query[] = [
        'taxonomy' => $terms[0]->taxonomy,
        'field' => 'term_id',
        'terms' => $terms[0]->term_id,
      ];
  }

  $args = array(
    'posts_per_page' => 6,
    'post_type' => 'lsb_book',
    'orderby' => 'date',
    'order' => 'DESC', // Newest books
    'tax_query' => $tax_query
  );

  $books = new WP_Query($args);
?>

<header class="lsb-page-section-header">
  <h1 class="lsb-heading-medium"><?= get_sub_field('lsb_page_section_title') ?></h1>
  <hr>
</header>

<div class="lsb-book-collection lsb-book-collection-single-row">
  <?php while ( $books->have_posts() ) : $books->the_post(); ?>
    <?php get_template_part('templates/books/summary'); ?>
  <?php endwhile; ?>
</div>


<p class="lsb-book-collection-nav text-xs-center m-t-md m-b-0">
  <?php if(count($terms) > 0) : ?>
  <a href="<?= get_term_link($terms[0]) ?>">
    <?php _e('Gå til alle bøker i ', 'lsb_boksok') ?> <strong><?= get_term_name($terms[0]) ?></strong>
  </a>
  <?php elseif( is_archive() ) : ?>
    <?= get_next_posts_link(sprintf(__('Gå til alle bøker i <strong>%s</strong>', 'lsb_boksok'),lsb_page_title() )); ?>
  <?php else : ?>
    <a href="<?= get_post_type_archive_link( 'lsb_book' ); ?>">
      <?php _e('Gå til alle bøker i ', 'lsb_boksok') ?> <strong><?= get_bloginfo() ?></strong>
    </a>
  <?php endif; ?>
</p>
