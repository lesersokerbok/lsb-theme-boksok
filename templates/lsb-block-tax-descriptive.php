<?php 

$block_tax_term = $lsb_block_args['block_tax_term'];

?>

<div class="block block-lsb-cat lsb-cat-<?php echo $block_tax_term->slug ?>">
  <div class="container">
    <div class="row app-align-center">

      <div class="col-sm-5 lsb-col-move-up hidden-xs">
          <?php
            $lsb_partials_args = [
              'cover_grid_tax_term' => $block_tax_term
            ];
            include(locate_template('templates/partials/cover-grid.php')); 
          ?>
      </div>

      <div class="col-sm-1 hidden-xs">
      </div>

      <div class="col-sm-6">
        <h1 class="lsb-heading-small"><a href="<?= get_term_link($block_tax_term) ?>"><?php echo $block_tax_term->name ?></a></h1>
        <div class="block-lsb-description">
          <?php if( !empty(get_field('lsb_acf_tax_full_description', $block_tax_term)) ) : ?>
            <?= get_field('lsb_acf_tax_full_description', $block_tax_term ); ?>
          <?php else : ?>
            <p><?= $block_tax_term->description ?></p>
          <?php endif; ?>

          <a href="<?= get_term_link($block_tax_term) ?>" class="btn btn-lg m-t-md">
            Velg <strong><?php echo $block_tax_term->name ?></strong>
          </a>
        </div>
      </div>
    </div>

  </div>
</div>