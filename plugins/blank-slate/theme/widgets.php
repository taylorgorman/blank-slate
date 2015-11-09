<?php

class BS_Theme_Widgets {

	/**
	 * Default values for a sidebar args array
	 * @var array
	 */
	private static $sidebar_default = array(
		'before_widget' => '<div id="%1$s" class="widget %2$s" role="sidebar">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="title">',
		'after_title'   => '</h3>'
	);

	/**
	 * Sidebars to be available on a fresh install
	 * @var array
	 */
	private static $sidebars = array();

	/**
	 * Adds sidebars to the wordpress install, allowing widgets to be added by the
	 * client
	 * @access public
	 */
	public static function add_sidebars() {
		$sidebars = apply_filters('bs_sidebars', static::$sidebars);
		foreach ($sidebars as $args) {
			$args = wp_parse_args($args, static::$sidebar_default);
			register_sidebar($args);
		}
	}

	public static function initialize() {

		add_action('widgets_init', array(__CLASS__, 'add_sidebars'));

	}

}
