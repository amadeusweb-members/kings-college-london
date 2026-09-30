<?php
define('SITENAME', pathinfo(SITEPATH, PATHINFO_FILENAME));
define('NETWORKPATH', __DIR__);

include_once __DIR__ . '/../spring/entry.php';
define('NETWORKRELPATH', substr(NETWORKPATH, strlen(ALLSITESROOT)));

variables([
	VARNoFooterNetwork => true,
	'network' => true
]);

runFrameworkFile('site/begin');
