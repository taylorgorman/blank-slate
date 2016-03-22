<?php

/*
** Register settings
*/
add_action('admin_init', function(){
	register_setting( 'contact_info_settings', 'contact_info' );
});

/*
** Create subpage
*/
add_action('admin_menu', function(){
	add_submenu_page( 'options-general.php', 'Contact Settings', 'Contact', 'publish_pages', 'contact-info', 'bs_contact_info_screen' );
});

/*
** Form field markup
**
** This should be a global Blank Slate tool and should be moved elsewhere.
** Need layout for side-by-side labels and inputs like WordPress default. Could just detect whether any fields have cols set.
*/
function field_markup( $fields ) {

	// Markup before fields
	echo '<div class="form-table">';

	// Default field data
	$defaults = array(
		'type' => 'text'
	,	'label' => ''
	,	'name' => ''
	,	'placeholder' => ''
	,	'desc' => ''
	,	'cols' => 0
	);

	foreach ( $fields as $field ) {

		$v = wp_parse_args($field, $defaults);

		// Label is required
		if ( empty($v['label']) )
			continue;

		// Name derived from label
		if ( empty($v['name']) )
			$v['name'] = sanitize_title($v['label']);

		// Display markup for different input types
		switch ( $v['type'] ) {

			case 'checkbox' :
				/*
				$markup = '<label for="'. $id .'"><input type="checkbox" name="contact_info['. $id .']" id="'. $id .'" value="1" '. checked('1', $values[$id], 0) .' />';
				if ( $desc ) $markup .= $desc;
				$markup .= '</label>';
				*/
			break;

			default :
			?>
			<div class="field cols<?= $v['cols'] ?>">
				<label for="<?= $v['name'] ?>"><?= $v['label'] ?></label>
				<input type="<?= $v['type'] ?>" name="contact_info[<?= $v['name'] ?>]" id="<?= $v['name'] ?>" placeholder="<?= $v['placeholder'] ?>" value="<?= get_contactinfo($v['name'], 0) ?>" <? if ( $v['desc'] ) echo 'aria-describedby="'. $v['name'] .'-description"'; ?>>
				<? if ( $v['desc'] ) echo '<p class="description" id="'. $v['name'] .'-description">'. $v['desc'] .'</p>'; ?>
			</div>
			<?

		}

	}

	// Markup after fields
	echo '</div>';

}

