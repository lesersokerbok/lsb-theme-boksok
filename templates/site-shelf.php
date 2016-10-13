<div id="sidebar" class="stage-shelf stage-shelf-right hidden">
  <ul class="nav nav-bordered nav-stacked">
    <li class="<?= is_front_page() ? 'active' : '' ?>">
      <a href="<?= home_url() ?>"><?php _e('Forside', 'lsb_boksok') ?></a>
    </li>
  </ul>
  <ul class="nav nav-bordered nav-stacked">
    <li class="nav-divider"></li>
    <li class="nav-header"><?php _e('Kategorier', 'lsb_boksok') ?></li>
  </ul>
  <?php
    if (has_nav_menu('frontpage_sections')) :
      wp_nav_menu(array('theme_location' => 'frontpage_sections', 'menu_class' => 'nav nav-bordered nav-stacked'));
    endif;
  ?>
  <ul class="nav nav-bordered nav-stacked">
    <li class="nav-divider"></li>
  </ul>
  <?php
    if (has_nav_menu('primary_navigation')) :
      wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav nav-bordered nav-stacked'));
    endif;
  ?>
</div>
