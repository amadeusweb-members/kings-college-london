<?php
return runResource(stripExtension(__FILE__), [
	'section' => pathinfo(__DIR__, PATHINFO_FILENAME),
	'where' => __DIR__,
	'limit' => isset($limit) ? $limit : -1,
	'callingFrom' => isset($callingFrom) ? $callingFrom : 'unknown',
]);
