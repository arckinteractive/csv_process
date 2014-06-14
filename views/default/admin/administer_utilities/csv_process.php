<?php

echo elgg_echo('csv_process:process');

echo elgg_view_form('csv_process', array('enctype' => 'multipart/form-data'), $vars);

$time = get_input('time', false);

if ($time) {
	echo '<br><br><br>';
	echo elgg_view('csv_process/ajax/progress', array('time' => $time));
}