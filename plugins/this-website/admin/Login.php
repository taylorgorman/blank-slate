<?php

class BS_Admin_Login {

	/*
	** Changes the login logo from the WordPress logo, and can be
	** overwritten with a client logo as desired.
	**
	** @access public
	public static function update_login_logo() {
		$default_image = 'resources/images/login-logo.png';
		$default_size  = array(548, 126);
		$desired_width = 274;

		$image = apply_filters('bs_login_logo', BS_URL.$default_image);
		$size  = apply_filters('bs_login_logo_size', $default_size);

		$new_width = min($desired_width, $size[0]);

		$resize = array(
			$new_width,
			$size[1] * $new_width / $size[0]
		);

		?><style>
			.login h1 a {
				background-image: <?php echo "url('$image')"; ?>;
				background-size: <?php echo "{$resize[0]}px {$resize[1]}px" ?>;
				width: <?php echo $resize[0].'px' ?>;
				height: <?php echo ($resize[1] + 4).'px'; ?>;
			}
		</style><?php
	}
	*/

//-----------------------------------------------------------------------------
// INITIALIZATION
//-----------------------------------------------------------------------------

	public static function initialize() {
		//add_action('login_head', array(__CLASS__, 'update_login_logo'));
	}

}
