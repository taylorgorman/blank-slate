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

function admin_fields( $fields=array(), $group_name='' ) {

	// Markup before fields
	echo '<div class="form-table">';

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

	foreach ( $fields as $field ) {

		$field = wp_parse_args($field, $field_defaults);

		// Label is required
		if ( empty($field['label']) )
			continue;

		// Name derived from label
		if ( empty($field['name']) )
			$field['name'] = sanitize_title($field['label']);

		// Name derived from label
		if ( ! empty($field['cols']) )
			$field['cols'] = 'cols'.$field['cols'];

		// Before field markup ?>
		<div class="field<?= ' '.$field['cols'] ?>">
		<?

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
				$field['id'] = $field['name'];
				if ( $group_name ) {
					$field['name'] = $group_name.'['.$field['name'].']';
					$field['id'] = $group_name.'-'.$field['id'];
				}
				?>
				<label for="<?= $field['id'] ?>"><?= $field['label'] ?></label>
				<input
					type="<?= $field['type'] ?>"
					name="<?= $field['name'] ?>"
					id="<?= $field['id'] ?>"
					placeholder="<?= $field['placeholder'] ?>"
					value="<?= $field['value'] ?>"
					<? if ( $field['desc'] ) echo 'aria-describedby="'. $field['id'] .'-description"'; ?>
				><?
				if ( $field['desc'] ) echo '<p class="description" id="'. $field['id'] .'-description">'. $field['desc'] .'</p>';

		}
		// After field markup ?>
		</div>
		<?

	}

	// Markup after fields
	echo '</div>';

}
