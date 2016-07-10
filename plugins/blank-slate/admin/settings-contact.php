<?php
/*
** Register settings
*/
add_action( 'admin_init', function(){
	register_setting( 'contact_info_settings', 'contact_info' );
} );

/*
** Create subpage
*/
add_action( 'admin_menu', function(){
add_submenu_page( 'options-general.php', 'Contact Settings', 'Contact', 'publish_pages', 'contact-info', function(){

	?>
	<style>
		input#contact_info-locations-count {
			width: 3em;
		}
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
		$contact_info_db = get_option('contact_info');
		//echo '<pre>'.print_r($contact_info_db,1).'</pre>';

		admin_fields(array(
			'group_name' => 'contact_info'
		,	'fields'     => array(
				array(
					'label'       => 'Company Name'
				,	'placeholder' => get_bloginfo('name')
				,	'value'       => $contact_info_db['company-name']
				,	'cols'        => 2
				,	'desc'        => 'Fallback is Site Title in <a href="/wp-admin/options-general.php">Settings / General</a>.'
				)
			,	array(
					'label'       => 'Catch-all Email'
				,	'placeholder' => get_bloginfo('admin_email')
				,	'value'       => $contact_info_db['catch-all-email']
				,	'cols'        => 2
				,	'desc'        => 'Fallback is E-mail Address in <a href="/wp-admin/options-general.php">Settings / General</a>.'
				)
			)
		));

		admin_fields(array(
			'group_name'    => 'contact_info'
		,	'before_fields' => ''
		,	'during_fields' => '<h3>%2$s %1$s</h3>%3$s'
		,	'after_fields'  => ''
		,	'fields'        => array(
				array(
					'type'  => 'number'
				,	'label' => 'Locations'
				,	'name'  => 'locations-count'
				,	'value' => $contact_info_db['locations-count']
				,	'desc'  => 'Save Changes to update number of fields below.'
				)
			)
		));

		for ( $i = 1; $i <= get_contactinfo('locations-count'); $i++ ) {
			admin_fields(array(
				'group_name' => 'contact_info'
			,	'fields'     => array(
					array(
						'label' => 'Location '.$i.' Name'
					,	'name'  => 'location-name-'.$i
					,	'value' => $contact_info_db['location-name-'.$i]
					,	'cols'  => 2
					)
				,	array(
						'label' => 'Street Address'
					,	'name'  => 'street-address-'.$i
					,	'value' => $contact_info_db['street-address-'.$i]
					,	'cols'  => 2
					)
				,	array(
						'label' => 'City'
					,	'name'  => 'city-'.$i
					,	'value' => $contact_info_db['city-'.$i]
					,	'cols'  => 2
					)
				,	array(
						'label' => 'State'
					,	'name'  => 'state-'.$i
					,	'value' => $contact_info_db['state-'.$i]
					,	'cols'  => 4
					)
				,	array(
						'label' => 'Zip'
					,	'name'  => 'zip-'.$i
					,	'value' => $contact_info_db['zip-'.$i]
					,	'cols'  => 4
					)
				,	array(
						'label' => 'Phone'
					,	'name'  => 'phone-'.$i
					,	'value' => $contact_info_db['phone-'.$i]
					,	'cols'  => 2
					)
				,	array(
						'label' => 'Fax'
					,	'name'  => 'fax-'.$i
					,	'value' => $contact_info_db['fax-'.$i]
					,	'cols'  => 2
					)
				)
			));
		}
		?>

		<h3>Social Networks</h3>
		<p class="description">Make sure to include the http:// for all URLs.</p>

		<?
		admin_fields(array(
			'group_name' => 'contact_info'
		,	'fields'     => array(
				array(
					'label' => 'Facebook URL'
				,	'value' => $contact_info_db['facebook-url']
				)
			,	array(
					'label' => 'Twitter Username'
				,	'value' => $contact_info_db['twitter-username']
				)
			,	array(
					'label' => 'Instagram Username'
				,	'value' => $contact_info_db['instagram-username']
				)
			,	array(
					'label' => 'Tumblr URL'
				,	'value' => $contact_info_db['tumblr-url']
				)
			,	array(
					'label' => 'Linkedin URL'
				,	'value' => $contact_info_db['linkedin-url']
				)
			)
		));

		submit_button();
		?>
		</form>

	</div>
	<?
	//echo '<pre>'.print_r($_POST,1).'</pre>';

} );
} );

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
