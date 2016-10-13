<?
  $book = $post;
?>

<article <?php post_class('summary'); ?>>
  <div class="row lsb-xs-row-valign-center">
    <div class="col-xs-5">
        <a class="lsb-book-thumbail" href="<?= get_permalink($book) ?>">
          <?= get_the_lsb_book_thumbnail($book) ?>
        </a>
    </div>
    <div class="col-xs-7">
      <h1 class="lsb-heading-medium"><a href="<?= get_permalink($book) ?>"><?= get_the_title($book) ?></a></h1>
      <p>
        <?= make_term_buttons(get_lsb_book_creators($book)) ?>
      <p>
      <p>
        <?= get_the_excerpt($book) ?>
      </p>
      <p class="small">
        <?= make_tags(get_lsb_book_topics($book), [ 'label' => __('tema', 'lsb-theme-books'), 'container_class' => 'no-wrap', 'after' => '<br/>' ]) ?>
        <?= make_tags(get_lsb_book_part_of($book), [ 'label' => __('del av', 'lsb-theme-books'), 'container_class' => 'no-wrap', 'after' => '<br/>' ]) ?>
        <?= make_tags(get_lsb_book_audience($book), [ 'label' => __('passer for', 'lsb-theme-books'), 'container_class' => 'no-wrap', 'after' => '<br/>' ]) ?>
      </p>
    </div>
  </div>
</article>

