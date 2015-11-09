<?
/*
** Add meta box to every post type edit screen
*/
add_action( 'add_meta_boxes', function() {

	// Get all post types except system's
	$post_types = get_post_types();

	// Go for it
	foreach ( $post_types as $pt ) { if ( post_type_supports( $pt, 'post-formats' ) ) {

		add_meta_box(
			'format-meta'
		,	'Format Data'
		,	'format_meta_content'
		,	$pt
		);

	} }

} );


/*
** Meta box content
*/
function format_meta_content( $post ) {

	// Security
	wp_nonce_field( 'format_meta_save_metabox', 'format_meta_nonce' );

	// Get data
	$permalink = get_post_meta( $post->ID, '_format_permalink', true );

	?>
	<table class="form-table">
	<tr>
		<th><label>Custom URL</label></th>
		<td>
			<input type="text" name="format_permalink" value="<?= $permalink ?>" class="regular-text">
			<p class="description">This URL will override the permalink for this post. Include "http://" or the link will not work.</p>
		</td>
	</tr>
	</table>
	<?

}

/*
** Saving actions
*/
add_action( 'save_post', function( $post_id ) {

	// Security
	if ( ! isset( $_POST['format_meta_nonce'] ) ) return;
	if ( ! wp_verify_nonce( $_POST['format_meta_nonce'], 'format_meta_save_metabox' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// Save data
	update_post_meta( $post_id, '_format_permalink', $_POST['format_permalink'] );

} );
