<?php if( have_rows('lsb_blocks', get_queried_object()) ) : ?>
  <?php while( have_rows('lsb_blocks', get_queried_object()) ) : the_row(); ?>
  <section class="lsb-page-row">
    <div class="container">
      <?php if('lsb_tax_block_books' === get_sub_field('acf_fc_layout')) : ?>
		    <?php get_template_part('templates/components/book-collection' ); ?>
      <?php elseif('lsb_tax_block_buttons' === get_sub_field('acf_fc_layout')) : ?>
		    <?php get_template_part('templates/components/button-collection' ); ?>
      <?php endif; ?>
    </div>
  </section>
  <?php endwhile; ?>
<?php endif; ?>
