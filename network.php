<?php
disk_include_once(__DIR__ . '/auth-config.php');

if (SITENAME == 'intrepid-research')
	disk_include_once(SITEPATH . '/_demo/_magic.php');

/*
$staticUrls = [
	//locals
	'local-url' => 'http://localhost/networks/intrepid/live/static/',
	'local-preview-url' => 'http://localhost/networks/intrepid/static/',
	//lives
	'live-url' => 'https://intrepid.amadeusweb.site/static/',
	'live-preview-url' => 'https://preview-intrepid.amadeusweb.site/static/',
];
*/

DEFINE('SITENAMEALIAS', SITENAME == 'intrepid-research' ? 'home' : SITENAME);
variables([
	'network-static-folder' => NETWORKPATH . '/',
	'network-static' => $static = replaceItems(variable('assets-url'), [SITENAME . '/' => '']) . 'static/', //TODO: change assets-url to just url when migrating??
	'site-static-folder' => NETWORKPATH . '/' . SITENAME . '/',
	'site-static' => $static . SITENAMEALIAS . '/',

	'standalone-sections' => ['what-matters-most', 'general', 'listings', 'my'],
	//'no-name-in-header-menu' => ['what-matters-most'],
	'footer-variation' => 'single-widget',

	'link-to-section-home' => true,
	'no-sections-in-footer' => true,
	'link-to-site-home' => true,
	'custom-engage-notes' => true,
	'dont-show-current-menu' => true,
	'assistantEmail' => 'assistant+intrepid@amadeusweb.world',
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

DEFINE('GPSE', $pse = 'Google <abbr title="Programmable Search Engine">PSE</abbr>');
variables($d = [
	'default-search' => $ds = 'KCL Main',
	'searches' => [
		$ds => ['code' => 'e5140db9c9b44406d', 'name' => "Main $pse", 'description' => '&hellip; searches the main DEMO site built for KCL\'s -- Intrepid Research III (PsyRes)'],
		'partner-research-orgs' => ['code' => '92ff745007df44075', 'name' => 'Partner Research Organizations', 'description' => "&hellip; showcasing $pse by searching SCARF (India) etc"],
		//$ds => ['code' => '41775c0079ee9410b', 'name' => 'This Demo Site', 'description' => ''],
	],
]);

addStyle('network', 'network-static--common-assets');
addStyle(SITENAME, 'network-static--common-assets');

variables([
	'social' => [
		[ 'type' => 'fa-brands fa-redhat bg-danger', 'url' => 'https://people.amadeusweb.world/imran/whoami/on-linkedin/', 'name' => 'Who Am I' ],
		[ 'type' => 'fa-brands fa-linkedin bg-linkedin text-light', 'url' => 'https://www.people.amadeusweb.world/imran/whoami/the-technologist/', 'name' => 'The IT Guy' ],
	],
]);
