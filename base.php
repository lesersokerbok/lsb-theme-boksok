<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php wp_title('|', true, 'right'); ?></title>

  <?php wp_head(); ?>

  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo esc_url(get_feed_link()); ?>">
</head>

<body <?php body_class(); ?>>

  <?php
    do_action('get_header');
    get_template_part('templates/site-header');
  ?>
        
  <main class="main" role="main">
    <?php include roots_template_path(); ?>
  </main><!-- /.main -->
  <?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav text-xs-center">
    <?php roots_pagination(); ?>
  </nav>
  <?php endif; ?>

  <?php get_template_part('templates/site-footer'); ?>

  <?php wp_footer(); ?>

</body>
</html>
