<?php
function enrichThemeVars($vars, $what) {
	if ($what == 'header' && in_array(variable('node'), ['search', 'searches'])) {
		$vars['optional-slider'] = replaceItems(getSnippet('search-slider', CORESNIPPET), _getSearchVars(), '##');
		$vars['video-bgd-link'] = replaceHtml('%network-url%home-search-206173.mp4');
	}

	return $vars;
}

function _getSearchVars() {
	return [
		'above-rotate' => 'A Caring Platform, we invite all',
		'rotate-items' => 'People With Lived Experiences, Their Carers &amp; Family, Therapists &amp; Psychologists, Doctors &amp; Hospital Staff, Friends &amp; Support Groups, and a Caring Public',
		'lead-message' => 'To Co-Heal as One Community&hellip;',
		'content-after-search' => getCodeSnippet('search', CORESNIPPET),
	];
}
