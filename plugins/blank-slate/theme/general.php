<?php

/**
 * Describes action/filter hooks for theme related functions
 */
final class BS_Theme_General {

//-----------------------------------------------------------------------------
// WP-HEAD ACTION MANIPULATIONS
//-----------------------------------------------------------------------------

	protected static $wp_head_actions_to_remove = array(
		array('feed_links_extra', 3),
		array('wp_generator'),
		array('rsd_link'),
		array('wlwmanifest_link'),
		array('index_rel_link'),
		array('start_post_rel_link', 10, 0),
		array('adjacent_posts_rel_link_wp_head', 10, 0)
	);

	public static function remove_wp_head_actions() {
		$actions = apply_filters('bs_wp_head_actions_to_remove', static::$wp_head_actions_to_remove);
		foreach($actions as $action) {
			array_unshift($action, 'wp_head');
			call_user_func_array('remove_action', $action);
		}
	}

//-----------------------------------------------------------------------------
// JQUERY
//-----------------------------------------------------------------------------

	public static function jquery() {

		if (is_admin())
			return;

		$google_url = '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js';
		$test_url = @fopen('http:'.$google_url, 'r');

		if ( false === $test_url ) {
			// Google CDN failed, keep using WordPress's
			return;
		}

		// Google CDN ok
		wp_deregister_script('jquery');
		wp_register_script('jquery', $google_url, false, false, true);

	}

//-----------------------------------------------------------------------------
// BODY CLASSES
//-----------------------------------------------------------------------------

	public static function body_class($classes) {
		global $wp_query;

		if (is_singular())
			$classes = static::post_class($classes);

		if (is_tax() || is_category() || is_tag())
			$classes = static::add_term_hierarchy(get_queried_object(), $classes);

		return array_unique($classes);
	}

	public static function post_class($classes) {
		global $post;

		//add slug
		array_push($classes, $post->post_name);

		//add all taxonomy terms & their parents
		$taxonomies = get_object_taxonomies($post);
		$terms = wp_get_object_terms($post->ID, $taxonomies);
		foreach($terms as $term) $classes = static::add_term_hierarchy($term, $classes);

		return array_unique($classes);
	}

	protected static function add_term_hierarchy($term, $classes) {
		do {
			array_push($classes, sprintf('%s-%s', $term->taxonomy, $term->slug));
			$term = get_term_by('id', $term->parent, $term->taxonomy);
		} while($term);
		return $classes;
	}

//-----------------------------------------------------------------------------
// EXCERPT FUNCTIONS
//-----------------------------------------------------------------------------

	public static function excerpt_length($length) { return 35; }

	public static function excerpt_more($more) { return '…'; }

//-----------------------------------------------------------------------------
// INITIALIZATION
//-----------------------------------------------------------------------------

	/**
	 * Adds all filter & action hooks to WP to handle when necessary
	 * @access public
	 */
	public static function initialize() {
		$cls = __CLASS__;
		add_action('bs_ready',           array($cls, 'remove_wp_head_actions'));
		add_action('wp_enqueue_scripts', array($cls, 'jquery'));
		add_filter('body_class',         array($cls, 'body_class'));
		add_filter('post_class',         array($cls, 'post_class'));
		add_filter('excerpt_more',       array($cls, 'excerpt_more'));
		add_filter('excerpt_length',     array($cls, 'excerpt_length'));
	}

}

/*
** Prevent empty paragraphs around shortcodes
*/
add_filter( 'the_content', function ( $content ) {

	return strtr( $content, array(
		'<p>['    => '['
	,	']</p>'   => ']'
	,	']<br />' => ']'
	) );

} );
