
<header class="navbar navbar-default">
<div class="container-fluid">

	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav-collapse" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
	</div>

	<div class="collapse navbar-collapse" id="main-nav-collapse">
		<?php wp_nav_menu([
			'theme_location' => 'main'
		,	'menu_class'     => 'nav navbar-nav navbar-right'
		]); ?>
	</div>

</div>
</header>
