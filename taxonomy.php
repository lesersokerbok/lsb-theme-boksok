 <div class="block block-lsb-search">
  <div class="container">
    <div class="row app-align-center">
      <div class="col-sm-12 col-md-8 col-md-offset-2">
        <?php get_search_form() ?>
      </div>
    </div>
  </div>
</div>

<?php
  $lsb_cat = get_queried_object();
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

<div class="block block-lsb-cat">
  <div class="container">
    <div class="row">
      <div class="col-sm-5 lsb-col-move-up hidden-xs">
        <h1 class="block-lsb-heading"><a href ="">Barnebøker</a></h1>
        <div class="block-lsb-cover-grid" data-grid="images">
          <?php foreach($books as $book): ?>
            <a href="<?php echo $book->permalink ?>"><?php echo $book->thumbnail ?></a>
          <?php endforeach ?>
        </div>
      </div>

      <div class="col-sm-1 hidden-xs">
      </div>

      <div class="col-sm-6 lsb-col-center">
        <h1 class="block-lsb-heading">Tema</h1>
        <div class="block-lsb-selection">
          <button class="btn btn-default">Kjærlighet</button>
          <button class="btn  btn-default">Spenning</button>
          <button class="btn  btn-default">Krim</button>
          <button class="btn  btn-default">Hage</button>
          <button class="btn  btn-default">Fotball</button>
          <button class="btn  btn-default">Krim</button>
          <button class="btn  btn-default">Hage</button>
          <button class="btn  btn-default">Fotball</button>
          <button class="btn  btn-default">Spenning</button>
          <button class="btn  btn-default">Krim</button>
          <button class="btn  btn-default">Hage</button>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="block block-lsb-cat lsb-cat-<?php echo $lsb_cat->slug ?>">
  <div class="container">
    <div class="row">
      <div class="col-sm-5 lsb-col-center hidden-xs">
        <h1 class="block-lsb-heading"><a href ="">Tema</a></h1>
        <div class="block-lsb-selection">
          <button class="btn btn-default">Kjærlighet</button>
          <button class="btn  btn-default">Spenning</button>
          <button class="btn  btn-default">Krim</button>
          <button class="btn  btn-default">Hage</button>
          <button class="btn  btn-default">Fotball</button>
          <button class="btn  btn-default">Krim</button>
          <button class="btn  btn-default">Hage</button>
          <button class="btn  btn-default">Fotball</button>
          <button class="btn  btn-default">Spenning</button>
          <button class="btn  btn-default">Krim</button>
          <button class="btn  btn-default">Hage</button>
        </div>
      </div>

      <div class="col-sm-1 hidden-xs">
      </div>

      <div class="col-sm-6 lsb-col-move-up">
        <h1 class="block-lsb-heading"><a href ="">Barnebøker</a></h1>
        <div class="block-lsb-cover-grid" data-grid="images">
          <?php foreach($books as $book): ?>
            <a href="<?php echo $book->permalink ?>"><?php echo $book->thumbnail ?></a>
          <?php endforeach ?>
        </div>
    </div>

  </div>
</div>