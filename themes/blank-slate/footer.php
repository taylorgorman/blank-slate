<?
$email = get_option('contact_email');
$name = get_option('company_name');
?>
</main>

<footer class="global" role="contentinfo">

	<p>&copy; <?= date('Y')?> <?= $name ?>
	<? if ($email) { ?>
	&middot; <a href="mailto:<?= $email ?>"><?= $email ?></a>
	<? } ?>
	</p>

</footer>

<? wp_footer(); ?>

</body>

</html>
