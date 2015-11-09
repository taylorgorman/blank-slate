<?
if ( has_excerpt() )
	echo '<p class="excerpt">'.get_the_excerpt().'</p>';

the_content();

if ( is_singular() )
	edit_post_link('Edit this', '<p>','</p>');
