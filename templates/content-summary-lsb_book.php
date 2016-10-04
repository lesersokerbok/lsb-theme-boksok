<?
  $book = $post;
?>

<div class="lsb-book">
  <div class="lsb-book-thumbnail">
    <div class="lsb-book-thumbnail-bg" style="background-image: url(<?= get_the_lsb_book_thumbnail_url($book) ?>)"></div>
    <a href="<?= get_the_permalink($book) ?>">
      <?= get_the_lsb_book_thumbnail($book) ?>
    </a>
  </div>
  <div class="lsb-book-content">
    <h1 class="block-lsb-heading"><a href="<?= get_the_permalink($book) ?>"><?= get_the_title($book) ?></a></h1>
    <?= make_tags(get_lsb_book_creators(), '', 'lsb-tags-bold') ?>
    <p class="block-lsb-description">
      <?= get_the_excerpt($book) ?>
    </p>
    <?= make_tags(get_lsb_book_topics(), __('tema', 'lsb-theme-books')) ?>
    <?= make_tags(get_lsb_book_part_of(), __('del av', 'lsb-theme-books')) ?>
    <?= make_tags(get_lsb_book_audience(), __('passer for', 'lsb-theme-books')) ?>
  </div>
</div>

