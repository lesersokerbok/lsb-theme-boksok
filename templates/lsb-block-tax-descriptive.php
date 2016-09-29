<?php
  $books = get_posts(
    array(
        'posts_per_page' => 6,
        'post_type' => 'lsb_book',
        'orderby' => 'date',
	      'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => $lsb_cat->taxonomy,
                'field' => 'term_id',
                'terms' => $lsb_cat->term_id,
            )
        )
    )
  );

  foreach($books as $book) {
    $image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $book->ID ), "medium" );
    $image_attr = [];
    $image_attr['data-width'] = $image_data[1];
    $image_attr['data-height'] = $image_data[2];
    $book->thumbnail = get_the_post_thumbnail( $book, 'medium', $image_attr );
    $book->permalink = get_permalink( $book->ID );
  }
?>

<div class="block block-lsb-cat lsb-cat-<?php echo $lsb_cat->slug ?>">
  <div class="container">
    <div class="row app-align-center">

      <div class="col-sm-5 hidden-xs">
        <div class="cover-grid" data-grid="images">
          <?php foreach($books as $book): ?>
            <a href="<?php echo $book->permalink ?>"><?php echo $book->thumbnail ?></a>
          <?php endforeach ?>
        </div>
      </div>

      <div class="col-sm-1 hidden-xs">
      </div>

      <div class="col-sm-6">
        <h1 class="block-lsb-heading"><a href="<?php echo $lsb_cat->url ?>"><?php echo $lsb_cat->name ?></a></h1>
        <div href="#" class="block-lsb-description">
          <?php if( !empty(get_field('lsb_acf_tax_full_description', $lsb_cat)) ) : ?>
            <?php echo get_field('lsb_acf_tax_full_description', $lsb_cat ); ?>
          <?php else : ?>
            <p><?php echo $lsb_cat->description ?></p>
          <?php endif; ?>

          <a href="<?php echo $lsb_cat->url ?>" class="btn btn-lg m-t-md">
            Velg <strong><?php echo $lsb_cat->name ?></strong>
          </a>
        </div>
      </div>
    </div>

  </div>
</div>