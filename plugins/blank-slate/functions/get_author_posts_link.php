<?php
/*
** Like the_author_posts_link, but returns instead of displays.
**
** @param  object  $post
*/
function get_author_posts_link( $post = false ) {

	if ( ! is_object($post) )
		global $post;

	return '<a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'" rel="author">'. get_the_author_meta( 'display_name' ) .'</a>';

}
