 <? 
  $tax_term = get_queried_object();
  $tax_term_children_ids = get_term_children( $tax_term->term_id, $tax_term->taxonomy );
  $tax_term_childen = [];
  foreach($tax_term_children_ids as $id) {
    $tax_term_childen[] = get_term_by('id', $id, $tax_term->taxonomy);
  }

  $tax_description = '';

  if( !empty( get_field('lsb_acf_tax_full_description', $tax_term) ) ) {
    $tax_description = get_field('lsb_acf_tax_full_description', $tax_term);
  } else if ($tax_term->description) {
    $tax_description = '<p>' . $tax_term->description . '</p>';
  }

 ?>

<div class="block block-lsb-header">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 lsb-col-center lsb-tax-header">
        <h1 class="block-lsb-heading"><?= $tax_term->name ?></h1>
      </div>
    </div>
  </div>
</div>

<div class="block block-lsb-books">
  <div class="container">
    <div class="row">
      <?php if( $tax_description || $tax_term_childen ) : ?>
      <div class="col-md-6 lsb-col-center">
        <div class="lsb-tax-description">
          <?php
            $lsb_block_part_args = [
              'title' => $tax_term->name,
              'description' => $tax_description,
              'button_terms' => $tax_term_childen
            ];
            include(locate_template('templates/block-parts/buttons.php')); 
          ?>
        </div>
      </div>
      <?php endif ?>
      <?php  $i = 0; while (have_posts()) : the_post(); ?>
        <div class="col-md-6 <?= ( ($tax_description || $tax_term_childen) && $i == 0 ) ? 'lsb-col-center' : '' ?>">
          <?php
            include(locate_template('templates/block-parts/book.php'));
          ?> 
        </div>
      <?php $i++; endwhile; ?>
    </div>
  </div>
</div>

