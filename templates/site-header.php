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
          <a class="p-l-0 p-r-0" href="<?php echo home_url(); ?>">Boksøk:</span></a>
        </li>
        <li>
          <a class="p-l-0" href="#">&nbsp;alle bøker</span></a>
        </li>
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