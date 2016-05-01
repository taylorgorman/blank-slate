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
		$v = wp_parse_args( get_option('blank_slate_settings'), array(
			'layout_classes' => false
		) );
		?>

		<table class="form-table">
		<tr>
			<th>Layout Classes</th>
			<td><label><input type="checkbox" name="blank_slate_settings[layout_classes]" value="1" <? checked($v['layout_classes']); ?>> Enable</label></td>
		</tr>
		</table>

		<? submit_button(); ?>
		</form>

	</div>
	<?

} );
} );
