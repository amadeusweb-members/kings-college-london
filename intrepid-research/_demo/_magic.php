<?php
function after_menu() {
	do_magic_menu('_demo', 'login', [
		'for-office-use',
		'for-contributing-users',
	], true);
	do_magic_menu('_demo', 'signup', [
		'users',
	], false);
}

//when $group false, only a single ignored item is needed
function do_magic_menu($section, $node, $items, $group) {
	extract(variable('menu-settings'));
	$name = humanize($node);

	if ($group) echo '<li class="' . $itemClass . ' ' . $subMenuClass . '"><a class="' . $anchorClass . '">' . $name . '</a>' . NEWLINE;
	if ($group) echo '	<ul class="' . $ulClass . '">' . NEWLINE;

	foreach ($items as $slug) {
		$text = humanize($group ? $slug : $node);

		variable($key = getSectionKey($section, MENUNAME) . '_home', 'off');
		renderHeaderMenu($section, $node . '/' . $slug, $text);
	}

	if ($group) echo '	</ul>' . variable('2nl');
	if ($group) echo '</li>' . NEWLINE;
}

function renderDemoForm($fullFileName) {
	$formName = pathinfo($fullFileName, PATHINFO_FILENAME);

	//PageName	FileName	DriveLink	EmbedLink
	$sheetName = __DIR__ . '/_forms.tsv';
	$sheet = getSheet($sheetName, 'PageName');
	if (!(isset($sheet->group[$formName])))
		peDie('Demo Form Not Found - Kindly Contact the Developer', ['name' => $formName, 'sheet' => $sheetName], false);

	$item = $sheet->group[$formName][0];
	$name = $sheet->getValue($item, 'FileName');
	$link = $sheet->getValue($item, 'DriveLink');
	$embed = $sheet->getValue($item, 'EmbedLink');

	contentBox($formName, 'container after-content');
	h2(humanize($name). ' ' . makeLink('[Edit]', $link));
	//echo getCodeSnippet('latin-2paras') . BRNL . BRNL;

	echo '<div class="deck-container"><iframe style="border-radius: 0px;" src="https://docs.google.com/document/d/e/' . $embed
		 . '/pub?embedded=true"></iframe></div>' . NEWLINES2;
	//2PACX-1vSRzmWrFi1c-pIQ5kkCE_vFhAqt3iCvaLZTTZqALI0E_hKx8vPXzttQ-jfX_AGUKw

	contentBox('end');

	variable('no-page-menu', true);
}
