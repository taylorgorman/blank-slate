<?php
/*
** Call jQuery from Google
*/
add_action( 'wp_enqueue_scripts', function(){

	if ( is_admin() )
		return;

	$google_url = '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js';
	$test_url = @fopen('http:'.$google_url, 'r');

	// Google CDN failed, keep using WordPress's
	if ( false === $test_url )
		return;

	// Google CDN ok
	wp_deregister_script('jquery');
	wp_register_script('jquery', $google_url, false, false, true);

} );
