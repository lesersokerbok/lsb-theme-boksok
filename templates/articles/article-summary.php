<article <?php post_class('m-y-lg'); ?>>

  <h1 class="lsb-heading"><a href="<?= the_permalink() ?>"><?= the_title() ?></a></h1>

  <?php the_post_thumbnail('featured-thumb', ['class' => 'm-y']); ?>

  <div class="lsb-description">
    <?php the_content(); ?>
  </div>

</article>
