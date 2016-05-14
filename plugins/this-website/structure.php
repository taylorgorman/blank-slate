<?php
/*
** Post types
*/
bs_register_post_type(array(
	'singular_name' => 'project'
,	'plural_name'   => 'projects'
,	'arguments'     => array(
		'menu_icon'    => 'dashicons-clipboard'
	,	'hierarchical' => true
	)
));

/*
** Taxonomies
*/
bs_register_taxonomy(array(
	'post_types'    => 'project'
,	'singular_name' => 'poop'
,	'plural_name'   => 'poops'
));
