<?php if(!term_description()): ?>
<header class="lsb-header text-sm-center">
  <h1 class="lsb-heading"><?= lsb_page_title() ?></h1>
  <hr>
</header>
<?php endif; ?>

<div class="lsb-book-collection">
  <?php if(term_description()): ?>
  <aside class="lsb-book-collection-intro">
    <header class="lsb-header">
      <h1 class="lsb-heading"><?= lsb_page_title() ?></h1>
      <hr>
    </header>
    <?= term_description() ?>
    <nav class="m-t lsb-pagination">
      <?php previous_posts_link( __("Tilbake", 'lsb_boksok' ) ); ?>
      <?php next_posts_link( __("Neste side med bøker", 'lsb_boksok' ) ); ?>
    </nav>
  </aside>
  <?php endif; ?>
  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/books/summary'); ?>
  <?php endwhile; ?>
</div>

<?php if ($wp_query->max_num_pages > 1) : ?>
<nav class="lsb-pagination text-xs-center m-t-lg">
  <?php previous_posts_link( __("Tilbake", 'lsb_boksok' ) ); ?>
  <?php next_posts_link( __("Neste side med bøker", 'lsb_boksok' ) ); ?>
</nav>
<?php endif; ?>
