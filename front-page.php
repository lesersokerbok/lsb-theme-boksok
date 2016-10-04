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

  $menu_locations = get_nav_menu_locations(); 
  $frontpage_sections_menu_id = $menu_locations[ 'frontpage_sections' ]; 
  $frontpage_sections = wp_get_nav_menu_items( $frontpage_sections_menu_id ); 

  foreach ($frontpage_sections as $frontpage_section) { 
    if($frontpage_section->type === "taxonomy") {
      $lsb_block_args = [
        'block_tax_term' => get_term( $frontpage_section->object_id, $frontpage_section->object )
      ];
      include(locate_template('templates/lsb-block-tax-descriptive.php'));
    }
  }

  wp_reset_postdata();

?> 