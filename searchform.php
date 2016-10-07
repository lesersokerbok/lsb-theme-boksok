<?php 
  $input_placeholder =  __('Søk etter forfatter, tittel, tema, isbn ...', 'lsb_boksok');
  $input_value = get_search_query(); 
  $submit_text = __('Søk', 'lsb_boksok');
  
  $lsb_cat_filter_term = get_lsb_cat_filter_term();
  $lsb_algolia_filter = [];
  if($lsb_cat_filter_term) {
    $lsb_algolia_filter['term'] = $lsb_cat_filter_term->name;
    $lsb_algolia_filter['taxonomy'] = 'lsb_tax_lsb_cat';
  }

  $action = $lsb_cat_filter_term ? get_term_link($lsb_cat_filter_term) : get_home_url();
?>

<input id="algolia-filter" class="search-filter" type="hidden" 
            data-tax-term='<?php echo json_encode($lsb_algolia_filter); ?>' />

<?php if(is_front_page() || is_tax('lsb_tax_lsb_cat')) : ?>
  <form role="search" method="get" class="search-form" action="<?= $action ?>">
    <div class="input-group input-group-lg">
      <span class="input-group-addon" id="basic-addon1"><span class="icon icon-magnifying-glass"></span></span>
      <input id="algolia-auto-search" class="form-control" name="s" value="<?php echo $input_value ?>" placeholder="<?php echo $input_placeholder ?>">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><?php echo $submit_text ?></button>
      </span>
    </div>
  </form>
<?php else : ?>
  <form class="search-form navbar-form navbar-right" method="get" action="<?= $action ?>">
    <div class="form-group">
      <input id="algolia-auto-search" class="form-control" name="s" value="<?php echo $input_value ?>" placeholder="<?php echo $input_placeholder ?>">
    </div>
    <button type="submit" class="btn btn-default"><?php echo $submit_text ?></button>
  </form>
<?php endif; ?>