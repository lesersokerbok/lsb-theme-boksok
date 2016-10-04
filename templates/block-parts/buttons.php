<?php 

  $buttons_title = $lsb_block_part_args['title'];
  $buttons_description = $lsb_block_part_args['description'];
  $buttons_terms = $lsb_block_part_args['button_terms'];

?>

<?php if( $buttons_title ) : ?>
<h1 class="block-lsb-heading"><?= $buttons_title ?></h1>
<?php endif ?>
<?= $buttons_description ?>
<div class="block-lsb-selection">
  <?php foreach( $buttons_terms as $term ) : ?>
    <a class="btn btn-default" href="<?= get_term_link($term) ?>"><?= $term->name ?></a>
  <? endforeach ?>
</div>