<?php

/*
** Creates a nicely formatted and more specific title element text
** for output in head of document, based on current view.
**
** @access public
** @param  string $sep   Separator
** @return string        Filtered title
*/
function bs_title( $sep ) {

	global $paged, $page;

	$title = wp_title($sep, false, 'right');

	// Add site name
	$title .= get_bloginfo('name');

	// Add site description on home page
	if ( is_front_page() && $description = get_bloginfo('description', 'display') )
		$title .= " $sep ". $description;

	// Add a page number if necessary
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep Page ". max($paged, $page);

	echo $title;

}


/**
 * Returns an appropriate description for the current page. Can be modified
 * using the bs_description filter.
 *
 * @access public
 */
function bs_description() {

	$desc = '';

	if ( is_singular() && !is_front_page() && !is_home() )
		$desc = get_trimmed_excerpt( get_queried_object() );

	if ( strlen($desc) == 0 )
		$desc = get_bloginfo('description', 'display');

	echo apply_filters( 'bs_description', strip_tags($desc) );

}
