<?php
/*
** Enqueue scripts and styles? Want to check into this later.
*/
add_action( 'admin_enqueue_scripts', function(){

	//wp_enqueue_media();

	wp_enqueue_style(
		'bs_admin_styles'
	,	BS_URL.'css/admin.css'
	);

	wp_enqueue_script(
		'bs_admin_scripts'
	,	BS_URL.'js/admin.js'
	,	array(
			'jquery'
		,	'jquery-ui-datepicker'
		,	'jquery-ui-slider'
		)
	);

} );
