<?php
DEFINE('SITENAME', pathinfo(SITEPATH, PATHINFO_FILENAME));
DEFINE('NETWORKPATH', __DIR__);
DEFINE('NETWORKNAME', pathinfo(NETWORKPATH, PATHINFO_FILENAME));

//include_once __DIR__ . '/../../dawn/spring/entry.php'; variable('fwkSuffix', '/begin');

if (!defined('AMADEUSROOT')) {
error_reporting(E_ALL);
ini_set('display_errors', '1');

//live will be inside the preview so need to go an extra level up
function contains2($haystack, $needle) { return stripos($haystack, $needle) !== false; }
$extraUp = contains2(SITEPATH, 'live') ? '/..' : '';
include_once __DIR__ . $extraUp . '/../../awe/core/framework/1-entry.php';
}

variables([
	//'use-preview' => true,
	'no-network-in-footer' => true,
	'network' => true
]);

runFrameworkFile('site' . variableOr('fwkSuffix', ''));
