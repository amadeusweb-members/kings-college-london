<?php
disk_include_once(__DIR__ . '/auth-config.php');

if (SITENAME == 'home')
	disk_include_once(SITEPATH . '/_demo/_magic.php');

$staticUrls = [
	//locals
	'local-url' => 'http://localhost/networks/intrepid/live/static/',
	'local-preview-url' => 'http://localhost/networks/intrepid/static/',
	//lives
	'live-url' => 'https://intrepid.amadeusweb.site/static/',
	'live-preview-url' => 'https://preview-intrepid.amadeusweb.site/static/',
];

variables([
	'network-static-folder' => NETWORKPATH . '/',
	'network-static' => $static = $staticUrls[variable(SITEURLKEY)],
	'site-static-folder' => NETWORKPATH . '/' . SITENAME . '/',
	'site-static' => $static . SITENAME . '/',

	'standalone-sections' => ['what-matters-most', 'general', 'listings', 'my'],
	//'no-name-in-header-menu' => ['what-matters-most'],
	'footer-variation' => '-single-widget',

	'link-to-section-home' => true,
	'no-sections-in-footer' => true,
	'link-to-site-home' => true,
	'custom-engage-notes' => true,
	'dont-show-current-menu' => true,
	'assistantEmail' => 'assistant+intrepid-demo@amadeusweb.world',
]);

runExtension('resources');

function before_render_section($slug) {
	runExtension('biblios'); //cannot run inline as "node" will not be set

	$standalones = variableOr('standalone-sections', []);
	if (!in_array($slug, $standalones)) return false;

	$node = variable('node');
	$context = [
		'section' => $slug,
		'where' => variable('path') . '/' . $slug . '/',
		'limit' => -1,
		'callingFrom'=> 'section-check',
	];

	if ($slug == $node || isResourceNode($slug, $context) || isNonResourceNode($slug, $context)) {
		variables([
			'section' => $slug,
			'file' => variableOr('file', variable('path') . '/' . $slug . '/home.php'),
			'is-standalone-section' => true,
			'no-page-menu' => true,
		]);
		return true;
	}
	return false;
}

function isNonResourceNode($slug, $context) {
	$fol = SITEPATH . '/' . $slug . '/';
	$file = $fol . 'menu.php';
	$items = disk_include($file, $context);
	$node = variable('node');

	if (!isset($items[$node])) return false;

	$fileLookup = variableOr(getSectionKey($slug, FILELOOKUP), []);
	variable('file', isset($fileLookup[$node]) ? $fol . $fileLookup[$node]['relative-path'] : false);
	return true;
}

variables($d = [
	'default-search' => $ds = 'preview',
	'searches' => [
		'main' => ['code' => '05b9cd218248f44f0', 'name' => 'Main Site', 'description' => ''],
		'research' => ['code' => '92ff745007df44075', 'name' => 'Research Orgs', 'description' => ''],
		$ds => ['code' => '41775c0079ee9410b', 'name' => 'This Demo Site', 'description' => ''],
	],
]);

addStyle('network', 'network-static--common-assets');
addStyle(SITENAME, 'network-static--common-assets');

variables([
	'social' => [
		[ 'type' => 'linkedin', 'url' => 'https://www.linkedin.com/in/imran-ali-namazi/', 'name' => 'Webmaster' ],
	],
]);
