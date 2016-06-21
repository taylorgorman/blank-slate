<?
get_header('int');

if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>

	<article <? post_class(); ?> role="article" aria-labelledby="article-<? the_id(); ?>-title">

		<?
		get_template_part('parts/postdata', $post->post_type);
		get_template_part('parts/content', $post->post_type);
		?>

	</article>

<? } bs_paginate_links(); } else { ?>

	<article <? post_class(); ?>>

		<p class="excerpt">There is nothing in this section right now. Check back later for updates!</p>

	</article>

<?
}

get_footer('int');
