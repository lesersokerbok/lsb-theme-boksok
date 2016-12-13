<?php

add_filter('nav_menu_css_class', 'lsb_clean_nav_menu_css_class', 10, 2);

function lsb_clean_nav_menu_css_class( $classes, $item ) {
  $classes[] = $item->post_name;
	return $classes;
}
