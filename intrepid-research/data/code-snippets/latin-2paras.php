<?php
$items = textToList(disk_file_get_contents(__DIR__ . '/dummy-content.txt'));
shuffle($items);

return implode(BRTAG . BRTAG . NEWLINES2, [$items[0]]);
