<?
  $book = $lsb_block_part_args['book'];
  if(!$book) {
    $book = $post;
  }

  $book_creators = [];
  if(get_the_terms($book, 'lsb_tax_author')) {
    $book_creators = array_merge($book_creators, get_the_terms($book, 'lsb_tax_author'));
  }
  if(get_the_terms($book, 'lsb_tax_illustrator')) {
    $book_creators = array_merge($book_creators, get_the_terms($book, 'lsb_tax_illustrator'));
  }
  if(get_the_terms($book, 'lsb_tax_translator')) {
    $book_creators = array_merge($book_creators, get_the_terms($book, 'lsb_tax_translator'));
  }

  $book_tags = [];
  $book_tags = array_merge($book_tags, get_the_terms($book, 'lsb_tax_topic'));

  $book_thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( $book->ID ), "thumbnail" );
  $book_thumbnail_url = $book_thumbnail_data[0];
  $book_tumbnail_dimension = ( $book_thumbnail_data[1] > $book_thumbnail_data[2] ) ? 'landscape' : 'portrait';  
?>

<div class="lsb-book">
  <div class="lsb-book-thumbnail">
    <div class="lsb-book-thumbnail-bg" style="background-image: url(<?= $book_thumbnail_url ?>)"></div>
    <a href="<?= get_the_permalink($book) ?>">
      <?= get_the_post_thumbnail($book, 'thumbnail', ['class' => $book_tumbnail_dimension]); ?>
    </a>
  </div>
  <div class="lsb-book-content">
    <h1 class="block-lsb-heading"><a href="<?= get_the_permalink($book) ?>"><?= get_the_title($book) ?></a></h1>
    <?php if( $book_creators ) : ?>
      <p class="lsb-tags lsb-tags-bold">
        <?php foreach($book_creators as $book_term) : ?>
          <span class="lsb-tag">
            <?php if($book_term->taxonomy == 'lsb_tax_author' || $book_term->taxonomy == 'lsb_tax_illustrator') : ?>
              <span class="icon icon-user" aria-hidden="true" style="color: black; opacity: 0.3"></span>
            <?php endif; ?>
            <a href="<?= get_term_link($book_term) ?>"><?= $book_term->name ?></a>
          </span>
        <?php endforeach; ?>
      </p>
    <? endif; ?>
    <p class="block-lsb-description">
      <?= get_the_excerpt($book) ?>
    </p>
    <?php if( $book_tags ) : ?>
      <p class="lsb-tags">
        <span class="lsb-tag lsb-tag-label">
          <?= _e('tema', 'lsb-boksok') ?>
        </span>
        <?php foreach($book_tags as $book_term) : ?>
          <span class="lsb-tag">
            <a href="<?= get_term_link($book_term) ?>"><?= $book_term->name ?></a>
          </span>
        <?php endforeach; ?>
      </p>
    <? endif; ?>
  </div>
</div>

