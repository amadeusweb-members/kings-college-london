<?php
disk_include_once(__DIR__ . '/auth-config.php');
disk_include_once(__DIR__ . '/resources/loader.php');
disk_include_once(__DIR__ . '/biblios/loader.php');

DEFINE('STATICURL', getDomainLink('', NETWORKNAME . '/static', '', true));

function staticUrl($rel, $where = 'home/') {
	return STATICURL . $where . $rel;
}

function isNodeWithMenu($slug, $where) {
	if ($slug != 'my')
		$items = getSheet($where . '_section.tsv', 'slug')->group;
	else
		$items = disk_include($where . 'menu.php');

	$node = variable('node');

	if (!isset($items[$node])) return false;

	$fileLookup = variableOr(getSectionKey($slug, FILELOOKUP), []);
	if ($file = isset($fileLookup[$node]) ? $where . $fileLookup[$node]['relative-path'] : false)
		variable('file', $file);

	return true;
}

function readSections($where, $limit = null) {
	$sheet = getSheet($where . '/_section.tsv', false);
	$items = array_slice($sheet->rows, 0, $limit);
	$op = [];
	foreach ($items as $item)
		$op[$slug = $sheet->getValue($item, 'slug')] = humanize($slug);
	return $op;
}
