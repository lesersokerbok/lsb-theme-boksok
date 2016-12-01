<?php if( have_rows('lsb_page_sections', get_queried_object()) ) : ?>
  <?php get_template_part('templates/page-sections/loop' ); ?>
<?php endif; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav text-xs-center">
    <?php roots_pagination(); ?>
  </nav>
<?php endif; ?>
