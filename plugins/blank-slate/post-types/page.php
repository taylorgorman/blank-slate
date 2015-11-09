<?php

class BS_Page_Post_Type extends BS_Post_Type {

	protected static $id = 'page';

	protected static $remove_supports = array('trackbacks', 'comments', 'author');
	protected static $add_supports = array('excerpt');

	public static function register() { /* NOOP */ }

}
