<?php
/*
** Register settings
*/
add_action( 'admin_init', function(){
	register_setting( 'blank_slate_settings', 'blank_slate' );
} );

/*
** Create subpage
*/
add_action( 'admin_menu', function(){
add_submenu_page( 'options-general.php', 'Blank Slate Settings', 'Blank Slate', 'manage_options', 'blank-slate-settings', function(){

	?>
	<style>
		.error {color: red}
		.dashicons {opacity:.25; margin:0 .25em}
		input:checked + .dashicons {opacity:.7}
	</style>

	<div class="wrap">

		<h2>Blank Slate Settings</h2>

		<form method="post" action="options.php">
		<?
		/*
		** Set and get form data
		*/
		settings_fields('blank_slate_settings');
		$blank_slate_db = get_option('blank_slate');
		echo '<pre>'.print_r($blank_slate_db,1).'</pre>';

		/*
		** Set up post types sorting options
		*/
		foreach ( get_post_types() as $i => $post_type ) {

			$pt_object = get_post_type_object($post_type);
			//echo '<pre>'.print_r($pt_object,1).'</pre>';

			// Only visible post types
			if ( ! $pt_object->public ) continue;

			// Get the post type icon
			if ( empty($pt_object->menu_icon) ) $pt_object->menu_icon = 'dashicons-admin-'.( $post_type == 'attachment' ? 'media' : $post_type );

			// Build markup
			$db_orderby = ( empty($blank_slate_db['orderby'][$post_type]) ) ? '' : $blank_slate_db['orderby'][$post_type];
			$db_order = ( empty($blank_slate_db['order'][$post_type]) ) ? '' : $blank_slate_db['order'][$post_type];

			$post_types_sorting_markup[$i] = '<i class="dashicons '.$pt_object->menu_icon.'"></i> ';
			$post_types_sorting_markup[$i] .= '<strong>'. $pt_object->label .'</strong> ';
			$post_types_sorting_markup[$i] .= 'sort by <input type=text name=blank_slate[orderby]['.$post_type.'] value="'. $db_orderby .'"> ';
			$post_types_sorting_markup[$i] .= '<select name=blank_slate[order]['.$post_type.']>';
			$post_types_sorting_markup[$i] .= '<option value=ASC '. selected( 'ASC', $db_order, 0 ) .'>ASC</option>';
			$post_types_sorting_markup[$i] .= '<option value=DESC '. selected( 'DESC', $db_order, 0 ) .'>DESC</option>';
			$post_types_sorting_markup[$i] .= '</select>';
			$post_types_sorting_markup[$i] .= '<br>';

		}

		/*
		** Generate form fields
		*/
		admin_fields(array(
			'before_fields' => '<table class="form-table">'
		,	'during_fields' => '<tr><th>%1$s</th><td><fieldset>%2$s%3$s</fieldset></td></tr>'
		,	'after_fields'  => '</table>'
		,	'group_name'    => 'blank_slate'
		,	'group_value'   => $blank_slate_db
		,	'fields'        => array(
				array(
					'type'    => 'checkbox'
				,	'label'   => 'Post Formats'
				//,	'cols'    => 2
				,	'options' => array(
						array(
							'label' => '<i class="dashicons dashicons-format-gallery"></i> Gallery'
						)
					,	array(
							'label' => '<i class="dashicons dashicons-admin-links"></i> Link'
						)
					,	array(
							'label' => '<i class="dashicons dashicons-format-image"></i> Image'
						)
					,	array(
							'label' => '<i class="dashicons dashicons-format-quote"></i> Quote'
						)
					,	array(
							'label' => '<i class="dashicons dashicons-format-video"></i> Video'
						)
					,	array(
							'label' => '<i class="dashicons dashicons-format-audio"></i> Audio'
						)
					)
				)
			,	array(
					'type'    => 'checkbox'
				,	'label'   => 'Layout Classes'
				,	'name'    => 'layouts'
				//,	'cols'    => 2
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
					'type'   => 'custom'
				,	'label'  => 'Post Types Sorting'
				,	'markup' => $post_types_sorting_markup
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
