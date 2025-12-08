<div class="container">
<?php
if (!role_is(NOTLOGGEDIN)) {
	h2('Already Logged In!');
	echo makeLink('GO HOME TO VERIFY!', pageUrl());
} else {
	$simulating = true;

	if ($simulating) {
		contentBox('login', 'container');
		//TODO: posting
		echo '<div class="alert alert-success" role="alert">
		<h3 class="alert-heading mb-3">DEMO MODE NOTICE</h3>
		<p class="mb-0">This page is just a "mock". Click one of the roles below to simulate a login as a user with that role</p>
		<hr><p class="mb-0">This will bring up the role based items in the last menu.</a>.</p>
	</div>';


		h2('Simulate a:');
		user_role('link');

		contentBox('end');
	}

	runFeature('engage');
	_runEngageFromSheet(getPageName(), __DIR__ . '/' . stripExtension(__FILE__) . '.tsv');
}
?>
</div>
