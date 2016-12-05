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

?>

<div class="lsb-header text-sm-center">
  <h1 class="lsb-heading-small m-t-0"><?= get_sub_field('lsb_page_section_title') ?></h1>
</div>
<div class="lsb-button-collection">
  <?php foreach( $terms as $term ) : ?>
    <?= make_term_button($term) ?>
  <? endforeach ?>
</div>