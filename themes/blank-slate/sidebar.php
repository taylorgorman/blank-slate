
<div class="sidebar ctst">

	<? if ( $list_items = bs_list_contextually() ) { ?>
	<div class="widget widget_section_navigation">

		<h3 class="widget-title">In This Section</h3>
		<ul><?= $list_items ?></ul>

	</div>
	<? } ?>

	<? //dynamic_sidebar('The Sidebar'); ?>

</div>
