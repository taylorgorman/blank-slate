<?php
/*
** Cleaner defaults for wp_nav_menu
*/
add_filter( 'wp_nav_menu_args', function( $args ){

	// Bootstrap: ul > li > a
	if ( strpos($args['menu_class'], 'navbar-') !== false ) {

		$args['container'] = false;

	// Otherwise: nav > li > a (wp_nav_menu_items filter will remove li's)
	} else {

		$args['container']  = 'nav';
		$args['items_wrap'] = '%3$s';

	}

	// Other defaults
	$args['fallback_cb'] = '__return_false';
	$args['container_id'] = 'menu-location-'.$args['theme_location'];
	if ( empty( $args['container'] ) ) {
		$args['menu_id'] = $args['container_id'];
		$args['menu_class'] .= ' '.$args['container_id'];
	}
	$args['container_class'] = trim($args['container_class']);
	$args['menu_class'] = trim($args['menu_class']);

	return $args;

} );

/*
** Strip <li>'s from wp_nav_menu HTML output
*/
add_filter( 'wp_nav_menu_items', function( $items, $args ){

	// Bootstrap: do nothing
	if ( strpos($args->menu_class, 'navbar-') !== false )
		return $items;

	// Otherwise: remove li's
	$find    = array( '><a', '</li>', '<li' );
	$replace = array( '',    '',      '<a'  );

	return str_replace( $find, $replace, $items );

}, 10, 2 );
