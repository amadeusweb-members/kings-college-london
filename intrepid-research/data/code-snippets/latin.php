<?php
$items = textToList(disk_file_get_contents(__DIR__ . '/dummy-content.txt'));
shuffle($items);

return 'Here is <strong>some random latin text</strong>, meant as a placeholder until the file mentioned below is edited:<hr>' . implode(BRTAG . BRTAG . NEWLINES2, [$items[0], $items[1], $items[2], $items[3]]) . '<hr style="width: 60%; border-top: 3px solid teal;"><strong>Additionally</strong>, you can contact us in this DEMO STAGE using the big plus button at the bottom right corner (<strong>to be done</strong>).';
