<!doctype html>
<html <?php language_attributes(); ?>>

<?php get_template_part('templates/head'); ?>

<body <?php body_class(); ?>>
  <?php get_template_part('templates/site-shelf'); ?>
  <div class="stage" id="stage">

    <?php
      do_action('get_header');
      get_template_part('templates/site-header');
    ?>
        
    <main class="main" role="main">
      <?php include roots_template_path(); ?>
    </main><!-- /.main -->

    <aside>

      <?php 
        if(get_lsb_cat_filter() !== 'none') {
          $lsb_block_args = [
            'block_tax_term' => get_lsb_cat_filter_term()
          ];
          include(locate_template('templates/lsb-block-tax-descriptive.php'));
        }
        include(locate_template('templates/boksok-description.php'));
      ?>

    </aside>

    <?php get_template_part('templates/site-footer'); ?>
  </div><!-- /#stage -->

  <?php wp_footer(); ?>

</body>
</html>
