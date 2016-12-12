<header class="banner navbar navbar-default" role="banner">
  <div class="container">

    <div class="navbar-header">

      <div class="navbar-brand">
        <a href="<?= get_home_url() ?>" class="text-uppercase">
          <?php get_template_part('templates/logo'); ?>
          <span class="lsb-site-title"><?= get_bloginfo() ?></span>
        </a>
        <?php if(get_lsb_cat_filter_term()) : ?>
          <a class="lsb-filter" href="<?= get_term_link(get_lsb_cat_filter_term()) ?>">
            <?= lsb_capitalize_title(get_lsb_cat_filter_term()->name) ?>
          </a>
        <?php endif; ?>
      </div>

      <button type="button" class="btn btn-default navbar-btn" data-toggle="collapse" data-target="#search-page" aria-expanded="false" aria-controls="<?php _e('Åpne/lukke søk', 'lsb_boksok') ?>">
        <span class="icon icon-magnifying-glass"></span>
        <span class="lsb-button-label"><?php _e('Søk', 'lsb_boksok') ?></span>
      </button>
    </div>

    <nav class="navbar-collapse collapse">
      <?php if(!get_lsb_cat_filter_term()) : ?>
        <?php if (has_nav_menu('frontpage_sections')) : ?>
          <?php wp_nav_menu(array('theme_location' => 'frontpage_sections', 'menu_class' => 'nav navbar-nav lsb-frontpage-sections')); ?>
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#" aria-expanded="true">
                <?php _e('Flere kategorier', 'lsb_boksok') ?> <b class="caret"></b>
              </a>
                <?php wp_nav_menu(array('theme_location' => 'frontpage_sections', 'menu_class' => 'dropdown-menu lsb-frontpage-sections-dropdown'));  ?>
            </li>
          </ul>
        <?php endif; ?>
      <?php endif; ?>

      <div class="navbar-right">
        <?php if(!get_lsb_cat_filter_term()) : ?>
          <?php if (has_nav_menu('primary_navigation')) : ?>
            <?php wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav')); ?>
          <?php endif; ?>
        <?php endif; ?>

        <button type="button" class="btn btn-default navbar-btn" data-toggle="collapse" data-target="#search-page" aria-expanded="false" aria-controls="<?php _e('Åpne/lukke søk', 'lsb_boksok') ?>">
          <span class="icon icon-magnifying-glass"> </span><?php _e('Søk', 'lsb_boksok') ?>
        </button>
      </div>

    </nav><!--/.nav-collapse -->

  </div>
</header>

<?php get_template_part('algolia/instantsearch'); ?>
