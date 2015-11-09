<?php

class BS_Post_Post_Type extends BS_Post_Type {

	protected static $id = 'post';

	protected static $columns_to_remove = array('comments', 'tags');
	protected static $remove_supports = array('trackbacks');

	public static function register() { /* NOOP */ }

}
