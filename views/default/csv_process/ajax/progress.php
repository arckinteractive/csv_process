<?php
admin_gatekeeper();

$time = $vars['time'];

$line = '';

$filename = elgg_get_config("dataroot") . "csv_process_log/{$time}log.txt";

$f = false;
if (file_exists($filename)) {
	$f = @fopen($filename, 'r');
}

if ($f === false) {
	$line = 'Waiting for log initiation...';
} else {
	$cursor = -1;

	fseek($f, $cursor, SEEK_END);
	$char = fgetc($f);

	/**
	 * Trim trailing newline chars of the file
	 */
	while ($char === "\n" || $char === "\r") {
		fseek($f, $cursor--, SEEK_END);
		$char = fgetc($f);
	}

	/**
	 * Read until the start of file or first newline char
	 */
	while ($char !== false && $char !== "\n" && $char !== "\r") {
		/**
		 * Prepend the new char
		 */
		$line = $char . $line;
		fseek($f, $cursor--, SEEK_END);
		$char = fgetc($f);
	}
}

if (elgg_is_xhr() && !elgg_extract('full_view', $vars, false)) {
	// all we need to supply is the line
	echo $line;
	return;
}

$download_link = elgg_view('output/url', array(
	'text' => elgg_echo('csv_process:log:download'),
	'href' => 'action/csv_process/log_download?time=' . $vars['time'],
	'is_action' => true
		));

echo '<div id="csv-process-results"></div>';
echo elgg_view('output/longtext', array(
	'value' => elgg_echo('csv_process:log:download:blurb', array($download_link)),
	'class' => 'elgg-subtext'
));
?>
<script>
	require(['csv_process/ajax/progress'], function (Progress) {
		var p = new Progress(<?= json_encode($time) ?>);
		p.addLine(<?= json_encode($line) ?>);
		p.init();
	});
</script>