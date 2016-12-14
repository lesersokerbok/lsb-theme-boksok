<!-- is_tax(): All custom taxonomies are related to books, therefore is_tax() will always be a lsb_book archive -->


<?php if(is_post_type_archive( 'lsb_book' ) || is_tax()) : ?>
  <!-- BOOKS -->
  <?php get_template_part('templates/books/archive'); ?>

<?php elseif(is_singular( 'lsb_book' )) : ?>
  <!-- BOOK -->
  <?php get_template_part('templates/books/single'); ?>

<?php elseif(is_archive()) : ?>
  <!-- ARTICLES -->
<?php get_template_part('templates/articles/archive'); ?>

<?php elseif(is_single() || is_page()) : ?>
  <!-- ARTICLE -->
  <?php get_template_part('templates/articles/single'); ?>

<?php else : ?>
  <!-- Should not happen, show 404 -->
  <?php get_template_part('404'); ?>

<?php endif; ?>

