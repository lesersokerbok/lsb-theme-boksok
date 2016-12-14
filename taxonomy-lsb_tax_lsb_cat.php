<div class="lsb-book-collection">

  <aside class="lsb-book-collection-intro">
    <header class="lsb-header">
      <h1 class="lsb-heading"><?= lsb_page_title() ?></h1>
      <hr>
    </header>
    <?= term_description() ?>
    <?= get_next_posts_link(sprintf(__('Gå til alle bøker i <strong>%s</strong>', 'lsb_boksok'),lsb_page_title() )); ?>
  </aside>

  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/books/summary'); ?>
  <?php endwhile; ?>
</div>

<?php if( have_rows('lsb_page_sections', get_queried_object()) ) : ?>
  <?php get_template_part('templates/page-sections/loop' ); ?>
<?php endif; ?>
