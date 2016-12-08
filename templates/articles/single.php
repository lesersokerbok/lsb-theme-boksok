<?php while (have_posts()) : the_post(); ?>
<article class="<?php post_class('container'); ?>">
  <header class="lsb-header m-b-lg">
    <h1 class="lsb-heading"><?= lsb_page_title() ?></h1>
    <hr>
  </header>

  <?php the_post_thumbnail('featured-thumb', ['class' => 'm-b-md']); ?>
  <div class="lsb-description">
    <?php the_content(); ?>
  </div>
</article>
<?php endwhile; ?>
