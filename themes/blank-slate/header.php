<!doctype html>
<html class="no-js" <?php language_attributes(); ?> <? bs_schema_type('Product'); ?>>
<head>

	<meta charset="<? bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><? bs_title('-'); ?></title>

	<meta name="viewport"    content="width=device-width,initial-scale=1">
	<meta name="author"      content="<? global $post; echo get_the_author_meta('display_name', $post->post_author); ?>">
	<meta name="description" content="<? bs_description(); ?>">

	<?/*<link rel="alternate" type="application/rss+xml" href="<?= esc_attr(get_option('rss_url', get_bloginfo('rss2_url'))) ?>">*/?>

	<? wp_head(); ?>

</head>

<body <? bs_schema_type('WebPage'); ?> <? body_class(); ?>>

<header class="global" <? bs_schema_type('WPHeader'); ?> role="banner">

	<div class="logo" <? bs_schema_type('Organization'); ?>>
		<a itemprop="url" href="<?= home_url() ?>"><img itemprop="logo" src="<?= bs_theme_url('img/logo.svg') ?>" alt="<? bloginfo('name'); ?>"></a>
	</div>

	<? bs_nav_menu('Main'); ?>

	<a href="#" class="mobile-menu-toggle" data-toggle-class="mobile-menu-active" data-toggle-target="html"></a>

</header>

<main class="ctst" role="main">
