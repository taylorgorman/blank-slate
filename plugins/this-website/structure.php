<?
/*
** Register all the things
*/
class capability extends bs_post_type {

	protected static $ID = 'capability';

	protected static $args = array(
		'label' => 'Capabilities'
	,	'labels' => array(
			'singular_name' => 'Capability'
		)
	,	'menu_icon' => 'dashicons-clipboard'
	,	'hierarchical' => true
	);

}
capability::initialize();

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