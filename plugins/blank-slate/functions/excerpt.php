<?php
/*
** Filter WordPress defaults
*/
add_filter( 'excerpt_length', function(){ return 35; }, 999 );

add_filter( 'excerpt_more', function(){ return '&hellip;'; }, 999 );

add_filter( 'the_excerpt', function( $excerpt ){

	$excerpt = shortcode_unautop( $excerpt );
	$excerpt = do_shortcode( $excerpt );
	return '<div class="excerpt">'. $excerpt .'</div>';

} );

/*
** Functions
**
** Look into using wp_trim_excerpt here. Most of this is replicating that.
*/
function bs_get_excerpt( $post = false, $max_words = false, $truncate = true ) {

	if ( !is_object($post) )
		global $post;

	// Set max words
	if ( !$max_words )
		$max_words = apply_filters('excerpt_length', true);

	// Get excerpt text
	$has_excerpt = true;
	$excerpt = $post->post_excerpt;
	if (!$excerpt) {
		$excerpt = strip_tags(strip_shortcodes($post->post_content));
		$has_excerpt = false;
	}

	// Return full excerpt
	if (!$truncate && $has_excerpt)
		return $excerpt;

	// Truncate
	$words = explode(' ', $excerpt);
	if (count($words) > $max_words) {
		array_splice($words, $max_words);
		$excerpt = implode(' ', $words) . apply_filters('excerpt_more', true);
	}

	// Return truncated
	return $excerpt;

}
