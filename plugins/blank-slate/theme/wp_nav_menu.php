<?php
/*
** Cleaner defaults for wp_nav_menu
*/
add_filter( 'wp_nav_menu_args', function( $args ){

	$args['fallback_cb']     = false;
	$args['container']       = 'nav';
	$args['items_wrap']      = PHP_EOL.'%3$s';

	if ( ! empty($args['theme_location']) )
		$args['container_id'] = 'location-'.$args['theme_location'];

	if ( ! empty($args['theme_location']) )
		$args['container_class'] .= ' location-'.$args['theme_location'];

	if ( ! empty($args['menu']) )
		$args['container_class'] .= ' menu-'.$args['menu'];

	$args['container_class'] = trim($args['container_class']);

	return $args;

} );

/*
** Strip <li>'s from wp_nav_menu HTML output
*/
add_filter( 'wp_nav_menu_items', function( $items ){

	$find    = array( '><a', '</li>', '<li' );
	$replace = array( '',    '',      '<a'  );

	return str_replace( $find, $replace, $items );

} );
