<?php
/*
** Sort posts by occur date
** Ascending order
** Date is higher than right now
*/
add_filter( 'pre_get_posts', function( $query ){

	$blank_slate_db = get_option('blank_slate');

	if ( empty($blank_slate_db['orderby'][$query->get('post_type')]) )
		return;

	$query->set('meta_key', $blank_slate_db['orderby'][$query->get('post_type')]);
	$query->set('orderby', 'meta_value');
	$query->set('order', $blank_slate_db['order'][$query->get('post_type')]);

} );

/*
** Add column to post type list screen
*/
