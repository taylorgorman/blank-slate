<?php
/*
**	Plugin Name: Blank Slate
**	Plugin URI:  http://taylorpatrickgorman.com/wordpress-plugins/blank-slate
**	Version:     0.1.0
**	Description: Configures WordPress to a predetermined base
**	Author:      Taylor Gorman & Chris Roche
**	Author URI:  http://taylorpatrickgorman.com
**
** License:     GPL2
** License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


/*
** Constants
*/

define('BS_IS_LOCAL', $_SERVER['SERVER_NAME'] == 'localhost');
define('BS_PATH', plugin_dir_path(__FILE__));
define('BS_URL', plugin_dir_url(__FILE__));


/*
** Include files
*/

// ADMIN
require_once 'admin/general.php';
require_once 'admin/bar.php';
require_once 'admin/menu.php';
require_once 'admin/contact.php';
require_once 'admin/tinymce.php';
require_once 'admin/new-user-email.php';
require_once 'admin/media.php';

require_once 'abstraction/post-type.php';
require_once 'abstraction/taxonomy.php';

require_once 'structure/post.php';
require_once 'structure/page.php';

require_once 'theme/head.php';
require_once 'theme/scripts.php';
require_once 'theme/excerpt.php';
require_once 'theme/content.php';
require_once 'theme/classes.php';
require_once 'theme/support.php';
require_once 'theme/images.php';
require_once 'theme/format-meta.php';
/*
if ( $activate_layouts )
	require_once 'theme/layouts.php';
*/

// DASHBOARD
require_once 'dashboard/general.php';
require_once 'dashboard/dashboard-widget.php';
require_once 'dashboard/right-now.php';

// USERS
require_once 'users/general.php';
require_once 'users/roles.php';

// FUNCTIONS
require_once 'functions/ancestor.php';
require_once 'functions/author.php';
require_once 'functions/meta.php';
require_once 'functions/media.php';
require_once 'functions/menus.php';
require_once 'functions/pagination.php';
require_once 'functions/paths.php';
require_once 'functions/schema.php';
require_once 'functions/strings.php';
require_once 'functions/time.php';

// MEDIA
require_once 'media/featured-icon.php';

// SIDEBAR
require_once 'sidebar/section-navigation.php';


/*
** Root Plugin Class
*/

final class BS_Core {

	/*
	** Enforce that this plugin is loaded before all other plugins.
	** This ensures that the classes added here are immediately available to other plugins.
	*/

	public static function load_first() {
		$plugin_url = plugin_basename(__FILE__);
		$active_plugins = get_option('active_plugins', array());
		$key = array_search($plugin_url, $active_plugins);
		if (!$key) return;
		array_splice($active_plugins, $key, 1);
		array_unshift($active_plugins, $plugin_url);
		update_option('active_plugins', $active_plugins);
	}

	/*
	** Plugin-related Hooks
	*/

	public static function activation() {
		BS_Users_Roles::manipulate_roles();
	}

	public static function deactivation() {
		/* PLUGIN DEACTIVATION LOGIC HERE */
	}

	public static function uninstall() {
		/* PLUGIN DELETION LOGIC HERE */
	}

	public static function ready() {
		do_action('bs_ready');
	}

	public static function initialize() {

		// ADMIN
		BS_Admin_General::initialize();
		BS_Admin_Bar::initialize();
		BS_Admin_Menu::initialize();
		BS_Admin_TinyMCE::initialize();

		// DASHBOARD
		BS_Dashboard_General::initialize();
		BS_Right_Now_Widget::initialize();

		// USERS
		BS_Users_General::initialize();
		BS_Users_Roles::initialize();

		// PLUGIN ACTIONS
		add_action('activated_plugin', array(__CLASS__, 'load_first'));
		add_action('after_setup_theme', array(__CLASS__, 'ready'), 999);

	}

}
BS_Core::initialize();


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
