<?php

$time = get_input('time');

$filename = elgg_get_config("dataroot") . "csv_process_log/{$time}log.txt";

if (!file_exists($filename)) {
	register_error(elgg_echo('csv_process:nofile'));
	forward(REFERER);
}

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($filename));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filename));
readfile($filename);
exit;