<?
/*
** Register post type
*/
function bs_register_post_type( $args ) {

	$v = wp_parse_args( $args, array(
		'ID'            => ''
	,	'singular_name' => ''
	,	'plural_name'   => ''
	,	'arguments'     => array()
	,	'labels'        => array()
	,	'supports'      => array()
	) );

	// Singular name is essential
	if ( empty($v['singular_name']) )
		return false;

	// ID can set itself
	if ( empty($v['ID']) )
		$v['ID'] = $v['singular_name'];

	// Uppercase names
	if ( empty($v['singular_name_uppercase']) )
		$v['singular_name_uppercase'] = ucwords($v['singular_name']);
	if ( empty($v['plural_name_uppercase']) )
		$v['plural_name_uppercase'] = ucwords($v['plural_name']);

	// Labels
	$labels = wp_parse_args( $v['labels'], array(
		'name'               => $v['plural_name_uppercase']
	,	'singular_name'      => $v['singular_name_uppercase']
	,	'add_new_item'       => 'Add New '.$v['singular_name_uppercase']
	,	'edit_item'          => 'Edit '.$v['singular_name_uppercase']
	,	'new_item'           => 'New '.$v['singular_name_uppercase']
	,	'view_item'          => 'View '.$v['singular_name_uppercase']
	,	'search_items'       => 'Search '.$v['plural_name_uppercase']
	,	'not_found'          => 'No '.$v['plural_name'].' found'
	,	'not_found_in_trash' => 'No '.$v['plural_name'].' found in Trash.'
	,	'parent_item_colon'  => 'Parent '.$v['singular_name_uppercase'].':'
	,	'all_items'          => 'All '.$v['plural_name_uppercase']
	) );

	// Supports
	$supports = wp_parse_args( $v['supports'], array(
		'title'
	,	'editor'
	,	'thumbnail'
	,	'excerpt'
	,	'revisions'
	) );

	// Register post type arguments
	$register_args = wp_parse_args( $v['arguments'], array(
		'labels'          => $labels
	,	'supports'        => $supports
	,	'public'          => true
	,	'menu_position'   => 20
	,	'hierarchical'    => false
	,	'has_archive'     => true
	,	'capability_type' => 'page'
	,	'rewrite'         => array(
			'with_front' => false
		)
	) );

	// Go go gadget
	register_post_type( $v['ID'], $register_args );

}
