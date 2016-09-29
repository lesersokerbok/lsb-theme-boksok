<?php $books = LsbPageSectionsUtil::get_books_for_book_shelf(); ?>

<?php if($books->have_posts()) : ?>

<section class="block block-lsb-book-shelf">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="block-lsb-heading">
          <a href="<?php echo LsbPageSectionsUtil::get_link_for_book_shelf(); ?>"><?php the_sub_field('lsb_page_section_title') ?></a>

          <?php if ( get_sub_field('lsb_page_section_sub_title') ) : ?>
             <a href="<?php echo LsbPageSectionsUtil::get_link_for_book_shelf(); ?>"><span class="subtitle"><?php the_sub_field('lsb_page_section_sub_title'); ?></span></a>
          <?php endif; ?>
          <a href="<?php echo LsbPageSectionsUtil::get_link_for_book_shelf(); ?>" class="pull-right">
            Vis alle
          </a>
        </h1>
        <div class="cover-grid">
        <?php while ( $books->have_posts() ) : $books->the_post(); ?>
          <a href="<?php the_permalink() ?>">
            <?php the_post_thumbnail('medium'); ?>
          </a>
        <?php endwhile; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php wp_reset_query(); ?>

<?php endif; ?>
