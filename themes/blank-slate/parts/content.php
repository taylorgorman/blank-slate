<?
if ( is_singular() ) {

	if ( has_excerpt() ) the_excerpt();
	the_content();
	edit_post_link('Edit this', '<p>','</p>');

} else {

	the_excerpt();

}
