<?php

class BS_Admin_General {

	public static function add_favicon() {
		$subdomain = bs_get_subdomain();
		$prefix = '';
		$suffix = '';
		if ( $subdomain == 'dev' ) {
			$suffix = '-dev';
		}
		if ( is_admin() ) {
			$prefix = 'admin-';
		}
		$favicon_url = get_stylesheet_directory_uri() . '/img/'. $prefix .'favicon'. $suffix .'.ico';
		echo '<link rel="shortcut icon" href="'. $favicon_url .'" />';
	}

	public static function hide_upgrade_notices() {
		if (!current_user_can('update_core'))
			add_filter('pre_site_transient_update_core', function($a) { return null; });
	}

	public static function enqueue_scripts() {
		global $wp_scripts;
		$ui = $wp_scripts->query('jquery-ui-core');

		wp_enqueue_media();

		wp_enqueue_style(
			'bs_jquery-ui-smoothness',
			"//ajax.googleapis.com/ajax/libs/jqueryui/{$ui->ver}/themes/smoothness/jquery-ui.css",
			false,
			null
		);
		wp_enqueue_style('bs_admin_styles', BS_URL.'resources/css/admin.css');

		wp_enqueue_script('bs_admin_scripts', BS_URL.'resources/js/admin.js', array(
			'jquery',
			'jquery-ui-datepicker',
			'jquery-ui-slider'
		));
	}

	public static function initialize() {
		add_action('login_head', array(__CLASS__, 'add_favicon'));
		add_action('admin_head', array(__CLASS__, 'add_favicon'));
		add_action('wp_head',    array(__CLASS__, 'add_favicon'));
		add_action('after_setup_theme', array(__CLASS__, 'hide_upgrade_notices'));
		add_action('admin_enqueue_scripts', array(__CLASS__, 'enqueue_scripts'));
	}
}