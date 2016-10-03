<!doctype html>
<html <?php language_attributes(); ?>>

<?php get_template_part('templates/head'); ?>

<body <?php body_class(); ?>>
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
        if(is_tax( 'lsb_tax_lsb_cat')) {
          $lsb_cat = get_queried_object();
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
