<?php

echo elgg_echo('csv_process:process');

$time = get_input('time', false);

echo '<div id="csv-process-results-placeholder">';
if ($time) {
	echo elgg_view('csv_process/ajax/progress', array('time' => $time));
}
echo '</div>';

echo elgg_view_form('csv_process', array('enctype' => 'multipart/form-data'), $vars);