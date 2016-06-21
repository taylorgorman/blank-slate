<?
/*
** Menus
*/
add_action( 'after_setup_theme', function(){

	register_nav_menu( 'main', 'Main navigation' );

} );

/*
** Scripts & styles
*/
add_action('wp_enqueue_scripts', function(){

	wp_enqueue_style(
		get_template().'-styles'
	,	get_template_directory_uri().'/css/styles.css'
	,	false
	,	false
	,	'screen'
	);
	wp_enqueue_style(
		get_template().'-print'
	,	get_template_directory_uri().'/css/print.css'
	,	false
	,	false
	,	'print'
	);

	wp_enqueue_script(
		get_template().'-scripts'
	,	get_template_directory_uri().'/js/site-min.js'
	,	array('jquery')
	,	false
	,	true
	);

	/* Use these instead, if building a child theme
	**
	wp_enqueue_style(
		get_stylesheet().'-styles'
	,	get_stylesheet_directory_uri().'/css/styles.css'
	,	array( get_template().'-styles' )
	,	false
	,	'screen'
	);

	wp_enqueue_script(
		get_stylesheet().'-scripts'
	,	get_stylesheet_directory_uri().'/js/site-min.js'
	,	array( get_template().'-scripts' )
	,	false
	,	true
	);
	*/

});
