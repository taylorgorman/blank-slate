<!doctype html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/Product">
<head>

	<meta charset="<? bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><? wp_title( '-', true, 'right' ); ?></title>

	<meta name="viewport"    content="width=device-width,initial-scale=1">
	<meta name="author"      content="<? global $post; echo get_the_author_meta('display_name', $post->post_author); ?>">
	<meta name="description" content="<? bs_description(); ?>">

	<?/*<link rel="alternate" type="application/rss+xml" href="<?= esc_attr(get_option('rss_url', get_bloginfo('rss2_url'))) ?>">*/?>

	<? wp_head(); ?>

</head>

<body itemscope itemtype="http://schema.org/WebPage" <? body_class(); ?>>

<header class="global" itemscope itemtype="http://schema.org/WPHeader">

	<div class="logo" itemscope itemtype="http://schema.org/Organization">
		<a itemprop="url" href="<?= home_url() ?>"><img itemprop="logo" src="<?= get_stylesheet_directory_uri().'/img/logo.svg' ?>" alt="<? bloginfo('name'); ?>"></a>
	</div>

	<? wp_nav_menu( array('theme_location'=>'main') ); ?>

	<a href="#" class="mobile-menu-toggle" data-toggle-class="mobile-menu-active" data-toggle-target="html"></a>

</header>

<main class="ctst">
