<div class="container">
  <header class="lsb-header text-sm-center m-b-lg">
    <h1 class="lsb-heading"><?= lsb_page_title() ?></h1>
    <hr>
  </header>

  <div class="lsb-book-collection">
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/content-summary', get_post_type()); ?>
    <?php endwhile; ?>
  </div>
  <?php if ($wp_query->max_num_pages > 1) : ?>
    <nav class="post-nav text-xs-center">
      <?php roots_pagination(); ?>
    </nav>
  <?php endif; ?>
</div>
