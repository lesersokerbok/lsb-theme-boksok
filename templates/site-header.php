<header class="banner navbar navbar-default" role="banner">
  <div class="container">

    <div class="navbar-header">
      <button type="button" class="btn btn-deafult navbar-toggle text-uppercase collapsed" data-target="#stage" data-toggle="stage" data-distance="-250">
        <span class="icon icon-menu"></span>
        <?php esc_html_e( 'Meny', 'lsb' ); ?>
      </button>
      <div class="navbar-brand">
        <a href="<?= get_home_url() ?>" class="text-uppercase">
          <?php get_template_part('templates/logo'); ?>
          <?= get_bloginfo() ?>
        </a>
        <?php if(get_lsb_cat_filter_term()) : ?>
          <a class="lsb-filter" href="<?= get_term_link(get_lsb_cat_filter_term()) ?>">
            <?= lsb_capitalize_title(get_lsb_cat_filter_term()->name) ?>
          </a>
        <?php endif; ?>
      </div>
    </div>

    <nav class="navbar-collapse collapse">
      <?php if(!get_lsb_cat_filter_term()) : ?>
        <?php if (has_nav_menu('frontpage_sections')) : ?>
          <?php wp_nav_menu(array('theme_location' => 'frontpage_sections', 'menu_class' => 'nav navbar-nav')); ?>
        <?php endif; ?>
      <?php endif; ?>

      <div class="navbar-right">
        <button type="button" class="btn btn-default navbar-btn" data-toggle="collapse" data-target="#search-page" aria-expanded="false" aria-controls="<?php _e('Åpne/lukke søk', 'lsb_boksok') ?>">
          <span class="icon icon-magnifying-glass"> </span><?php _e('Søk', 'lsb_boksok') ?>
        </button>
      </div>

    </nav><!--/.nav-collapse -->

  </div>
</header>
