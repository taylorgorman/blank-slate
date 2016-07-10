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

function admin_fields( $fields ) {

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
