<header class="banner navbar" role="banner">
  <div class="container">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed p-x-0" data-target="#stage" data-toggle="stage" data-distance="-250">
        <?php esc_html_e( 'Meny', 'lsb' ); ?>
      </button>

      <a class="navbar-brand" href="<?php echo home_url(); ?>">
			  <?php get_template_part('templates/logo'); ?>
      </a>

      <ul class="nav navbar-nav">
        <li class="text-uppercase">
          <a class="p-l-0 p-r-0" href="<?php echo home_url(); ?>">Boksøk</span></a>
        </li>
        <?php if(is_tax( 'lsb_tax_lsb_cat')) : ?>
        <li>
          <a href="<? echo get_term_link(get_queried_object()) ?>"><?php single_cat_title() ?></span></a>
        </li>
        <?php endif; ?>
      </ul>
    </div>

    <nav class="navbar-collapse collapse text-uppercase">
      <ul class="nav navbar-nav navbar-right">
        <li >
          <a href="/index.html">Ressurser</a>
        </li>
        <li >
          <a href="minimal/index.html">Om Boksøk</a>
        </li>
      </ul>
    </nav><!--/.nav-collapse -->

  </div>
</header>