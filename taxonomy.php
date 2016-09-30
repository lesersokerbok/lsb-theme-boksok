 <div class="block block-lsb-search">
  <div class="container">
    <div class="row app-align-center">
      <div class="col-sm-12 col-md-8 col-md-offset-2">
        <form>
          <div class="input-group input-group-lg">
            <input type="text" class="form-control" placeholder="Søk etter tittel, forfatter, tema ...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Søk</button>
            </span>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php if(!is_paged()) : ?>
  <?php get_template_part('templates/page-sections'); ?>
<? endif; ?>

<?php 

  if(is_tax( 'lsb_tax_lsb_cat')) {
    $lsb_cat = get_queried_object();
    include(locate_template('templates/lsb-block-tax-descriptive.php'));
  }
?>

  
