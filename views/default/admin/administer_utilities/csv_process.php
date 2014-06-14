<?php

echo elgg_echo('csv_process:process');

$time = get_input('time', false);

if ($time) {
	echo elgg_view('csv_process/ajax/progress', array('time' => $time));
}


echo elgg_view_form('csv_process', array('enctype' => 'multipart/form-data'), $vars);