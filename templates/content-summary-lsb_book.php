<?
  $book = $post;
?>

<article <?php post_class('summary'); ?>>
  <div class="lsb-book-thumbnail">
    <div class="lsb-book-thumbnail-bg" style="background-image: url(<?= get_the_lsb_book_thumbnail_url($book) ?>)"></div>
    <a href="<?= get_the_permalink($book) ?>">
      <?= get_the_lsb_book_thumbnail($book) ?>
    </a>
  </div>
  <div class="lsb-book-content">
    <h1 class="lsb-heading-small"><a href="<?= get_the_permalink($book) ?>"><?= get_the_title($book) ?></a></h1>
    <p class="small">
      <?= make_tags(get_lsb_book_creators(), [ 'tag_class' => 'lsb-tag-bold', 'container_class' => 'no-wrap' ]) ?>
    <p>
    <p class="block-lsb-description">
      <?= get_the_excerpt($book) ?>
    </p>
    <p class="small">
      <?= make_tags(get_lsb_book_topics(), [ 'label' => __('tema', 'lsb-theme-books'), 'container_class' => 'no-wrap', 'after' => '<br/>' ]) ?>
      <?= make_tags(get_lsb_book_part_of(), [ 'label' => __('del av', 'lsb-theme-books'), 'container_class' => 'no-wrap', 'after' => '<br/>' ]) ?>
      <?= make_tags(get_lsb_book_audience(), [ 'label' => __('passer for', 'lsb-theme-books'), 'container_class' => 'no-wrap', 'after' => '<br/>' ]) ?>
    </p>
  </div>
</article>

