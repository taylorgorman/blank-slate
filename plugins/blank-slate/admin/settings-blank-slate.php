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
			,	'name'    => 'formats'
			,	'options' => array(
					array(
						'label' => 'Gallery'
					,	'value' => 'gallery'
					)
				,	array(
						'label' => 'Quote'
					,	'value' => 'quote'
					)
				,	array(
						'label' => 'Video'
					,	'value' => 'video'
					)
				)
			)
		,	array(
				'type'    => 'checkbox'
			,	'label'   => 'Scheduled Post Types'
			,	'name'    => 'scheduled'
			,	'options' => array(
					array(
						'label' => 'Custom PT'
					,	'value' => 'custom'
					)
				,	array(
						'label' => 'Etc'
					,	'value' => 'etc'
					)
				)
			)
		) as $field ) {

			?>
			<tr>
				<th><?= $field['label'] ?></th>
				<td>
					<p><? foreach ( $field['options'] as $i ) { ?>
					<label><input type="checkbox"
						name="<?= 'blank_slate_settings['.$field['name'].'][]' ?>"
						value="<?= $i['value'] ?>"
						<? if ( ! empty($v[$field['name']]) ) checked(in_array($i['value'], $v[$field['name']])); ?>>
						<?= $i['label'] ?>
					</label><br>
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
