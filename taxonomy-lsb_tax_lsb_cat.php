 <div class="block block-lsb-search">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-8 col-md-offset-2">
        <?php get_search_form() ?>
      </div>
    </div>
  </div>
</div>

<?php
  
  $blocks = get_field('lsb_blocks', get_queried_object());
  
  for($i = 0; $i < count($blocks); $i+=2) :
    $section_blocks = [ $blocks[$i], $blocks[$i+1] ];
    
    foreach ( $section_blocks as $key => &$section_block ) {
      $section_block['col_count'] = (($i+$key) % 4 == 0 || ($i+$key) % 4 == 3) ? '5' : '6';
      $section_block['template'] = ($section_block['acf_fc_layout'] == 'lsb_tax_block_books') ? 'cover-grid' : 'buttons';
      $section_block['title'] = $section_block['lsb_tax_block_title'];

      $section_block_terms = [];

      foreach($section_block['lsb_tax_block_filters'] as $block_filter) {
        $section_block_terms = array_merge($section_block_terms, $block_filter[$block_filter['acf_fc_layout'] . '_terms']);
      }
      
      if( $section_block['template'] == 'cover-grid' ) {
        $section_block['cover_grid_tax_term'] = $section_block_terms[0];
        $section_block['classes'] = 'lsb-col-move-up';
      } else if ($section_block['template'] == 'buttons') {
        $section_block['button_terms'] = $section_block_terms;
        $section_block['classes'] = 'lsb-col-center';
      }
    }

    if( $section_blocks[0]['classes'] == 'lsb-col-move-up' && $section_blocks[1]['classes'] == 'lsb-col-move-up' ) {
      $section_blocks[0]['classes'] = (($i+0) % 4 == 0 || ($i+0) % 4 == 3) ? 'lsb-col-move-up' : '';
      $section_blocks[1]['classes'] = (($i+1) % 4 == 0 || ($i+1) % 4 == 3) ? 'lsb-col-move-up' : '';
    }
?>

<div class="block block-lsb-cat">
  <div class="container">
    <div class="row lsb-sm-row-valign-stretch">
      <div class="col-sm-<?= $section_blocks[0]['col_count'] ?> <?= $section_blocks[0]['classes']; ?>">
        <?php
          $lsb_partials_args = $section_blocks[0];
          include(locate_template('templates/partials/' . $section_blocks[0]['template'] .'.php')); 
        ?>
      </div>

      <div class="col-sm-1 hidden-xs">
      </div>

      <div class="col-sm-<?= $section_blocks[1]['col_count'] ?> <?= $section_blocks[1]['classes']; ?>">
        <?php
          $lsb_partials_args = $section_blocks[1];
          include(locate_template('templates/partials/' . $section_blocks[1]['template'] .'.php')); 
        ?>
      </div>
    </div>

  </div>
</div>

<?
  endfor;
?>