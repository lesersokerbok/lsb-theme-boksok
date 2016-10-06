<?php
/**
 * Roots includes
 *
 * The $roots_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/roots/pull/1042
 */
$roots_includes = array(
  'lib/algolia.php',        // Algolia customization
  'lib/book.php',           // Book helper functions
  'lib/config.php',         // Configuration
  'lib/extras.php',         // Custom functions
  'lib/feed-util.php',      // Custom rss rules
  'lib/filter.php',      // Filters and actions
  'lib/init.php',           // Initial theme setup and constants
  'lib/nav.php',            // Custom nav modifications
  'lib/pagination.php',     // Boostrap pagination
  'lib/rewrite.php',        // Custom rewrite rules
  'lib/scripts.php',        // Scripts and stylesheets
  'lib/titles.php',         // Page titles
  'lib/wrapper.php',        // Theme wrapper class
);

foreach ($roots_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'roots'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

// Initialize custom functionality
new LsbFeedUtil();
