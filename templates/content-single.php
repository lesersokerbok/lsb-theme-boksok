<article <?php post_class('full'); ?>>

  <header class="block block-lsb-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <h1 class="lsb-heading">
            <?php echo lsb_page_title(); ?>
          </h1>
        </div>
      </div>
    </div>
  </header>

  <section class="block p-b-md p-t-md">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <?php the_post_thumbnail('featured-thumb', ['class' => 'm-b-md']); ?>
          <div class="lsb-description">
            <?php the_content(); ?>
          </div>
      </div>
    </div>
  </section>

</article>
