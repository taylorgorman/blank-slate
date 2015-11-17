<?
/*
** Modify theme supports
*/
add_filter( 'bs_theme_support', function( $features ){

	$features['post-formats'] = array('link', 'gallery', 'quote');
	return $features;

} );

/*
** Modify new image sizes

add_filter( 'bs_image_sizes', function( $sizes ){

	// Prevent Blank Slate's default sizes
	return false;

	// Add new size
	$sizes[] = array(
		'slideshow' => array(
			'width'  => 1280
		,	'height' => 400
		,	'crop'   => true
		)
	)
	return $sizes;

} );
*/

/*
** Modify default image sizes

add_filter( 'bs_wp_image_sizes', function( $sizes ){

	$sizes['thumbnail']['width']  = 200;
	$sizes['thumbnail']['height'] = 200;
	return $sizes;

} );
*/
