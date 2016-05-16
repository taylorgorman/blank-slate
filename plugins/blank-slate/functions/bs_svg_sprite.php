<?php
/*
** Generate HTML for SVG sprite with use tag
**
** @param  string $id       The ID of the icon in the defs list of the SVG file
** @param  string $viewbox  SVG viewBox attribute
** @param  string $echo     Echo or not
*/
function bs_svg_sprite( $args ) {

	$v = wp_parse_args( $args, array(
		'id'      => ''
	,	'viewbox' => '0 0 32 32'
	,	'echo'    => true
	,	'path'    => get_stylesheet_directory_uri().'/img/sprite.svg'
	) );

	$html = '<svg role="img" class="sprite '. $v['id'] .'" title="'. $v['id'] .'" viewBox="'. $v['viewbox'] .'">'
	.'<use xlink:href="'. $v['path'] .'#'. $v['id'] .'"></use>'
	.'</svg>';

	if ( $v['echo'] )
		echo $html;
	else
		return $html;

}
