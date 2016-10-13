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

<form role="search" method="get" class="search-form" action="<?= $action ?>">
  <label class="hidden" for="algolia-auto-search"><?= $input_placeholder ?></label>
  <div class="input-group input-group-lg">
    <input id="algolia-auto-search" class="form-control" name="s" value="<?php echo $input_value ?>" placeholder="<?= $input_placeholder ?>">
    <span class="input-group-btn">
      <button class="btn" type="submit"><span class="icon icon-magnifying-glass"></span></button>
    </span>
  </div>
</form>
