<div class="block block-lsb-header">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 lsb-col-center text-xs-center">
        <h1 class="lsb-heading"><?= roots_title() ?></h1>
      </div>
    </div>
  </div>
</div>

<div class="block block-lsb-books">
  <div class="container">
    <div class="row">
      <?php while (have_posts()) : the_post(); ?>
        <div class="col-md-8 col-md-offset-2">
          <?php get_template_part('templates/content-summary', get_post_type()); ?>
        </div>
      <?php endwhile; ?>
    </div>
    <?php if ($wp_query->max_num_pages > 1) : ?>
      <nav class="post-nav text-xs-center">
        <?php roots_pagination(); ?>
      </nav>
    <?php endif; ?>
  </div>
</div>