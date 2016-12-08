<div class="container">
  <header class="lsb-header text-sm-center m-b-lg">
    <h1 class="lsb-heading"><?= lsb_page_title() ?></h1>
    <hr>
  </header>

  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/articles/article-summary'); ?>
  <?php endwhile; ?>
</div>
