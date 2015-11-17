<?php

abstract class bs_post_type {

	/*
	** Registration
	*/
	protected static $ID = null;
	protected static $singular_name = null;
	protected static $plural_name = null;
	protected static $labels = null;
	protected static $add_supports = null;
	protected static $remove_supports = null;
	protected static $arguments = null;


	/*
	** Registers the post type with WordPress. This method
	** should not be called directly.
	*/
	public static function register() {

		// Singular name is essential
		if ( empty($singular_name) )
			return false;

		// ID can set itself
		if ( empty($v['ID']) )
			$v['ID'] = $v['singular_name'];

		// Uppercase names
		if ( empty($v['singular_name_uppercase']) )
			$v['singular_name_uppercase'] = ucwords($v['singular_name']);
		if ( empty($v['plural_name_uppercase']) )
			$v['plural_name_uppercase'] = ucwords($v['plural_name']);

		// Default register_post_type arguments
		$defaults = array(
			'public' => true
		,	'menu_position' => 20
		,	'hierarchical' => false
		,	'has_archive' => true
		,	'capability_type' => 'page'
		,	'supports' => array(
				'title'
			,	'editor'
			,	'thumbnail'
			,	'excerpt'
			,	'revisions'
			)
		,	'rewrite' => array(
				'with_front' => false
			)
		);

		// Merge defaults with declared settings
		// TODO: Need this to be multi-dimensional
		$args = wp_parse_args(static::$args, $defaults);

		// Arguments dependent upon hierarchical
		if ($args['hierarchical'] == false)
			$args['supports'][] = 'author';

		if ($args['hierarchical'] == true)
			$args['supports'][] = 'page-attributes';

		if (!isset($args['rewrite']['feeds']) && $args['hierarchical'] == true)
			$args['rewrite']['feeds'] = false;

		// Rewrite arguments
		if (!isset($args['rewrite']['slug']))
			$args['rewrite']['slug'] = strtolower($args['label']);

		// Label arguments
		$args['labels']['name'] = $args['label'];

		if (!isset($args['labels']['singular_name']))
			$args['labels']['singular_name'] = $args['labels']['name'];

		if (!isset($args['labels']['plural_name']))
			$args['labels']['plural_name'] = $args['labels']['name'];

		if (!isset($args['labels']['add_new_item']))
			$args['labels']['add_new_item'] = 'Add New '.$args['labels']['singular_name'];

		if (!isset($args['labels']['edit_item']))
			$args['labels']['edit_item'] = 'Edit '.$args['labels']['singular_name'];

		if (!isset($args['labels']['new_item']))
			$args['labels']['new_item'] = 'New '.$args['labels']['singular_name'];

		if (!isset($args['labels']['view_item']))
			$args['labels']['view_item'] = 'View '.$args['labels']['singular_name'];

		if (!isset($args['labels']['parent_item_colon']))
			$args['labels']['parent_item_colon'] = 'Parent '.$args['labels']['singular_name'];

		if (!isset($args['labels']['search_items']))
			$args['labels']['search_items'] = 'Search '.$args['labels']['plural_name'];

		if (!isset($args['labels']['not_found']))
			$args['labels']['not_found'] = 'No '.$args['labels']['plural_name'].' found';

		if (!isset($args['labels']['not_found_in_trash']))
			$args['labels']['not_found_in_trash'] = 'No '.$args['labels']['plural_name'].' found in trash';

		register_post_type(static::$ID, $args);
	}


//-----------------------------------------------------------------------------
// ADD AND REMOVE FEATURES. IDK..
//-----------------------------------------------------------------------------

	/**
	 * Adds features to post type
	 * @access  public
	 */
	public static function add_supports() {
		if (!is_array(static::$add_supports)) return;
		foreach(static::$add_supports as $feature)
			add_post_type_support(static::$ID, $feature);
	}

	/**
	 * Removes features from post type
	 * @access public
	 */
	public static function remove_supports() {
		if (!is_array(static::$remove_supports)) return;
		foreach(static::$remove_supports as $feature)
			remove_post_type_support(static::$ID, $feature);
	}


//-----------------------------------------------------------------------------
// ADMIN LIST SCREEN CLEANUP
//-----------------------------------------------------------------------------

	/**
	 * Column IDs to remove from the admin archive page for this post type
	 * @var array
	 */
	protected static $columns_to_remove = array('comments');

	/**
	 * Column IDs => titles to add to the archive page for this post type
	 * @var array
	 */
	protected static $columns_to_add = array();

	/**
	 * Column IDs to move to the end of the table.
	 * @var array
	 */
	protected static $columns_to_end = array('author', 'date');

	/**
	 * Removes, adds and manipulates columns
	 * @access public
	 * @param  array $cols Column ids and titles
	 * @return array       The manipulated input array
	 */
	public static function manage_columns($cols) {

		//remove specified columns
		if (is_array(static::$columns_to_remove))
			foreach(static::$columns_to_remove as $col)
				unset($cols[$col]);

		//add columns
		if (is_array(static::$columns_to_add))
			foreach(static::$columns_to_add as $col => $name)
				$cols[$col] = $name;

		//move columns to end
		if (is_array(static::$columns_to_end))
			foreach (static::$columns_to_end as $col) {
				if (!array_key_exists($col, $cols)) continue;
				$val = $cols[$col];
				unset($cols[$col]);
				$cols[$col] = $val;
			}

		return $cols;
	}

