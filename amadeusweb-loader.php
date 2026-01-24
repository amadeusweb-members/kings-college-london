<?php
DEFINE('SITENAME', pathinfo(SITEPATH, PATHINFO_FILENAME));
DEFINE('NETWORKPATH', __DIR__);
DEFINE('NETWORKNAME', pathinfo(NETWORKPATH, PATHINFO_FILENAME));

include_once __DIR__ . '/../spring/entry.php';

variables([
	'no-network-in-footer' => true,
	'network' => true
]);

runFrameworkFile('site/begin');
