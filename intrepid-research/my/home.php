<?php
contentBox('my', 'container');
if (!variable('local1') && !isset($_GET['demo'])) {
	echo returnLine('<div class="alert alert-success" role="alert">
	<h3 class="alert-heading mb-3">Being Built!</h3>
	<p class="mb-0">In time, this page will become a "dashboard".</p>
	<hr><p class="mb-0">Until then, you may try <a href="%url%%section%/?demo=1">the demo controls</a>.</p>
</div>');
	contentBox('end');
	return;
}
?>
<div class="row">
	<div class="col-12">
	<?php h2(returnLine('[Demo Controls](%url%my/)')); echo HRTAG . NEWLINE; ?>
	</div>

	<div class="col-md-8 col-sm-12">
		HELLO, <br><?php echo demo_mode('return')
			? 'We are in demo mode, where a few things will be allowed, like changing role (see blue buttons on right)'
			: 'Try enabling "demo mode" so you can play around' ;

		$items = variable(getSectionKey($s = getSectionFrom(__DIR__), MENUITEMS));
		$lookup = variable(getSectionKey($s, FILELOOKUP));
		echo '<hr><b>Available Pages</b>';
		$current = _userAction('render');
		foreach ($items as $slug => $item) {
			$lk = $lookup[$slug];
			echo BRNL . BRNL . getLink($item, pageUrl('my/?render=' . $slug /*. '&autopopup=1'*/),
				($current == $slug ? 'disabled ' : '') . 'btn btn-dark') . ' &raquo; ' . $lk['about'];
		}

		if (isset($_GET['render'])) {
			echo BRNL . BRNL;
			$lkp = $lookup[$_GET['render']];
			$render = __DIR__ . '/' . $lkp['relative-path']; //let it throw, this way its *acl*
			autoRender($render);
			//variable('after-wrapper', ['template' => 'popup', 'file' => $render]);
		}
		?>
	</div>

	<div class="col-md-4 col-sm-12 content-box after-content">
	<?php
		h2('Testing Tools');
		demo_mode('link');
		if (demo_mode('return')) {
			h2('Change role to:');
			user_role('link');
		}
	?>
	</div>
</div>
<?php
contentBox('end');
