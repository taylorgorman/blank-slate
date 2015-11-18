<?php
/*
** Register all the things
*/
class project extends bs_post_type {

	protected static $singular_name = 'project';
	protected static $plural_name   = 'projects';
	protected static $arguments     = array(
		'menu_icon'    => 'dashicons-clipboard'
	,	'hierarchical' => true
	);

} project::initialize();

/*
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

	bs_register_taxonomy(array(
		'post_types'    => 'project'
	,	'singular_name' => 'client'
	,	'plural_name'   => 'clients'
	));

} );
*/