<?php

  $terms = [];
  $filters = get_sub_field('lsb_acf_tax_block_buttons_filters');

  foreach($filters as $filter) {
    $terms = array_merge($terms, $filter[$filter['acf_fc_layout'] . '_terms']);
  }

?>

<div class="lsb-button-collection">
  <div class="lsb-button-collection-header text-sm-center">
    <h1 class="lsb-heading-small m-t-0"><?= get_sub_field('lsb_tax_block_title') ?></h1>
  </div>
  <?php foreach( $terms as $term ) : ?>
    <?= make_term_button($term) ?>
  <? endforeach ?>
</div>
