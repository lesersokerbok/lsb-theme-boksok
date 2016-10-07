<header class="banner navbar" role="banner">
  <div class="container">

    <div class="navbar-header">
      <button type="button" class="btn btn-default navbar-btn navbar-toggle collapsed" data-target="#stage" data-toggle="stage" data-distance="-250">
        <?php esc_html_e( 'Meny', 'lsb' ); ?>
      </button>

      <a class="navbar-brand" href="<?php echo home_url(); ?>">
			  <?php get_template_part('templates/logo'); ?>
      </a>

      <ul class="nav navbar-nav">
        <li class="text-uppercase hidden-xs">
          <a class="p-l-0 p-r-0" href="<?php echo home_url(); ?>">Boksøk</a>
        </li>
        <?php if(get_lsb_cat_filter_term()) : ?>
        <li>
          <a href="<?= get_term_link(get_lsb_cat_filter_term()) ?>">
            <?= lsb_capitalize_title(get_lsb_cat_filter_term()->name) ?>
          </a>
        </li>
        <?php else : ?>
        <li class="dropdown">
          <a href="#" dropdown-toggle data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <?php _e('Velg kategori', 'lsb-theme-boksok'); ?>
          <span class="caret"></span></a>
          <?php
            if (has_nav_menu('frontpage_sections')) :
              wp_nav_menu(array('theme_location' => 'frontpage_sections', 'menu_class' => 'dropdown-menu'));
            endif;
          ?>
        </li>
        <?php endif ?>
      </ul>
    </div>

    <nav class="navbar-collapse collapse text-uppercase">
      <?php if (is_front_page() || is_search() || is_tax('lsb_tax_lsb_cat') || is_page() ) : ?>
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav navbar-right'));
        endif;
      ?>
      <?php else: ?>
        <?php get_search_form() ?>
      <?php endif ?>
    </nav><!--/.nav-collapse -->

  </div>
</header>