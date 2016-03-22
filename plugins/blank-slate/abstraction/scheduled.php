<?php

// Add "Occurs on" datepicker in Publish meta box
add_action( 'post_submitbox_misc_actions', function(){

	// Hide for now
	return;

	global $post;
	global $action;

	// Conditions
	if ( ! get_post_type($post) == 'project' ) return;

	// Safety first
	wp_nonce_field( 'save_occur', 'occur_nonce' );

	// Make the field
	$occur = get_post_meta($post->ID, '_occur', true);
	?>
	<div class="misc-pub-section occurtime misc-pub-occurtime">

		<span id="occurtime">Occurs on: <?php //printf($stamp, $date); ?></span>

		<a href="#edit_occurtime" class="edit-occurtime hide-if-no-js">
			<span aria-hidden="true"><?php _e( 'Edit' ); ?></span>
			<span class="screen-reader-text"><?php _e( 'Edit occur date and time' ); ?></span>
		</a>

		<fieldset id="occurtimediv" class="hide-if-js">
			<legend class="screen-reader-text"><?php _e( 'Occur date and time' ); ?></legend>
			<?php touch_time( ( $action === 'edit' ), 1 ); ?>
		</fieldset>
	</div>
	<?

} );

add_action( 'save_post', function( $post_id ){

	// Safety first
	if ( ! isset( $_POST['occur_nonce'] ) ) return;
	if ( ! wp_verify_nonce( $_POST['occur_nonce'], 'save_occur' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can('edit_others_posts') ) return;

	// Save data
	if ( isset( $_POST['occur'] ) )
		update_post_meta( $post_id, '_occur', $_POST['occur'] );
	else
		delete_post_meta( $post_id, '_occur' );

} );


// Sort posts by occur date
// Ascending order
// Date is higher than right now

