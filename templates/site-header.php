<header class="banner navbar navbar-default" role="banner">
  <div class="container">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle text-uppercase collapsed" data-target="#stage" data-toggle="stage" data-distance="-250">
        <span class="icon icon-menu"></span>
        <?php esc_html_e( 'Meny', 'lsb' ); ?>
      </button>

      <a class="navbar-brand" href="<?php echo home_url(); ?>">
        <span class="hidden"><?= get_bloginfo() ?></span>
			  <?php get_template_part('templates/logo'); ?>
      </a>

      <ul class="nav navbar-nav">
        <li class="text-uppercase <?= get_lsb_cat_filter_term() ? 'hidden-xs' : ''?>">
          <a class="p-l-0" href="<?php echo home_url(); ?>"><?= get_bloginfo() ?></a>
        </li>
        <?php if(get_lsb_cat_filter_term()) : ?>
        <li>
          <a class="p-l-0" href="<?= get_term_link(get_lsb_cat_filter_term()) ?>">
            <?= lsb_capitalize_title(get_lsb_cat_filter_term()->name) ?>
          </a>
        </li>
        <?php else : ?>
        <li class="dropdown hidden-xs hidden-sm">
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

    <nav class="navbar-collapse collapse text-uppercase navbar-right">

      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
        endif;
      ?>

      <ul class="nav navbar-nav">
        <li class="<?= (is_front_page() || is_search() || is_tax('lsb_tax_lsb_cat')) ? 'active' : '' ?>">
          <a href="<?= get_lsb_cat_filter_term() ? get_term_link(get_lsb_cat_filter_term()) : home_url() ?>">
            <span class="icon icon-magnifying-glass"></span> <?php _e('Søk', 'lsb_boksok') ?>
          </a>
        </li>
      </ul>

    </nav><!--/.nav-collapse -->

  </div>
</header>
