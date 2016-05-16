<?php

/**
 * Take an icon name and return inline SVG for the icon.
 * @param  string $icon_name The ID of the icon in the defs list of the SVG file.
 * @param  string $viewbox   Optional viewbox size.
 * @param  string $echo      To output, or not to output. Set to 0 if using URL-query.
 */
function bs_isvg($args) {

	$defaults = array(
		'icon-name' => ''
	,	'viewbox'   => '0 0 32 32'
	,	'echo'      => true
	,	'path'      => get_stylesheet_directory_uri().'/img/icons.svg'
	);

	$vars = wp_parse_args( $args, $defaults );
	$icon = '<svg role="img" title="'. $vars['icon-name'] .'" class="icon '. $vars['icon-name'] .'" viewBox="'. $vars['viewbox'] .'"><use xlink:href="'. $vars['path'] .'#'. $vars['icon-name'] .'"></use></svg>';
	if ( $vars['echo'] == true ) {
		echo $icon;
	} else {
		return $icon;
	}
}

/**
 * Get a file's extension
 * @param 	string 	$file	the filename, as a string
 */
function bs_getExt($file) {
	if (is_string($file)) {
		$arr = explode('.',$file);
		end($arr);
		$ext = current($arr);
		return $ext;
	}
	return false;
}

