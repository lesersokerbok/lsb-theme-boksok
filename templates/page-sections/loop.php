<?php while( have_rows('lsb_page_sections', get_queried_object()) ) : the_row(); ?>
<section class="lsb-page-section">
  <div class="container">
    <?php if('lsb_page_section_books' === get_sub_field('acf_fc_layout')) : ?>
      <?php get_template_part('templates/page-sections/book-collection' ); ?>
    <?php elseif('lsb_page_section_buttons' === get_sub_field('acf_fc_layout')) : ?>
      <?php get_template_part('templates/page-sections/button-collection' ); ?>
    <?php endif; ?>
  </div>
</section>
<?php endwhile; ?>
