CHANGE

<?php while (have_posts()) : the_post(); ?>
<article <?php post_class(); ?>>
  <div class="row">
    <div class="col-sm-6">
      <header class="lsb-header m-b-md">
        <h1 class="lsb-heading"><?= lsb_page_title() ?></h1>
        <hr>
      </header>

      <p class="m-b-lg">
        <?= make_tags(get_lsb_book_creators(), [ 'label' => __('av', 'lsb-theme-books') ]) ?>
        <?= make_tags(get_lsb_book_topics(), [ 'label' => __('tema', 'lsb-theme-books') ]) ?>
        <?= make_tags(get_lsb_book_part_of(), [ 'label' => __('del av', 'lsb-theme-books') ]) ?>
        <?= make_tags(get_lsb_book_audience(), [ 'label' => __('passer for', 'lsb-theme-books') ]) ?>
      </p>

      <div class="thumbnail visible-xs-block m-y-lg">
        <?= get_the_lsb_book_cover() ?>
      </div>

      <?php if( has_lsb_book_review() ) : ?>
        <section class="m-y-md">
          <h2 class="lsb-heading-small">
            <?php _e('Om boka', 'lsb-boksok') ?>
          </h2>
          <?= get_the_lsb_book_review() ?>
        </section>
      <? endif; ?>

      <?php if( has_lsb_book_quote() ) : ?>
        <section class="m-y-md">
          <h2 class="lsb-heading-small">
            <?php _e('Utdrag fra boka', 'lsb-boksok') ?>
          </h2>
          <?= get_the_lsb_book_quote() ?>
        </section>
      <? endif; ?>

    </div>

    <div class="col-sm-6">
      <div class="thumbnail hidden-xs m-l-md m-y-md">
        <?= get_the_lsb_book_cover() ?>
      </div>
    </div>
  </div>

  <div class="row m-t-md">
    <div class="col-sm-6">
      <p class="lsb-columns-2">
        <?= make_tags(get_lsb_book_publishers(), [ 'label' => __('forlag', 'lsb-theme-books') ]) ?>
        <?= make_tags(get_lsb_book_genres(), [ 'label' => __('sjanger', 'lsb-theme-books') ]) ?>
        <?= make_tags(get_lsb_book_categories(), [ 'label' => __('kategori', 'lsb-theme-books') ]) ?>
        <?= make_tags(get_lsb_book_language(), [ 'label' => __('språk', 'lsb-theme-books') ]) ?>
        <?= make_meta(get_lsb_book_isbn(), [ 'label' => __('isbn: ', 'lsb-theme-boksok') ]) ?>
        <?= make_meta(get_lsb_book_pages(), [ 'label' => __('antall sider: ', 'lsb-theme-boksok') ]) ?>
        <?= make_meta(get_lsb_book_year(), [ 'label' => __('utgitt: ', 'lsb-theme-boksok') ]) ?>
      </p>
    </div>
    <div class="col-sm-6">
      <aside>
        <?php get_template_part('templates/books/book-partials/library-status'); ?>
      </aside>
    </div>
  </div>

  <?php if( has_lsb_book_embeds()) : ?>
  <aside class="m-t-lg">
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
            include(locate_template('templates/book-partials/iframe.php'));
          ?>
        </div>
      <?php endforeach; ?>
      </div>
    </div>
  </aside>
  <? endif; ?>

</article>
<?php endwhile; ?>
