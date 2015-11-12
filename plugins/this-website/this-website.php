<?php
/*
**	Plugin Name: This Website
**	Plugin URI:  http://taylorpatrickgorman.com/wordpress-plugins/this-website
**	Version:     0.1.0
**	Description: Configures this WordPress install for this website. Requires Blank Slate.
**	Author:      Taylor Gorman
**	Author URI:  http://taylorpatrickgorman.com
**
** License:     GPL2
** License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

/*
** Do something here to fail activation if Blank Slate isn't activated
*/

// Modify theme supports
add_filter( 'bs_theme_support', function( $features ){

	$features['post-formats'] = array('link', 'gallery', 'quote');
	return $features;

} );
