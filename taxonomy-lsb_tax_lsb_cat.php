<?php if( have_rows('lsb_page_sections', get_queried_object()) ) : ?>
  <?php get_template_part('templates/page-sections/loop' ); ?>
<?php endif; ?>
