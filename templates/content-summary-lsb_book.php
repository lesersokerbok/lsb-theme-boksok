<?
  $book = $post;
?>

<article <?php post_class('lsb-book-collection-item'); ?>>
  <a class="lsb-book-collection-item-cover" title="<?= get_the_title($book) ?>" alt="<?= sprintf(__('Omslag - %s', 'lsb-theme-books'), get_the_title($book)) ?>" href="<?= get_permalink($book) ?>">
    <?= get_the_lsb_book_thumbnail($book) ?>
  </a>
  <h1 class="lsb-book-collection-item-title"><a href="<?= get_permalink($book) ?>"><?= get_the_title($book) ?></a></h1>
  <p class="lsb-book-collection-item-meta">
    <?= make_tags(get_lsb_book_creators($book), []) ?>
  <p>
  <p class="lsb-book-collection-item-meta">
    <?= make_tags(get_lsb_book_topics($book), [ 'label' => __('tema', 'lsb-theme-books') ]) ?>
    <?= make_tags(get_lsb_book_audience($book), [ 'label' => __('passer for', 'lsb-theme-books') ]) ?>
  </p>
</article>
