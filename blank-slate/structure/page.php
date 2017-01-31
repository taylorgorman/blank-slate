<?php
/*
** Modify Page post type
*/
add_action( 'init', function(){

	add_post_type_support( 'page', 'excerpt' );

	remove_post_type_support( 'page', 'trackbacks' );
	remove_post_type_support( 'page', 'comments' );
	remove_post_type_support( 'page', 'author' );

} );
