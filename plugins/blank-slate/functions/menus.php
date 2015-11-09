<?php

/*
** Convert <li><a></a></li> pattern to <a></a> pattern, transferring all <li> attributes to the <a>
** @param  string $s String to manipulate. Duh.
** @return string    Manipulated string
*/
function lia2a($string) {

	if (!is_string($string))
		return $string;

	$find = array('><a','</a>','<li','</li');
	$replace = array('','','<a','</a');
	$return = str_replace($find, $replace, $string);

	return $return;

}

/*
** Display requested nav menu, but strip out <ul>s and <li>s
** @param  string $menu_name Same as 'menu' in wp_nav_menu arguments. Allows simple retrieval of menu with just the one argument
** @param  array  $args      Passed directly to wp_nav_menu
**
** TO DO
** Need to add role="navigation" to the <nav> tag
*/
function bs_nav_menu($menu_name='', $args=array()) {

	$defaults = array(
		'menu'            => $menu_name
	,	'container'       => 'nav'
	,	'container_class' => sanitize_title($menu_name)
	,	'depth'           => 1
	,	'fallback_cb'     => false
	,	'items_wrap'      => PHP_EOL.'%3$s'
	,	'echo'            => false
	);
	$vars = wp_parse_args($args, $defaults);

	// If requested menu doesn't exist, cut and run
	if ( ! $menu = wp_nav_menu($vars) ) return false;

	// Remove <li>'s
	$menu = lia2a($menu);

	echo trim($menu).PHP_EOL;
}

/*
** Build contextually aware section navigation
*/
function bs_subnav($options=array()) {

	if (is_search() || is_404())
		return false;

	$defaults = array(
		'header'	=> '<h2 class="title">In this Section</h2>'
	,	'ul_id' => ''
	,	'ul_class' => ''
	);
	$vars = wp_parse_args( $options, $defaults );

	$list_options = array(
		'title_li'         => 0
	,	'show_option_none' => 0
	,	'echo'             => 0
	);

	$before = '<nav class="section">'. $vars['header'] .'<ul id="'. $vars['ul_id'] .'" class="'. $vars['ul_class'] .'">'.PHP_EOL;
	$after = '</ul></nav>'.PHP_EOL;
	$list = '';

	// Taxonomy archives
	// Includes categories, tags, custom taxonomies
	// Does not include date archives
	if (is_tax()) {

		$query_obj = get_queried_object();

		if (isset($options['list_options'][$query_obj->taxonomy]))
			$list_options = wp_parse_args($options['list_options'][$query_obj->taxonomy], $list_options);

		$list_options['taxonomy'] = $query_obj->taxonomy;
		$list = wp_list_categories($list_options);

	}

	// Post types
	else {
		global $post;

		// Only if we have a post
		if ($post) {

			// Hierarchical post types show sub post lists
			if (is_post_type_hierarchical($post->post_type)) {

				$list_options['post_type'] = $post->post_type;
				if ($post->post_type == 'page') {
					$ancestor = get_highest_ancestor();
					$list_options['child_of'] = $ancestor['id'];
				}

				if (isset($options['list_options'][$post->post_type]))
					$list_options = wp_parse_args($options['list_options'][$post->post_type], $list_options);

				$list = wp_list_pages($list_options);

			}

			// Non-hierarchical post types show specified taxonomy lists
			else {

				if (isset($options['list_options'][$post->post_type]))
					$list_options = wp_parse_args($options['list_options'][$post->post_type], $list_options);

				$list = wp_list_categories($list_options);

			}

		}
	}

	// If there's no text inside the tags, the list is empty
	if (!strip_tags($list))
		return false;

	return $before.$list.$after;

}