/*
** Markup for admin screen
*/
function bs_contact_info_screen() {

	?>
	<style>
		.description code {
			font-size: 12px;
		}
		[class*=cols] {
			float: left;
			box-sizing: border-box;
			padding-right: 20px;
			width: 100%;
		}
		.cols2 {
			width: 50%;
		}
		.cols3 {
			width: 33.3%;
		}
		.cols4 {
			width: 25%;
		}
		div.form-table {
			overflow: hidden;
			max-width: 50em;
			padding-bottom: 15px;
		}
		h3 + p.description {
			margin-top: -.75em;
		}
		div.form-table label {
			font-weight: 600;
			display: block;
			padding: 0 0 4px 2px;
		}
		div.form-table .field {
			padding-top: 20px;
		}
		div.form-table .field input {
			width: 100%;
		}
		@media (max-width:780px) {
			div.form-table .field {
				padding-top: 15px;
			}
		}
		@media (max-width:500px) {
			[class*=cols] {
				width: 100%;
				padding-right: 10px;
			}
		}
	</style>
	<div class="wrap">

		<h2>Contact Settings</h2>

		<form method="post" action="options.php">
		<?
		settings_fields('contact_info_settings');
		$v = get_option('contact_info');

		/* Proposed changes to allow markup exceptions
		**
		field_markup(array(
			'before_fields' => '<div class="mycoolthing">'
		,	'during_fields' => '<h2>%1$s</h2><div class="whaaaaat">%2$s</div>'
		,	'after_fields'  => '</div>'
		,	'fieldgroup'    => 'contact_info' // Will make field names "fieldgroup[id]"
		,	'fields'        => array(
				array(
					'type' => 'text'
				,	'label' => 'Get At This'
				,	'name' => 'contact_info[get-at-this]'
				,	'id' => 'get-at-this'
				,	'placeholder' => 'Default poop'
				,	'desc' => 'Type something, dummy'
				,	'cols' => 2
				)
			,	array(
					'label' => 'Or This'
				)
		)
		));
		*/

		field_markup(array(
			array(
				'label' => 'Company Name'
			,	'placeholder' => get_bloginfo('name')
			,	'cols'  => 2
			,	'desc' => 'Fallback is Site Title in <a href="/wp-admin/options-general.php">Settings / General</a>.'
			)
		,	array(
				'label' => 'Catch-all Email'
			,	'placeholder' => get_bloginfo('admin_email')
			,	'cols'  => 2
			,	'desc' => 'Fallback is E-mail Address in <a href="/wp-admin/options-general.php">Settings / General</a>.'
			)
		));
		?>

		<h3><input type="number" name="contact_info[locations-count]" value="<?= get_contactinfo('locations-count') ?>" style="width:3em">
		Locations</h3>
		<p class="description">Save Changes to update number of fields below.</p>

		<?
		$fields = array();
		for ( $i=1; $i<=get_contactinfo('locations-count'); $i++ ) {
			$fields = array(
				array(
					'label' => 'Location '.$i.' Name'
				,	'name' => 'location-name-'.$i
				,	'cols'  => 2
				)
			,	array(
					'label' => 'Street Address'
				,	'name' => 'street-address-'.$i
				,	'cols'  => 2
				)
			,	array(
					'label' => 'City'
				,	'name' => 'city-'.$i
				,	'cols'  => 2
				)
			,	array(
					'label' => 'State'
				,	'name' => 'state-'.$i
				,	'cols'  => 4
				)
			,	array(
					'label' => 'Zip'
				,	'name' => 'zip-'.$i
				,	'cols'  => 4
				)
			,	array(
					'label' => 'Phone'
				,	'name' => 'phone-'.$i
				,	'cols'  => 2
				)
			,	array(
					'label' => 'Fax'
				,	'name' => 'fax-'.$i
				,	'cols'  => 2
				)
			);
			field_markup( $fields );
		}
		?>

		<h3>Social Networks</h3>
		<p class="description">Make sure to include the http:// for all URLs.</p>

		<?
		field_markup(array(
			array(
				'label' => 'Facebook URL'
			)
		,	array(
				'label' => 'Twitter Username'
			)
		,	array(
				'label' => 'Instagram Username'
			)
		,	array(
				'label' => 'Tumblr URL'
			)
		,	array(
				'label' => 'Linkedin URL'
			)
		));

		submit_button();
		?>
		</form>

	</div>
	<?

}

/*
** Just an easy way to echo get_contactinfo
*/
function contactinfo( $name = '', $fallback = '' ) {
	echo get_contactinfo( $name, $fallback );
}

/*
** Retrieve all this stuff here
** Only pulls from the database once
*/
function get_contactinfo( $name = '', $fallback = '' ) {

	// Get from global, or from database
	global $contact_info;
	if ( empty($contact_info) )
		$contact_info = get_option('contact_info');

	// If no specific value requested, you must want the whole thing
	if ( empty($name) )
		return $contact_info;

	// Requested doesn't exist
	if ( empty($contact_info[$name]) ) {

		// Specified fallback
		if ( ! empty($fallback) )
			return $fallback;

		// Alternates
		if ( is_string($fallback) ) { switch ( $name ) {

			case 'company-name' :
				return get_bloginfo('name');

			case 'catch-all-email' :
				return get_bloginfo('admin_email');

			case 'locations-count' :
				return 1;

			default :
				return $fallback;

		} }

		// Or bail
		return false;

	}

	// Return requested value
	return $contact_info[$name];

}

/*
** Easy way to just get URLs
*/
function get_socialurls( $network='' ) {

	$urls = array(
		'facebook' => get_contactinfo('facebook-url')
	,	'twitter' => 'https://twitter.com/'.get_contactinfo('twitter-username')
	,	'instagram' => 'https://instagram.com/'.get_contactinfo('instagram-username')
	,	'tumblr' => get_contactinfo('tumblr-url')
	,	'linkedin' => get_contactinfo('linkedin-url')
	);

	if ( empty($network) )
		return $urls;

	if ( empty($urls[$network]) )
		return false;

	return $urls[$network];

}
