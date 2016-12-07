<?php
/**
 * Scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/assets/css/main.css
 *
 * Enqueue scripts in the following order:
 * 1. jquery-1.11.1.min.js via Google CDN
 * 2. /theme/assets/js/vendor/modernizr.min.js
 * 3. /theme/assets/js/scripts.js (in footer)
 * 4. /child-theme/style.css (if a child theme is activated)
 *
 * Google Analytics is loaded after enqueued scripts if:
 * - An ID has been defined in config.php
 * - You're not logged in as an administrator
 */
function roots_scripts() {

	$assets = array(
      'css'       => '/dist/main.css',
      'js'        => '/dist/main.js',
  );

  if (WP_ENV !== 'development') {
		$assets['css'] = '/dist/main.min.css';
		$assets['js'] = '/dist/main.min.js';
  }

  $assets['css_version'] = filemtime(get_stylesheet_directory() . $assets['css']);
  $assets['js_version'] = filemtime(get_stylesheet_directory() . $assets['js']);

  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'wp-util' );
  wp_enqueue_script( 'algolia-instantsearch' );

	wp_enqueue_style('lsb_boksok_css', get_template_directory_uri() . $assets['css'], $assets['css_version'], null);
	wp_enqueue_script('lsb_boksok_js', get_template_directory_uri() . $assets['js'], array('jquery'), $assets['js_version'], true);
}
add_action('wp_enqueue_scripts', 'roots_scripts', 100);

/**
 * Google Analytics snippet from HTML5 Boilerplate
 */
function roots_google_analytics() {
  if (WP_ENV === 'development') { ?>
    <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','<?php echo GOOGLE_ANALYTICS_ID; ?>', 'none');ga('send','pageview');
    </script>
  <?php
  } else { ?>
    <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','<?php echo GOOGLE_ANALYTICS_ID; ?>');ga('send','pageview');
    </script>
  <?php
  }
}
if (GOOGLE_ANALYTICS_ID && !current_user_can('manage_options')) {
  add_action('wp_footer', 'roots_google_analytics', 20);
}
