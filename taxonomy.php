 <? 
  $tax_term = get_queried_object();
  $tax_term_children_ids = get_term_children( $tax_term->term_id, $tax_term->taxonomy );
  $tax_term_childen = [];
  foreach($tax_term_children_ids as $id) {
    $tax_term_childen[] = get_term_by('id', $id, $tax_term->taxonomy);
  }
 ?>

<div class="block block-lsb-header">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 lsb-col-center lsb-tax-header">
        <?php
          $lsb_block_part_args = [
            'title' => $tax_term->name,
            'button_terms' => $tax_term_childen
          ];
          include(locate_template('templates/block-parts/buttons.php')); 
        ?>
      </div>
    </div>
  </div>
</div>

<div class="block block-lsb-books">
  <div class="container">
    <div class="row">
      <?php  $i = 0; while (have_posts()) : the_post(); ?>
        <div class="col-md-6">
          <?php
            include(locate_template('templates/block-parts/book.php'));
          ?> 
        </div>
      <?php $i++; endwhile; ?>
    </div>
  </div>
</div>

