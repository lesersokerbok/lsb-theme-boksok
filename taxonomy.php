 <div class="block block-lsb-search">
  <div class="container">
      <div class="row app-align-center">
        <div class="col-sm-12 col-md-8 col-md-offset-2">
          <form>
            <div class="input-group input-group-lg">
              <input type="text" class="form-control" placeholder="Søk etter tittel, forfatter, tema ...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Søk</button>
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php if(!is_paged()) : ?>
  <?php get_template_part('templates/page-sections'); ?>
<? endif; ?>

<?php if ( have_posts() ): ?>
  <section class="loop">
    <?php if( !is_paged() && have_rows('lsb_page_sections', get_queried_object()) ) : ?>
    <div class="page-section-header">
      <h1>
        <?php esc_html_e( 'Arkiv', 'lsb' ); ?> <small> | <?php echo roots_title(); ?></small>
      </h1>
    </div>
    <?php endif; ?>
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/content-summary', get_post_type()); ?>
    <?php endwhile; ?>
  </section>
<?php endif; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <?php roots_pagination(); ?>
  </nav>
<?php endif; ?>
