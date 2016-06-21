<?php
/*
**  Plugin Name:  Blank Slate
**  Plugin URI:   http://taylorpatrickgorman.com/wordpress-plugins/blank-slate/
**  Version:      0.1.0
**  Description:  Configures WordPress to a predetermined base
**  Author:       Taylor Gorman & Chris Roche
**  Author URI:   http://taylorpatrickgorman.com
**
**  License:      GPL2
**  License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/


/*
** Prevent update from WordPress Plugin Repo
*/
add_filter( 'site_transient_update_plugins', function ( $value ) {
	unset( $value->response['blank-slate/blank-slate.php'] );
	return $value;
} );


/*
** Constants
*/
define('BS_IS_LOCAL', $_SERVER['SERVER_NAME'] == 'localhost');
define('BS_PATH', plugin_dir_path(__FILE__));
define('BS_URL', plugin_dir_url(__FILE__));


/*
** Settings
*/
$bs_settings = get_option('blank_slate_settings');


/*
** Make changes to current WordPress structure
*/
require_once 'structure/page.php';
require_once 'structure/roles.php';

/*
** Make WordPress things simpler
*/
require_once 'abstraction/post-type.php';
require_once 'abstraction/taxonomy.php';
require_once 'abstraction/scheduled.php';

/*
** Standalone functions
*/
require_once 'functions/get_author_posts_link.php';
require_once 'functions/get_post_thumbnail_url.php';
require_once 'functions/highest_ancestor.php';
require_once 'functions/bs_list_contextually.php';
require_once 'functions/bs_svg_sprite.php';
require_once 'functions/bs_nav_menu.php';
require_once 'functions/bs_paginate_links.php';

/*
** Modify admin screens
*/
require_once 'admin/general.php';
require_once 'admin/bar.php';
require_once 'admin/menu.php';
require_once 'admin/tinymce.php';
require_once 'admin/new-user-email.php';
require_once 'admin/featured-icon.php';

require_once 'admin/dashboard-widgets.php';
require_once 'admin/media.php';
require_once 'admin/users.php';
require_once 'admin/settings-blank-slate.php';
require_once 'admin/settings-contact.php';

/*
** Add widgets
*/
require_once 'widgets/section-navigation.php';

/*
** Modify theme output
*/
require_once 'theme/meta.php';
require_once 'theme/wp_head.php';
require_once 'theme/scripts.php';
require_once 'theme/excerpt.php';
require_once 'theme/content.php';
require_once 'theme/classes.php';
require_once 'theme/support.php';
require_once 'theme/images.php';
require_once 'theme/format-meta.php';
if ( ! empty($bs_settings['layout_classes']) ) require_once 'theme/layouts.php';


/*
** Load this plugin first, so its resources are available to everyone.
*/
add_action( 'activated_plugin', function(){

	$plugin_url = plugin_basename( __FILE__ );
	$active_plugins = get_option( 'active_plugins', array() );
	$key = array_search( $plugin_url, $active_plugins );

	if ( ! $key )
		return;

	array_splice( $active_plugins, $key, 1 );
	array_unshift( $active_plugins, $plugin_url );
	update_option( 'active_plugins', $active_plugins );

} );


/*
** Plugin activation
*/
function bs_activation_hook(){

	if ( ! current_user_can( 'activate_plugins' ) ) return;
	$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
	check_admin_referer( "activate-plugin_{$plugin}" );

	do_action('bs_activation');

}
register_activation_hook( __FILE__, 'bs_activation_hook' );

/*
** Plugin deactivation
*/
function bs_deactivation_hook(){

	if ( ! current_user_can( 'activate_plugins' ) ) return;
	$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
	check_admin_referer( "deactivate-plugin_{$plugin}" );

	do_action('bs_deactivation');

}
register_deactivation_hook( __FILE__, 'bs_deactivation_hook' );

/*
** Plugin uninstall
*/
function bs_uninstall_hook(){

	if ( ! current_user_can( 'activate_plugins' ) ) return;
	check_admin_referer( 'bulk-plugins' );
	if ( __FILE__ != WP_UNINSTALL_PLUGIN ) return;

	do_action('bs_uninstall');

}
register_uninstall_hook( __FILE__, 'bs_uninstall_hook' );
