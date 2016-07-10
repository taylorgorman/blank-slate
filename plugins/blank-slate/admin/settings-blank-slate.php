<?php
/*
** Register settings
*/
add_action('admin_init', function(){
	register_setting( 'blank_slate_settings', 'blank_slate_settings' );
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
		$v = wp_parse_args( get_option('blank_slate_settings') );
		?>

		<table class="form-table">
		<?
		foreach( array(
			array(
				'type'   => 'checkbox'
			,	'label'  => 'Layout Classes'
			,	'values' => array(
					'layouts_body' => 'Add to body classes'
				,	'layouts_post' => 'Add to post classes'
				)
			)
		,	array(
				'type'   => 'checkbox'
			,	'label'  => 'Post Formats'
			,	'values' => array(
					'formats_gallery' => 'Gallery'
				,	'formats_quote'   => 'Quote'
				,	'formats_etc'     => 'Etc'
				)
			)
		,	array(
				'type'   => 'checkbox'
			,	'label'  => 'Scheduled Post Types'
			,	'values' => array(
					'scheduled_custom' => 'Custom PT'
				,	'scheduled_etc'    => 'Etc'
				)
			)
		) as $field ) {

			?>
			<tr>
				<th><?= $field['label'] ?></th>
				<td>
					<p><? foreach ( $field['values'] as $name => $label ) { ?>
					<label><input type="checkbox" name="blank_slate_settings[<?= $name ?>]" value="1" <? if ( ! empty($v[$name]) ) checked($v[$name]); ?>> <?= $label ?></label><br>
					<? } ?></p>
					<? if ( ! empty($field['desc']) ) echo '<p class="description">'. $field['desc'] .'</p>'; ?>
				</td>
			</tr>
			<?

		}
		?>
		</table>

		<? submit_button(); echo '<pre>'.print_r($v,1).'</pre>'; ?>
		</form>

	</div>
	<?

} );
} );
