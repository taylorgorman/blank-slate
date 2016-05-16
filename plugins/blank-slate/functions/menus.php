<?php

/*
** Convert <li><a></a></li> pattern to <a></a> pattern, transferring all <li> attributes to the <a>
** @param  string $s String to manipulate. Duh.
** @return string    Manipulated string
*/
function lia2a($string) {

	if (!is_string($string))
		return $string;

	$find = array('><a','</a>','<li','</li');
	$replace = array('','','<a','</a');
	$return = str_replace($find, $replace, $string);

	return $return;

}

/*
** Display requested nav menu, but strip out <ul>s and <li>s
** @param  string $menu_name Same as 'menu' in wp_nav_menu arguments. Allows simple retrieval of menu with just the one argument
** @param  array  $args      Passed directly to wp_nav_menu
**
** TO DO
** Need to add role="navigation" to the <nav> tag
*/
function bs_nav_menu($menu_name='', $args=array()) {

	$defaults = array(
		'menu'            => $menu_name
	,	'container'       => 'nav'
	,	'container_class' => sanitize_title($menu_name)
	,	'depth'           => 1
	,	'fallback_cb'     => false
	,	'items_wrap'      => PHP_EOL.'%3$s'
	,	'echo'            => false
	);
	$vars = wp_parse_args($args, $defaults);

	// If requested menu doesn't exist, cut and run
	if ( ! $menu = wp_nav_menu($vars) ) return false;

	// Remove <li>'s
	$menu = lia2a($menu);

	echo trim($menu).PHP_EOL;
}
