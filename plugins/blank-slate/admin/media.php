<?php
/*
** In admin, don't let users see each other's media
** if they don't have post edit priveleges.
*/
add_filter( 'pre_get_posts', function( $query ){

	$current_user = wp_get_current_user();

	if (
		is_admin() &&
		$query->get('post_type') == 'attachment' &&
		! current_user_can('edit_others_posts')
	) {
		$query->set('author', $current_user->data->ID);
	}

} );
