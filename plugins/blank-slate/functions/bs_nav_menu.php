<?php
/*
** Display requested nav menu, but strip out <ul>s and <li>s
**
** @param  string $menu_name  Same as 'menu' in wp_nav_menu arguments. Allows simple retrieval of menu with just the one argument
** @param  array  $args       Passed directly to wp_nav_menu
*/
function bs_nav_menu( $menu_name = '', $args = array() ) {

	$vars = wp_parse_args( $args, array(
		'menu'            => $menu_name
	,	'container'       => 'nav'
	,	'container_class' => sanitize_title($menu_name)
	,	'depth'           => 1
	,	'fallback_cb'     => false
	,	'items_wrap'      => PHP_EOL.'%3$s'
	) );

	// Force return for now
	$vars['echo'] = false;

	// If menu doesn't exist, bail
	if ( ! $menu = wp_nav_menu($vars) )
		return false;

	// Remove <li>'s, clean up
	$menu = lia2a($menu);
	$menu = trim($menu).PHP_EOL;

	// Return or echo
	if ( $args['echo'] )
		echo $menu;
	else
		return $menu;

}

/*
** Convert <li><a></a></li> pattern to <a></a> pattern, transferring all <li> attributes to the <a>
**
** @param   string $s  String to manipulate.
**
** @return  string     Manipulated string
*/
function lia2a($string) {

	if (!is_string($string))
		return $string;

	$find = array('><a','</a>','<li','</li');
	$replace = array('','','<a','</a');
	$return = str_replace($find, $replace, $string);

	return $return;

}
