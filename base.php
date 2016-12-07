<!doctype html>
<html <?php language_attributes(); ?>>

<?php get_template_part('templates/head'); ?>

<body <?php body_class(); ?>>

  <?php
    do_action('get_header');
    get_template_part('templates/site-header');
  ?>

  <?php get_template_part('algolia/instantsearch'); ?>
        
  <main class="main" role="main">
    <?php include roots_template_path(); ?>
  </main><!-- /.main -->

  <?php get_template_part('templates/site-footer'); ?>

  <?php wp_footer(); ?>

</body>
</html>
