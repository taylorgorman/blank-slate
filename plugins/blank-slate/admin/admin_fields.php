<?php
/*
** Form field markup
**
** Need layout for side-by-side labels and inputs like WordPress default. Could just detect whether any fields have cols set.
**
** Proposed changes to allow markup exceptions
**
		admin_fields(array(
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
**
*/

function admin_fields( $args = array() ) {

	// Parse function args
	$opt = wp_parse_args( $args, array(
		'before_fields' => '<div class="form-table">'
	,	'during_fields' => '<div class="field">%1$s%2$s%3$s</div>' // 1:label, 2:input, 3:description
	,	'after_fields'  => '</div>'
	,	'group_name'    => ''
	,	'fields'        => array()
	) );

	// Default field data
	$field_defaults = array(
		'type'        => 'text'
	,	'label'       => ''
	,	'name'        => ''
	,	'value'       => ''
	,	'placeholder' => ''
	,	'desc'        => ''
	,	'cols'        => ''
	);

	// Markup after fields
	echo $opt['before_fields'];

	foreach ( $opt['fields'] as $field ) {
		$field = wp_parse_args( $field, $field_defaults );

		// Label is required
		if ( empty($field['label']) )
			continue;

		// Name derived from label
		if ( empty($field['name']) )
			$field['name'] = sanitize_title($field['label']);

		// Display markup for different input types
		switch ( $field['type'] ) {

			case 'checkbox' :
				/*
				$markup = '<label for="'. $id .'"><input type="checkbox" name="contact_info['. $id .']" id="'. $id .'" value="1" '. checked('1', $fieldalues[$id], 0) .' />';
				if ( $desc ) $markup .= $desc;
				$markup .= '</label>';
				*/
			break;

			default :

				// Build field names and ids
				$field['id'] = $field['name'];
				if ( $opt['group_name'] ) {
					$field['name'] = $opt['group_name'].'['.$field['name'].']';
					$field['id'] = $opt['group_name'].'-'.$field['id'];
				}

				$label_markup = '<label for="'. $field['id'] .'">'. $field['label'] .'</label>';

				$field_markup = '<input';
				$field_markup .= ' type="'. $field['type'] .'"';
				$field_markup .= ' name="'. $field['name'] .'"';
				$field_markup .= ' id="'. $field['id'] .'"';
				$field_markup .= ' placeholder="'. $field['placeholder'] .'"';
				$field_markup .= ' value="'. $field['value'] .'"';
				if ( $field['desc'] ) $field_markup .= ' aria-describedby="'. $field['id'] .'-description"';
				$field_markup .= '>';

				$desc_markup = $field['desc'] ? '<p class="description" id="'. $field['id'] .'-description">'. $field['desc'] .'</p>' : '';

		}

		// Print field markup
		if ( ! empty($field['cols']) ) echo '<div class="cols'. $field['cols'] .'">';
		printf( $opt['during_fields'], $label_markup, $field_markup, $desc_markup );
		if ( ! empty($field['cols']) ) echo '</div>';

	}

	// Markup after fields
	echo $opt['after_fields'];

}
