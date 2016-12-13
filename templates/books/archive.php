<?php if(!term_description() || is_paged()): ?>
<header class="lsb-header text-sm-center m-b-lg">
  <h1 class="lsb-heading"><?= lsb_page_title() ?></h1>
  <hr>
</header>
<?php endif; ?>

<div class="lsb-book-collection">
  <?php if(term_description() && !is_paged()): ?>
  <aside class="lsb-book-collection-intro">
    <header class="lsb-header">
      <h1 class="lsb-heading"><?= lsb_page_title() ?></h1>
      <hr>
    </header>
    <?= term_description() ?>
  </aside>
  <?php endif; ?>
  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/books/summary'); ?>
  <?php endwhile; ?>
</div>
