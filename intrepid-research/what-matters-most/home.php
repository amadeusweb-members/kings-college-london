<?php
function runNodeHome($single = false) {
	runResource('cross-reference', [
		'section' => 'what-matters-most',
		'sectionA' => 'general',
			'prefixA' => 'g-',
		'sectionB' => 'listings',
			'prefixB' => 'l-',
		'title' => 'What Matters Most',
		'singleItem' => $single,
	]);
}

function runNodePage() {
	runNodeHome(variable('node'));
}

runResource(stripExtension(__FILE__), [
	'section' => pathinfo(__DIR__, PATHINFO_FILENAME),
	'where' => __DIR__]);
