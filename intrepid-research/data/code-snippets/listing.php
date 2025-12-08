<?php
$items = textToList(disk_file_get_contents(__DIR__ . '/dummy-content.txt'));
shuffle($items);
doToBuffering(1);

foreach ($items as $ix => $text) {
	contentBox('end'); contentBox('', 'container' .
		($ix % 2 == 0 ? ' alternate-box' : ''));
	$bits = explode(' ', $text, 4);
	array_pop($bits);
	$heading = implode(' ', $bits);
	h2( humanize($heading) );
	echo $text;
	if ($ix == 3) break;
}

$result = doToBuffering(2);
doToBuffering(3);
return $result;
