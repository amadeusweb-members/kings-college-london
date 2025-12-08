<?php
//NB: no longer using 'section-cards'
runResource(stripExtension(__FILE__), [
	'section' => 'general',
	'title' => 'General Topics',
	'where' => __DIR__,
]);
