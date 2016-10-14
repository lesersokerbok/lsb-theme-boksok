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
    $section_blocks = [];
    $section_blocks[] = $blocks[$i];
    
    if(($i+1) < count($blocks)) {
      $section_blocks[] = $blocks[$i+1];
    }

    foreach ( $section_blocks as $key => &$section_block ) {
      $section_block['template'] = ($section_block['acf_fc_layout'] == 'lsb_tax_block_books') ? 'cover-grid' : 'buttons';
      $section_block['title'] = $section_block['lsb_tax_block_title'];

      $section_block_terms = [];

      foreach($section_block['lsb_tax_block_filters'] as $block_filter) {
        $section_block_terms = array_merge($section_block_terms, $block_filter[$block_filter['acf_fc_layout'] . '_terms']);
      }
      
      if( $section_block['template'] == 'cover-grid' ) {
        $section_block['tax_term'] = $section_block_terms[0];
        if( $key % 2 == 0 ) {
          $section_block['classes'] = 'lsb-col-move-up';
        }
      } else if ($section_block['template'] == 'buttons') {
        $section_block['button_terms'] = $section_block_terms;
        $section_block['classes'] = 'lsb-col-center';
      }
    }
?>

<div class="block block-lsb-cat-section">
  <div class="container">
    <div class="row lsb-sm-row-valign-stretch">
      <div class="col-sm-5 <?= $section_blocks[0]['classes'] ?>">
        <?php
          $lsb_partials_args = $section_blocks[0];
          include(locate_template('templates/partials/' . $section_blocks[0]['template'] .'.php')); 
        ?>
      </div>

      <div class="col-sm-1 hidden-xs">
      </div>

      <div class="col-sm-6 <?= $section_blocks[1]['classes'] ?>">
        <?php
          if(isset($section_blocks[1])) {
            $lsb_partials_args = $section_blocks[1];
            include(locate_template('templates/partials/' . $section_blocks[1]['template'] .'.php'));
          } 
        ?>
      </div>
    </div>

  </div>
</div>

<?
  endfor;
?>
