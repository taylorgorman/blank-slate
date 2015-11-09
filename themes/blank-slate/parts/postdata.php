<?
// Conditions
if ( is_page() && is_highest_ancestor() )
	return false;

// Markup
?>

<div class="post-data">

	<h1 class="post-title" id="article-<? the_id(); ?>-title">
		<a href="<? the_permalink(); ?>"><? the_title(); ?></a>
	</h1>

	<p class="details">Posted on <? the_time('F j, Y'); ?></p>

</div>
