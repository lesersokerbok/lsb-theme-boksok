<?php 

$block_tax_term = $lsb_block_args['block_tax_term'];

?>

<div class="block block-lsb-cat lsb-cat-<?php echo $block_tax_term->slug ?>">
  <div class="container">
    <div class="row lsb-sm-row-valign-stretch">

      <div class="col-sm-5 lsb-col-move-up">
          <?php
            $lsb_partials_args = [
              'tax_term' => $block_tax_term
            ];
            include(locate_template('templates/partials/cover-grid.php')); 
          ?>
      </div>

      <div class="col-sm-1 hidden-xs">
      </div>

      <div class="col-sm-6">
        <h1 class="lsb-heading-small"><a href="<?= get_term_link($block_tax_term) ?>"><?php echo $block_tax_term->name ?></a></h1>
        <div class="lsb-cat-description">
          <?php if( !empty(get_field('lsb_acf_tax_full_description', $block_tax_term)) ) : ?>
            <?= get_field('lsb_acf_tax_full_description', $block_tax_term ); ?>
          <?php else : ?>
            <p><?= $block_tax_term->description ?></p>
          <?php endif; ?>

          <?php if( is_tax('lsb_tax_lsb_cat') && get_query_var( 'paged', 0 ) == 0) : ?>
            <a href="<?= get_term_link($block_tax_term) ?>side/2" class="btn btn-lg btn-spacious m-t-md">
              <?php _e('Bla gjennom', 'lsb-boksok') ?> <strong><?php echo $block_tax_term->name ?></strong>
            </a>
          <?php else : ?>
            <a href="<?= get_term_link($block_tax_term) ?>" class="btn btn-lg btn-spacious m-t-md">
              <?php _e('Velg', 'lsb-boksok') ?> <strong><?php echo $block_tax_term->name ?></strong>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>

  </div>
</div>
