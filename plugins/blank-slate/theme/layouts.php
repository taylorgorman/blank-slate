<?
/*
** Add meta box to every post type edit screen
*/
add_action( 'add_meta_boxes', function() {

	// Get all post types except system's
	$post_types = get_post_types();
	unset( $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item'] );

	// Go for it
	foreach ( $post_types as $post_type ) {

		add_meta_box(
			'layouts'
		,	'Layout Options'
		,	'layouts_metabox_content'
		,	$post_type
		,	'side'
		, 'core'
		);
	}

} );

/*
** Get layouts data
** since this is used multiple times
*/
function get_layouts( $post_id=0 ) {

	// Find the post ID
	if ( $post_id == 0 ) {
		global $post;
		$post_id = $post->ID;
	}

	// Get data
	$data = get_post_meta( $post_id, '_layouts', true );

	// Always an array to prevent PHP warnings
	if ( ! is_array($data) ) $data = array();

	return $data;

}

/*
** Meta box content
*/
function layouts_metabox_content( $post ) {

	// Security
	wp_nonce_field( 'layouts_save_metabox', 'layouts_nonce' );

	// Get data
	$data = get_layouts($post->ID);

	// Display fields
	foreach ( array(
		'centered-excerpt'
	,	'excerpt-in-header'
	,	'excerpt-beside-header'
	,	'title-in-excerpt'
	) as $class ) {

		echo '<label>';
		echo '<input type="checkbox" name="layouts[]" value="'. $class .'" '. checked( in_array($class, $data), true, 0 ) .'>';
		echo ' '. $class .'</label><br>';

	}

}

/*
** Saving actions
*/
add_action( 'save_post', function( $post_id ) {

	// Security
	if ( ! isset( $_POST['layouts_nonce'] ) ) return;
	if ( ! wp_verify_nonce( $_POST['layouts_nonce'], 'layouts_save_metabox' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can('edit_pages') ) return;

	// Save data
	if ( empty( $_POST['layouts'] ) )
		delete_post_meta( $post_id, '_layouts' );
	else
		update_post_meta( $post_id, '_layouts', $_POST['layouts'] );

} );

/*
** Add layout classes to body class
*/
add_filter( 'body_class', function( $classes ) {

	// Get data
	$data = get_layouts($post->ID);

	// Add layout classes to existing body classes
	if ( ! empty($data) )
		$classes = array_merge($classes, $data['classes']);

	// Return
	return array_unique($classes);

} );

/*
** Conditional statements
*/
function is_layout_class( $class_name ) {

	// Only singular templates will have post meta
	if ( ! is_singular() )
		return false;

	$data = get_layouts($post->ID);

	if ( $data['classes'][$class_name] )
		return true;
	else
		return false;

}