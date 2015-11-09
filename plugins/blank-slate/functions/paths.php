<?php

/*
** Get theme file path. Get child path if the file exists, otherwise get parent path.
**
** @param  string $path Path relative to the theme to a file/directory
** @return string       Absolute path to theme resource
*/
function bs_theme_url($path) {

	// Providing no path just dumps the stylesheet uri
	if ( empty($path) )
		return trailingslashit( get_stylesheet_directory_uri() );

	// Check in child theme first
	if ( is_child_theme() && file_exists( trailingslashit( get_stylesheet_directory() ) . $path ) )
		return trailingslashit( get_stylesheet_directory_uri() ) . $path;

	// Or return parent
	return trailingslashit( get_template_directory_uri() ) . $path;

}

/**
 * Get path to files in the theme safely
 * @param  string $path Path relative to the theme to a file/directory
 * @return string       Absolute path to theme resource
 */
function bs_theme_path($path) {
	$path = ltrim(trim($path), '/');
	$base = trailingslashit(get_stylesheet_directory());
	return $base.$path;
}

function bs_get_subdomain() {
	$http = $_SERVER['HTTP_HOST'];
	$domain_array = explode(".", $http);
	$subdomain = array_shift($domain_array);
	return $subdomain;
}
