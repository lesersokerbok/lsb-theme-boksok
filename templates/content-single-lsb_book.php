<?
  $book = $post;
?>

<article <?php post_class('full'); ?>>

  <header class="block block-lsb-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-5">
          <h1 class="lsb-heading">
            <?php echo roots_title(); ?>
          </h1>
          <p class="m-t">
            <?= make_tags(get_lsb_book_creators(), [ 'tag_class' => 'lsb-tag-bold' ]) ?>
          </p>
          <p class="m-t">
            <?= make_tags(get_lsb_book_topics(), [ 'label' => __('tema', 'lsb-theme-books'), 'after' => '<br/>' ]) ?>
            <?= make_tags(get_lsb_book_part_of(), [ 'label' => __('del av', 'lsb-theme-books'), 'after' => '<br/>' ]) ?>
            <?= make_tags(get_lsb_book_audience(), [ 'label' => __('passer for', 'lsb-theme-books'), 'after' => '<br/>' ]) ?>
          </p>
        </div>
      </div>
    </div>
  </header>

  <section class="block block-lsb-content">
    <div class="container">
      <div class="row">
        <div class="col-sm-5">
          <div class="lsb-book-content">
            <?php if( has_lsb_book_review( $book ) ) : ?>
              <h2 class="lsb-heading-small">
                <?php _e('Om boka', 'lsb-boksok') ?>
              </h2>
              <?= get_the_lsb_book_review( $book) ?>
            <? endif; ?>
            <?php if( has_lsb_book_quote( $book ) ) : ?>
              <h2 class="lsb-heading-small m-t-md">
                <?php _e('Utdrag fra boka', 'lsb-boksok') ?>
              </h2>
              <?= get_the_lsb_book_quote( $book) ?>
            <? endif; ?>
            <div class="read-more">
              <button class="btn btn-default btn-small" data-open-text="<?php _e('Trekk sammen', 'lsb-boksok') ?>"><?php _e('Les mer', 'lsb-boksok') ?></button>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-sm-offset-1">
          <div class="lsb-book-cover">
            <?= get_the_lsb_book_cover($book) ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <aside class="block block-lsb-content">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <?php get_template_part('templates/partials/library-status'); ?>
        </div>
      </div>
    </div>
  </aside>

</article>
