<?php

/**
 * Take an icon name and return inline SVG for the icon.
 * @param  string $icon_name The ID of the icon in the defs list of the SVG file.
 * @param  string $viewbox   Optional viewbox size.
 * @param  string $echo      To output, or not to output. Set to 0 if using URL-query.
 */
function bs_isvg($args) {

	$defaults = array(
		'icon-name'	=> ''
	,	'viewbox' 	=> '0 0 32 32'
	,	'echo'		=> true
	,	'path'      => bs_theme_url('/img/icons.svg')
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
 * Take a timestamp and turn it in to human timing.
 * @param  timestamp $time      To output, or not to output. Set to 0 if using URL-query.
 */
function bs_human_timing ($time, $cutoff=2) {

	$current_time = current_time('timestamp');
    $time = $current_time - $time; // to get the time since that moment

    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
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

