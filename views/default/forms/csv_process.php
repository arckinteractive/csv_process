<?php

echo '<br><br>';

// get a list of our callbacks
$options = elgg_trigger_plugin_hook('csv_process', 'callbacks', array(), array());

if (!$options) {
	// we have no callbacks, nothing to show here
	echo elgg_echo('csv_process:nocallbacks');
	return;
}

echo '<label>' . elgg_echo('csv_process:label:callback') . '</label><br>';
echo elgg_view('input/dropdown', array(
	'name' => "callback",
	'options_values' => array_merge(array('' => "SELECT PROCESSOR"), $options)
));
echo elgg_view('output/longtext', array(
	'value' => elgg_echo('csv_process:callback:help'),
	'class' => 'elgg-subtext'
));

echo '<label>' . elgg_echo('csv_process:file:upload') . '</label><br>';
echo elgg_view('input/file', array('name' => 'csv'));
echo elgg_view('output/longtext', array(
	'value' => elgg_echo('csv_process:file:upload:help'),
	'class' => 'elgg-subtext'
));


echo '<label>' . elgg_echo('csv_process:file:location') . '</label>';
echo elgg_view('input/text', array('name' => 'location'));
echo elgg_view('output/longtext', array(
	'value' => elgg_echo('csv_process:file:location:help'),
	'class' => 'elgg-subtext'
));

echo elgg_view('input/submit', array('value' => elgg_echo('submit')));