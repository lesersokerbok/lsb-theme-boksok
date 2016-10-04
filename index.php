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
      <?php if( has_intro() ) : ?>
      <div class="col-md-6 lsb-col-center">
        <div class="lsb-tax-description">
          <?php 
            $lsb_partials_args = [
              'title' => roots_title(),
              'description' => get_intro_text(),
              'button_terms' => get_intro_choices()
            ];
            include(locate_template('templates/partials/buttons.php')); 
          ?>
        </div>
      </div>
      <?php endif; ?>
      <?php  $i = 0; while (have_posts()) : the_post(); ?>
        <div class="col-md-6 <?= ( ($tax_description || $tax_term_childen) && $i == 0 ) ? 'lsb-col-center' : '' ?>">
          <?php get_template_part('templates/content-summary', get_post_type()); ?>
        </div>
      <?php $i++; endwhile; ?>
    </div>
    <?php if ($wp_query->max_num_pages > 1) : ?>
      <nav class="post-nav text-xs-center">
        <?php roots_pagination(); ?>
      </nav>
    <?php endif; ?>
  </div>
</div>