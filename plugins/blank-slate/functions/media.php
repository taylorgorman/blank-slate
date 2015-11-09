<?php
function get_post_thumbnail_url($post_id=0, $size='') {

	if ( $post_id == 0 )
		return false;

	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), $size );

	return $thumb['0'];

}
