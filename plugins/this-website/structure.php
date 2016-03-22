<?php
/*
** Register all the things
**
** Old method with object
**
class project extends bs_post_type {

	protected static $singular_name = 'project';
	protected static $plural_name   = 'projects';
	protected static $arguments     = array(
		'menu_icon'    => 'dashicons-clipboard'
	,	'hierarchical' => true
	);

} project::initialize();
*/

bs_register_post_type(array(
	'singular_name' => 'project'
,	'plural_name'   => 'projects'
,	'arguments'     => array(
		'menu_icon'    => 'dashicons-clipboard'
	,	'hierarchical' => true
	)
));

bs_register_taxonomy(array(
	'post_types'    => 'project'
,	'singular_name' => 'poop'
,	'plural_name'   => 'poops'
));


/* This would be my original idea for registering post types
** but I think it's not possible because we can't add filters or actions
** inside these functions. That would be functions inside functions.
**
add_action( 'init', function(){

	bs_register_post_type(array(
		'singular_name' => 'project'
	,	'plural_name'   => 'projects'
	));

	bs_register_post_type(array(
		'ID'            => 'news'
	,	'singular_name' => 'article'
	,	'plural_name'   => 'news'
	));

} );
*/