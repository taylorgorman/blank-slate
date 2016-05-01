<?php
/*
** Modify Post post type
*/
add_action( 'init', function(){

	remove_post_type_support( 'post', 'trackbacks' );

} );
