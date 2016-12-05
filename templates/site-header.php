<header class="banner navbar navbar-default" role="banner">
  <div class="container">

    <div class="navbar-header">
      <button type="button" class="btn btn-deafult navbar-toggle text-uppercase collapsed" data-target="#stage" data-toggle="stage" data-distance="-250">
        <span class="icon icon-menu"></span>
        <?php esc_html_e( 'Meny', 'lsb' ); ?>
      </button>
      <ul class="nav navbar-nav">
        <li>
          <?php if(get_lsb_cat_filter_term()) : ?>
            <a class="lsb-brand" href="<?= get_term_link(get_lsb_cat_filter_term()) ?>">
              <?php get_template_part('templates/logo'); ?>
              <span class="text-uppercase"><?= get_bloginfo() ?></span>
            </a>
          <?php else : ?>
            <a class="lsb-brand" href="<?php echo home_url(); ?>">
              <?php get_template_part('templates/logo'); ?>
              <span class="text-uppercase"><?= get_bloginfo() ?></span>
            </a>
          <?php endif; ?>
        </li>
      </ul>
    </div>

    <nav class="navbar-collapse collapse">

      <div class="btn-group navbar-btn">
        <?php if(get_lsb_cat_filter_term()) : ?>
          <a class="btn btn-default" href="<?= get_term_link(get_lsb_cat_filter_term()) ?>">
            <?= lsb_capitalize_title(get_lsb_cat_filter_term()->name) ?>
          </a>
        <?php else : ?>
          <a href="<?php echo home_url(); ?>" class="btn btn-default">
            <?php _e('Alle boktyper', 'lsb-theme-boksok'); ?>
          </a>
        <?php endif; ?>

        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="caret"></span>
          <span class="sr-only"><?php _e('Åpne/lukke nedtrekksmeny', 'lsb-theme-boksok'); ?></span>
        </button>
        <?php
            if (has_nav_menu('frontpage_sections')) :
              wp_nav_menu(array('theme_location' => 'frontpage_sections', 'menu_class' => 'dropdown-menu'));
            endif;
          ?>
      </div>

      <div class="navbar-right">

        <?php
          if (has_nav_menu('primary_navigation')) :
            wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
          endif;
        ?>

        <button type="button" class="btn btn-default navbar-btn" data-toggle="collapse" data-target="#search-page" aria-expanded="false" aria-controls="<?php _e('Åpne/lukke søk', 'lsb_boksok') ?>">
          <span class="icon icon-magnifying-glass"> </span><?php _e('Søk', 'lsb_boksok') ?>
        </button>
      </div>

    </nav><!--/.nav-collapse -->

  </div>
</header>
