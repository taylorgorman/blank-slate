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
** Prevent update from WordPress Plugin Repo
*/
add_filter( 'site_transient_update_plugins', function ( $value ) {
	unset( $value->response['blank-slate/blank-slate.php'] );
	return $value;
} );


/*
** Do something here to fail activation if Blank Slate isn't activated
** Create require_blank_slate() function in Blank Slate? Make it a filter here?
*/
function require_blank_slate(){

	if ( ! current_user_can( 'activate_plugins' ) ) return;
	$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
	check_admin_referer( "activate-plugin_{$plugin}" );

	if ( ! function_exists('blank_slate_active') ) {
		// kill this plugin activation
	}

}
//register_activation_hook( __FILE__, 'require_blank_slate' );

require_once 'admin.php';
require_once 'structure.php';
