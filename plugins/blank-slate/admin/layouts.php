<?
/*
** Create layout taxonomy
*/
bs_register_taxonomy( array(
	'singular_name' => 'layout'
,	'plural_name' => 'layouts'
,	'post_types'    => get_post_types(array('show_ui'=>true))
) );
