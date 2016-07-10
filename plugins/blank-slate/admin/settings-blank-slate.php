<?php
/*
** Register settings
*/
add_action('admin_init', function(){
	register_setting( 'blank_slate_settings', 'blank_slate' );
});

/*
** Create subpage
*/
add_action( 'admin_menu', function(){
add_submenu_page( 'options-general.php', 'Blank Slate Settings', 'Blank Slate', 'manage_options', 'blank-slate-settings', function(){

	?>
	<style>
		.error {color: red}
	</style>
	<div class="wrap">

		<h2>Blank Slate Settings</h2>

		<form method="post" action="options.php">
		<?
		settings_fields('blank_slate_settings');
		$blank_slate_db = wp_parse_args(get_option('blank_slate'));

		admin_fields(array(
			'before_fields' => '<table class="form-table">'
		,	'during_fields' => '<tr><th>%1$s</th><td><fieldset>%2$s%3$s</fieldset></td></tr>'
		,	'after_fields'  => '</table>'
		,	'group_name'    => 'blank_slate'
		,	'group_value'   => $blank_slate_db
		,	'fields'        => array(
				array(
					'type'    => 'checkbox'
				,	'label'   => 'Layout Classes'
				,	'name'    => 'layouts'
				,	'options' => array(
						array(
							'label' => 'Add to body classes'
						,	'value' => 'body'
						)
					,	array(
							'label' => 'Add to post classes'
						,	'value' => 'post'
						)
					)
				)
			,	array(
					'type'    => 'checkbox'
				,	'label'   => 'Post Formats'
				,	'options' => array(
						array(
							'label' => 'Gallery'
						)
					,	array(
							'label' => 'Quote'
						)
					,	array(
							'label' => 'Video'
						)
					)
				)
			,	array(
					'type'    => 'checkbox'
				,	'label'   => 'Scheduled Post Types'
				,	'options' => array(
						array(
							'label' => 'Custom PT'
						)
					,	array(
							'label' => 'Etc'
						)
					)
				)
			)
		));

		submit_button();
		?>
		</form>

	</div>
	<?

} );
} );
