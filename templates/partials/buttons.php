<?php 

  $buttons_title = $lsb_partials_args['title'];
  $buttons_description = $lsb_partials_args['description'];
  $buttons_terms = $lsb_partials_args['button_terms'];

?>

<?php if( $buttons_title ) : ?>
<h1 class="lsb-heading-small"><?= $buttons_title ?></h1>
<?php endif ?>
<?= $buttons_description ?>
<div class="block-lsb-selection">
  <?php foreach( $buttons_terms as $term ) : ?>
    <?= make_term_button($term) ?>
  <? endforeach ?>
</div>