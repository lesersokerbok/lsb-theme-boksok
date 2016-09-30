<?php 
  $input_placeholder =  __('Søk etter forfatter, tittel, tema, isbn ...', 'lsb_boksok');
  $input_value = get_search_query(); 
  $submit_text = __('Søk', 'lsb_boksok');
  $filter = [];
  if ( is_tax( 'lsb_tax_lsb_cat' ) ) {
    $filter['algolia_taxonomy'] =  'lsb_tax_lsb_cat';
    $filter['algolia_term'] = get_queried_object()->name;
    $filter['name'] = 'hovedkategori';
    $filter['value'] = get_queried_object()->slug;
  }
?>

<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
  <div class="input-group input-group-lg">
    <?php if (! is_tax('lsb_tax_lsb_cat')) : ?>
    <span class="input-group-btn">
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span>Alle kategorier</span>
        <span class="caret"></span>
      </button>
      <?php 
        $args = array(
          "menu_class" => "dropdown-menu",
          "theme_location" => "frontpage_sections",
        );
        wp_nav_menu( $args );
      ?>
    </span>
    <?php endif; ?>
    <input type="search" class="form-control" name="s" value="<?php echo $input_value ?>" placeholder="<?php echo $input_placeholder ?>">
    <span class="input-group-btn">
      <button class="btn btn-default" type="submit"><?php echo $submit_text ?></button>
    </span>
  </div>

  <input id="algolia-lsb_tax_lsb_cat" type="hidden" 
          data-algolia-taxonomy="<?php echo $filter['algolia_taxonomy']; ?>" 
          data-algolia-term="<?php echo $filter['algolia_term']; ?>" 
          value="<?php echo $filter['value']; ?>" 
          name="<?php echo $filter['name']; ?>" />
</form>