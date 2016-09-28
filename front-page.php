 <div class="block block-lsb-search">
  <div class="container">
      <div class="row app-align-center">
        <div class="col-sm-12 col-md-8 col-md-offset-2">
          <form>
            <div class="input-group input-group-lg">
              <input type="text" class="form-control" placeholder="Søk etter tittel, forfatter, tema ...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Søk</button>
              </span>
            </div>
          </form>
        </div>
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
      $lsb_cat = get_term( $frontpage_section->object_id, $frontpage_section->object );
      $lsb_cat->url = $frontpage_section->url;
      include(locate_template('templates/lsb-cat-block.php'));
    }
  }

  wp_reset_postdata();

?> 

<div class="block block-lsb-footer lsb-cat-boksok">
  <div class="container">
    <div class="row app-align-center">

      <div class="col-sm-6">
        <h1 class="block-lsb-heading"><a href="#">Boksøk</a></h1>
        <div href="#" class="block-lsb-description">
          <p>Bøker til alle!</p>
          <p>Det finnes mange grunner til at bøker
kan være tunge å lese. Boksøk hjelper deg å finne en bok som passer.
          </p><p>
I den store jungelen av bøker på markedet,
har vi valgt ut titler som på en eller annen måte
er mer tilgjengelige enn vanlig.</p>
       
        </div>
      </div>
    </div>

  </div>
</div>