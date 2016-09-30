 <div class="block block-lsb-search">
  <div class="container">
    <div class="row app-align-center">
      <div class="col-sm-12 col-md-8 col-md-offset-2">
        <?php get_search_form() ?>
      </div>
    </div>
  </div>
</div>

<?php if(!is_paged()) : ?>
  <?php get_template_part('templates/page-sections'); ?>
<? endif; ?>

  
