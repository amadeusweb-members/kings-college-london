<?php
runResource(stripExtension(__FILE__), [
	'section' => pathinfo(__DIR__, PATHINFO_FILENAME),
	'where' => __DIR__]);
