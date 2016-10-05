<?
  $book = $post;
?>

<article <?php post_class('full'); ?>>

  <header class="block block-lsb-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h1 class="lsb-heading">
            <?php echo roots_title(); ?>
          </h1>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 col-sm-5">
          <p class="m-t">
            <?= make_tags(get_lsb_book_creators($book), [ 'tag_class' => 'lsb-tag-bold' ]) ?>
          </p>
          <p class="m-t">
            <?= make_tags(get_lsb_book_topics($book), [ 'label' => __('tema', 'lsb-theme-books'), 'after' => '<br/>' ]) ?>
            <?= make_tags(get_lsb_book_part_of($book), [ 'label' => __('del av', 'lsb-theme-books'), 'after' => '<br/>' ]) ?>
            <?= make_tags(get_lsb_book_audience($book), [ 'label' => __('passer for', 'lsb-theme-books'), 'after' => '<br/>' ]) ?>
          </p>
        </div>
      </div>
    </div>
  </header>

  <section class="block p-b-md p-t-md">
    <div class="container">
      <div class="row lsb-sm-row-valign-stretch">
        <div class="col-sm-5">
          <div class="visible-xs-block lsb-book-cover m-b-md">
            <?= get_the_lsb_book_cover($book) ?>
          </div>
          <div class="lsb-book-content">
            <?php if( has_lsb_book_review( $book ) ) : ?>
              <h2 class="lsb-heading-small">
                <?php _e('Om boka', 'lsb-boksok') ?>
              </h2>
              <div class="lsb-description">
              <?= get_the_lsb_book_review( $book) ?>
              </div>
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
        <div class="hidden-xs col-sm-6 col-sm-offset-1">
          <div class="lsb-book-cover">
            <?= get_the_lsb_book_cover($book) ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <aside class="block p-b-md p-t-md">
    <div class="container">
      <div class="row">
        <div class="col-xs-6 col-sm-3">
          <div class="small">
          <?= make_tags(get_lsb_book_publishers($book), [ 'label' => __('forlag', 'lsb-theme-books'), 'after' => '<br/>' ]) ?>
          <?= make_tags(get_lsb_book_genres($book), [ 'label' => __('sjanger', 'lsb-theme-books'), 'after' => '<br/>' ]) ?>
          <?= make_tags(get_lsb_book_categories($book), [ 'label' => __('kategori', 'lsb-theme-books'), 'after' => '<br/>' ]) ?>
          <?= make_tags(get_lsb_book_language($book), [ 'label' => __('språk', 'lsb-theme-books'), 'after' => '<br/>' ]) ?>
          </div>
        </div>
        <div class="col-xs-6 col-sm-3">
          <div class="small">
            <?= make_meta(get_lsb_book_isbn($book), [ 'label' => __('isbn: ', 'lsb-theme-boksok'), 'after' => '<br/>' ]) ?>
            <?= make_meta(get_lsb_book_pages($book), [ 'label' => __('antall sider: ', 'lsb-theme-boksok'), 'after' => '<br/>' ]) ?>
            <?= make_meta(get_lsb_book_year($book), [ 'label' => __('utgitt: ', 'lsb-theme-boksok'), 'after' => '<br/>' ]) ?>
          </div>
        </div>
        <div class="col-xs-12 col-sm-6">
          <?php get_template_part('templates/partials/library-status'); ?>
        </div>
      </div>
    </div>
  </aside>

  <?php if( has_lsb_book_embeds($book)) : ?>
  <aside class="block p-b-md p-t-md">
    <div class="container">
      <?php 
        $oembeds = get_field('lsb_oembeds');
        $count = count($oembeds);
      ?>
      <div class="row">
      <?php foreach ( $oembeds as $key => $oembed ) : ?>
        <?php $margin_class = ( ($key == $count-1) || ($key == $count-2 && $key % 2 == 0 )) ? '' : 'm-b-md'; ?>
        <?php $column_offset = ( $key % 2 == 0 && $key == $count-1 ) ? 'col-sm-offset-3' : '' ?>
        <div class="col-sm-6 <?= $margin_class ?> <?= $column_offset ?>">
          <?php 
            $lsb_partials_args = [
              'iframe' => $oembed['lsb_oembed']
            ];
            include(locate_template('templates/partials/iframe.php'));
          ?>
        </div>
      <?php endforeach; ?>
      </div>
    </div>
  </aside>
  <? endif; ?>

</article>
