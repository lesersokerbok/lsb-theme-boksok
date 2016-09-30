<?php 
  $input_placeholder =  __('Søk etter forfatter, tittel, tema, isbn ...', 'lsb_boksok');
  $input_value = get_search_query(); 
  $submit_text = __('Søk', 'lsb_boksok');
  
  $filter_name = __('Alle kategorier', 'lsb_boksok');

  $filter_selection = [];
  if ( is_tax( 'lsb_tax_lsb_cat' ) ) {
    $filter_selection['taxonomy'] =  'lsb_tax_lsb_cat';
    $filter_selection['taxonomy_name'] =  'hovedkategori';
    $filter_selection['term_slug'] = get_queried_object()->slug;
    $filter_selection['term_name'] = get_queried_object()->name;
    $filter_selection['term_label'] = get_queried_object()->name;
  }

  $filter_options = [];
  if ( is_front_page() ) {
    
    $menu_locations = get_nav_menu_locations(); 
    $frontpage_sections_menu_id = $menu_locations[ 'frontpage_sections' ]; 
    $frontpage_sections = wp_get_nav_menu_items( $frontpage_sections_menu_id ); 

    foreach ($frontpage_sections as $frontpage_section) { 
      if($frontpage_section->type === "taxonomy") {
        $lsb_cat = get_term( $frontpage_section->object_id, $frontpage_section->object );
        $lsb_cat->url = $frontpage_section->url;
        $lsb_cat->taxonomy_name = "hovedkategori";
        $filter_options[] = [
          "url" => $frontpage_section->url,
          "taxonomy" => $lsb_cat->taxonomy,
          "taxonomy_name" => "hovedkategori",
          "term_label" => $frontpage_section->post_title,
          "term_slug" => $lsb_cat->slug,
          "term_name" => $lsb_cat->name
        ];
      }
    }
  }

?>

<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
  <div class="input-group input-group-lg">
    <?php if ( !empty($filter_options) ) : ?>
    <span class="input-group-btn">
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span><?php echo $filter_name ?></span>
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu">
        <li>
          <?php foreach($filter_options as $option) : ?>
            <a href="<?php echo $option['url'] ?>" data-tax-term='<?php echo json_encode($option) ?>'><?php echo $option['term_label'] ?></a>
          <?php endforeach; ?>
        </li>
        <li role="separator" class="divider"></li>
        <li><a href="#"><?php echo $filter_name ?></a></li>
      </ul>
    </span>
    <?php endif; ?>
    <input type="search" class="form-control" name="s" value="<?php echo $input_value ?>" placeholder="<?php echo $input_placeholder ?>">
    <span class="input-group-btn">
      <button class="btn btn-default" type="submit"><?php echo $submit_text ?></button>
    </span>
  </div>

  <input id="algolia-filter" class="search-filter" type="hidden" 
          data-tax-term='<?php echo json_encode($filter_selection); ?>' 
          value="<?php echo $filter_selection['slug']; ?>" 
          name="<?php echo $filter_selection['taxonomy']; ?>" />
</form>