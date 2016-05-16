<?php
/*
** Add "Occurs on" datepicker in Publish meta box
*/
add_action( 'post_submitbox_misc_actions', function(){

	// Hide for now
	//return;

	global $post;
	global $action;

	// Conditions
	if ( get_post_type($post) != 'project' ) return;

	// Safety first
	wp_nonce_field( 'save_occur', 'occur_nonce' );

	// Make the field
	$occurtime = get_post_meta($post->ID, '_occurtime', true);
	if ( !$occurtime ) $occurtime = time();
	?>
	<div class="misc-pub-section occurtime misc-pub-occurtime">

		<i class="dashicons dashicons-clock" style="color:#81878C"></i>
		<span id="occurtime">Occurs on: <b><?= date( 'M j, Y @ H:i', $occurtime ) ?></b></span>

		<a href="#edit_occurtime" class="edit-occurtime hide-if-no-js">
			<span aria-hidden="true"><?php _e( 'Edit' ); ?></span>
			<span class="screen-reader-text"><?php _e( 'Edit occur date and time' ); ?></span>
		</a>

		<fieldset id="occurtimediv" <?/*class="hide-if-js"*/?>>
			<legend class="screen-reader-text"><?php _e( 'Occur date and time' ); ?></legend>
			<div class="occurstamp-wrap">
				<label>
					<span class="screen-reader-text">Month</span>
					<select id="occur_month" name="occur_month">
					<?
					foreach ( array( 'NONE-', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ) as $n => $m ) {
						echo '<option value="'. sprintf( '%02d', $n ) .'" data-text="'. $m .'" '. selected($n, date('n', $occurtime)) .'>'. ( $n > 0 ? sprintf( '%02d', $n ) : '' ) .'-'. $m .'</option>';
					}
					?>
					</select>
				</label>
				<label>
					<span class="screen-reader-text">Day</span>
					<input type="text" id="jj" name="occur_day" value="<?= date('j', $occurtime) ?>" size="2" maxlength="2" autocomplete="off">
				</label>,
				<label>
					<span class="screen-reader-text">Year</span>
					<input type="text" id="aa" name="occur_year" value="<?= date('Y', $occurtime) ?>" size="4" maxlength="4" autocomplete="off">
				</label> @
				<label>
					<span class="screen-reader-text">Hour</span>
					<input type="text" id="hh" name="occur_hour" value="<?= date('H', $occurtime) ?>" size="2" maxlength="2" autocomplete="off">
				</label>:
				<label>
					<span class="screen-reader-text">Minute</span>
					<input type="text" id="mn" name="occur_minute" value="<?= date('i', $occurtime) ?>" size="2" maxlength="2" autocomplete="off">
				</label>
			</div>
		</fieldset>

	</div>
	<?

} );

/*
** Save data
*/
add_action( 'save_post', function( $post_id ){

	// Safety first
	if ( ! isset( $_POST['occur_nonce'] ) ) return;
	if ( ! wp_verify_nonce( $_POST['occur_nonce'], 'save_occur' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can('edit_others_posts') ) return;

	// Save data
	if ( $_POST['occur_month'] > 0 ) {
		update_post_meta( $post_id, '_occurtime', strtotime( $_POST['occur_month'] .'/'. $_POST['occur_day'] .'/'. $_POST['occur_year'] .' '. ( $_POST['occur_hour'] ? $_POST['occur_hour'] : 00 ) .':'. ( $_POST['occur_minute'] ? $_POST['occur_minute'] : 00 ) ) );
	} else {
		delete_post_meta( $post_id, '_occurtime' );
		//echo 'DELETED';
	}

} );

/*
** Sort posts by occur date
** Ascending order
** Date is higher than right now
*/
add_filter( 'pre_get_posts', function( $query ){

	/*
	if ( $query->get('post_type') != 'project' ) return;

	$query->set('meta_key', '_occurtime');
	$query->set('orderby', 'meta_value');
	$query->set('order', 'ASC');
	*/

} );

/*
** Add another date column for occurs date on post type list screen
*/
