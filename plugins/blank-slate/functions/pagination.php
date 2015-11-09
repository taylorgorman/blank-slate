<?php

function pagination($args=0) {

	global $wp_query;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	$defaults = array(
		'base'      => @add_query_arg('paged','%#%')
	,	'format'    => ''
	,	'total'     => $wp_query->max_num_pages
	,	'current'   => $current
	,	'end_size'  => 1
	,	'mid_size'  => 1
	,	'prev_text' => '&larr; Back'
	,	'next_text' => 'More &rarr;'
	,	'type'      => 'plain'
	);
	$pagination = wp_parse_args($args, $defaults);

	$links = paginate_links($pagination);
	echo $links
		? '<p class="pagination">'.$links.'</p>'
		: '';

}
