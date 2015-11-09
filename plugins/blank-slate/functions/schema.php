<?php

/**
 * Defines a schema item type
 * @access public
 * @param  string $type Upper CamelCase type name
 */
function bs_schema_type($type) {
	printf(
		'itemscope itemtype="http://schema.org/%s"',
		trim($type)
	);
}

/**
 * Defines a schema item property
 * @access public
 * @param  string $prop Upper CamelCase property name
 */
function bs_schema_prop($prop) {
	printf(
		'itemprop="%s"',
		trim($prop)
	);
}

/**
 * Defines a schema property that has no corresponding element on the page
 * as a meta element
 *
 * @access public
 * @param  string $prop    Upper CamelCase property name
 * @param  string $content Value of the property
 */
function bs_schema_meta($prop, $content) {
	printf(
		'<meta itemprop="%s" content="%s" />',
		trim($prop),
		trim($content)
	);
}
