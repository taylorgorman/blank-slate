<?php
/*
** Cleaner defaults for wp_nav_menu
*/
add_filter( 'wp_nav_menu_args', function( $args ){

	$args['container']  = 'nav';
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

add_filter( 'wp_nav_menu_objects', function( $sorted_menu_items, $args ){

	// Not on admin
	if ( is_admin() )
		return;

	//echo '<pre>'.print_r($sorted_menu_items,1).'</pre>';

	foreach ( $sorted_menu_items as $item ) {

		/*
		** Menu items with hashlink
		*/
		$hashpos = strpos( $item->url, '#' );
		if ( $hashpos !== false ) {

			// Temporarily strip off hashlink
			$url_wo_hash = substr( $item->url, 0, $hashpos );
			//echo '<pre>'; var_dump($url_wo_hash); echo '</pre>';

			// TODO: Strip domain from both URLs

			// If we're at the item's URL, just display the hash
			if ( $url_wo_hash === $_SERVER['REQUEST_URI'] )
				$item->url = substr( $item->url, $hashpos );

		}

		// Add Bootstrap navbar item class
		$item->classes[] = 'nav-item';

		// Add Bootstrap dropdown classes
		if ( strpos($args->menu_class, 'navbar-nav') !== false ) {
			if ( in_array( 'menu-item-has-children', $item->classes ) ) {
				$item->classes[] = 'dropdown';
			}
		}

	}

	return $sorted_menu_items;

}, 10, 2 );

add_filter( 'wp_nav_menu_items', function( $items, $args ){

	// If Bootstrap's navbar-nav
	if ( strpos($args->menu_class, 'navbar-nav') !== false ) {

		$items = str_replace( '<a', '<a class="nav-link"', $items );

		/* Uncomment to toggle dropdown on click with js
		// Add Bootstrap dropdown classes
		$items = str_replace( 'class="sub-menu', 'class="sub-menu dropdown-menu', $items );
		$parent_pos = strpos( $items, 'menu-item-has-children' );
		while ( $parent_pos !== false ) {
			$a_needle = '<a';
			$a_pos = strpos( $items, $a_needle, $parent_pos);
			$items = substr_replace( $items, ' class="dropdown-toggle" data-toggle="dropdown"', $a_pos + strlen($a_needle), 0 );
			$parent_pos = strpos( $items, 'menu-item-has-children', $a_pos+1 );
		}
		*/

	}

	/*
	// Strip <li>'s from wp_nav_menu HTML output
	$find    = array( '><a', '</li>', '<li' );
	$replace = array( '',    '',      '<a'  );
	$items = str_replace( $find, $replace, $items );
	*/

	return $items;

}, 10, 2 );
