<?php
disk_include_once(__DIR__ . '/code/functions.php');

if (SITENAME == 'intrepid-research')
	disk_include_once(SITEPATH . '/_demo/_magic.php');

DEFINE('SITENAMEALIAS', SITENAME == 'intrepid-research' ? 'home' : SITENAME);
variables([
	'standalone-sections' => ['what-matters-most', 'general', 'listings', 'my'],
	//'no-name-in-header-menu' => ['what-matters-most'],

	'link-to-section-home' => true,
	'no-sections-in-footer' => true,
	'link-to-site-home' => true,
	'custom-engage-notes' => true,
	'dont-show-current-menu' => true,
	VAREmail => plus_email(VARSystemEmail, 'kcl'),
]);

if (SITENAME == 'intrepid-research') {
function beforeSectionSet() {
	$node = nodeValue();
	$standalones = variable('standalone-sections');
	foreach ($standalones as $slug) {
		$where = SITEPATH . '/' . $slug . '/';
		$file = $where . $node . '.md';

		$match = $slug == $node || disk_file_exists($file) || isNodeWithMenu($slug, $where);
		if (!$match) continue;
		
		variables([
			'section' => $slug,
			'file' => variableOr('file', variable('path') . '/' . $slug . '/home.php'),
			'is-standalone-section' => true,
			'no-page-menu' => true,
		]);
		return true;
	}
} }

DEFINE('GPSE', $pse = 'Google <abbr title="Programmable Search Engine">PSE</abbr>');
variables($d = [
	'default-search' => $ds = 'KCL Main',
	'searches' => [
		$ds => ['code' => 'e5140db9c9b44406d', 'name' => "Main $pse", 'description' => '&hellip; searches the main DEMO site built for KCL\'s -- Intrepid Research III (PsyRes)'],
		'partner-research-orgs' => ['code' => '92ff745007df44075', 'name' => 'Partner Research Organizations', 'description' => "&hellip; showcasing $pse by searching SCARF (India) etc"],
		//$ds => ['code' => '41775c0079ee9410b', 'name' => 'This Demo Site', 'description' => ''],
	],
]);

//addStyle('network', 'network-static--common-assets');
//addStyle(SITENAME, 'network-static--common-assets');

variables([
	socialBuilder::variableName => socialBuilder::create()
		->addImranPersonal()
		->getItems(),
]);
