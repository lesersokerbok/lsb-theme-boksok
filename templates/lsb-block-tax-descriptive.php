<div class="block block-lsb-cat lsb-cat-<?php echo $lsb_cat->slug ?>">
  <div class="container">
    <div class="row app-align-center">

      <div class="col-sm-5 lsb-col-move-up hidden-xs">
          <?php
            $lsb_block_part_args = [
              'cover_grid_tax_term' => $lsb_cat
            ];
            include(locate_template('templates/block-parts/cover-grid.php')); 
          ?>
      </div>

      <div class="col-sm-1 hidden-xs">
      </div>

      <div class="col-sm-6">
        <h1 class="block-lsb-heading"><a href="<?php echo $lsb_cat->url ?>"><?php echo $lsb_cat->name ?></a></h1>
        <div href="#" class="block-lsb-description">
          <?php if( !empty(get_field('lsb_acf_tax_full_description', $lsb_cat)) ) : ?>
            <?php echo get_field('lsb_acf_tax_full_description', $lsb_cat ); ?>
          <?php else : ?>
            <p><?php echo $lsb_cat->description ?></p>
          <?php endif; ?>

          <a href="<?php echo $lsb_cat->url ?>" class="btn btn-lg m-t-md">
            Velg <strong><?php echo $lsb_cat->name ?></strong>
          </a>
        </div>
      </div>
    </div>

  </div>
</div>