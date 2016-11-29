<div class="block block-lsb-header">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 lsb-col-center text-xs-center">
        <h1 class="lsb-heading m-t-0"><?= lsb_page_title() ?></h1>
        <hr>
      </div>
    </div>
  </div>
</div>

<div class="block block-lsb-books">
  <div class="container">
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
</div>