	/**
	 * Set the value of a particular column for a particular post_id
	 * for this post type.
	 *
	 * @access public
	 */
	public static function column_values($col, $post_id) {
		//NOOP
		//Needs to be overridden in child class to manipulate
		//column values for this archive view
	}

//-----------------------------------------------------------------------------
// ADMIN EDIT SCREEN CLEANUP
//-----------------------------------------------------------------------------

	/**
	 * Override the default placeholder for the title on the post edit screen
	 * @var string
	 */
	protected static $title_prompt = false;

	/**
	 * IDs of the meta boxes to remove from the post edit screen
	 * @var array
	 */
	protected static $meta_boxes_to_remove = array(
		'postcustom'
	);

	/**
	 * Whether or not to move the revisions meta box to the sidebar
	 * @var boolean
	 */
	protected static $move_revisions_meta_box = true;


	/**
	 * Whether or not to move the author meta box to the sidebar
	 * @var boolean
	 */
	protected static $move_author_meta_box = true;

	/**
	 * Whether or not to move the slug meta box to the sidebar
	 * @var boolean
	 */
	protected static $move_slug_meta_box = true;

	/**
	 * Changes the title placeholder to the override specified
	 * @access public
	 * @param  string $prompt The current prompt value
	 * @return string         The updated prompt value
	 */
	public final static function enter_title_here($prompt) {
		$new = trim(static::$title_prompt);
		return '' === $new || !static::is_this_cpt()
			? $prompt
			: $new;
	}

	/**
	 * Remove meta boxes from the post edit screen
	 * @access public
	 */
	public final static function remove_meta_boxes() {
		if (!static::is_this_cpt()) return;
		if (is_array(static::$meta_boxes_to_remove))
			foreach(static::$meta_boxes_to_remove as $box) {
				remove_meta_box($box, static::$ID, 'normal');
				remove_meta_box($box, static::$ID, 'side');
			}
	}

	/**
	 * Move meta boxes on the pot edit screen
	 * @access public
	 */
	public final static function move_meta_boxes() {
		if (!static::is_this_cpt()) return;

		$relocations = array(
			'revisions' => array(
				'revisionsdiv',
				'Revisions',
				'post_revisions_meta_box',
				static::$ID,
				'side',
				'low'
			),
			'author' => array(
				'authordiv',
				'Author',
				'post_author_meta_box',
				static::$ID,
				'side',
				'high'
			),
			'slug' => array(
				'slugdiv',
				'Slug',
				'post_slug_meta_box',
				static::$ID,
				'side',
				'high'
			)
		);

		if (!static::$move_revisions_meta_box) unset($relocations['revisions']);
		if (!static::$move_author_meta_box) unset($relocations['author']);
		if (!static::$move_slug_meta_box) unset($relocations['slug']);

		foreach($relocations as $support => $args) {
			if ('slug' !== $support && !post_type_supports(static::$ID, $support)) continue;
			remove_meta_box($args[0], static::$ID, 'normal');
			call_user_func_array('add_meta_box', $args);
		}
	}

//-----------------------------------------------------------------------------
// MAIN QUERY CHANGES
//-----------------------------------------------------------------------------

	/**
	 * Overrides the number of posts displayed on an archive page
	 * @var int
	 */
	protected static $archive_quantity = false;

	/**
	 * Sets the number of posts displayed on an archive page
	 * @access public
	 */
	public final static function change_get_posts($query) {

		// Not admin, post type check
		if (is_admin()) return;
		if ($query->get('post_type') != static::$ID) return;

		if ( is_post_type_hierarchical($query->get('post_type')) ) {
			$query->set('orderby', 'menu_order');
			$query->set('order', 'ASC');
		}

		// Main query, archive
		if (!$query->is_main_query()) return;
		if (!$query->is_archive()) return;

		if ( static::$archive_quantity )
			$query->set('posts_per_page', (int)static::$archive_quantity);

	}

//-----------------------------------------------------------------------------
// UTILITIES
//-----------------------------------------------------------------------------

	/**
	 * Checks whether or not the current screen is for this post type
	 * @access public
	 * @return boolean [description]
	 */
	protected static function is_this_cpt() {
		global $post_type;
		return $post_type == static::$ID;
	}

//-----------------------------------------------------------------------------
// INITIALIZATION
//-----------------------------------------------------------------------------

	/**
	 * Preps the post type. SHOULD NOT BE CALLED DIRECTLY
	 * This method is registered on the bs_ready action.
	 * @access public
	 */
	public static function ready() {

		$cls = get_called_class();
		$ID = static::$ID;

		add_action('init', array($cls, 'register'));
		add_action('init', array($cls, 'add_supports'));
		add_action('init', array($cls, 'remove_supports'));

		add_filter('manage_edit-'.static::$ID.'_columns', array($cls, 'manage_columns'));
		add_action('manage_'.static::$ID.'_posts_custom_column', array($cls, 'column_values'), 10, 2);

		add_filter('enter_title_here', array($cls, 'enter_title_here'));

		add_action('do_meta_boxes', array($cls, 'move_meta_boxes'));
		add_action('do_meta_boxes', array($cls, 'remove_meta_boxes'));

		add_action('pre_get_posts', array($cls, 'change_get_posts'));
	}

	public static function initialize() {
		add_action('bs_ready', array(get_called_class(), 'ready'));
	}

}
