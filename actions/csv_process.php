<?php

namespace csv_process;

set_time_limit(0);

$callback = get_input('callback', false);
$options = elgg_trigger_plugin_hook('csv_process', 'callbacks', array(), array());
$location = get_input('location');

if (!$callback || !in_array($callback, array_keys($options))) {
	register_error(elgg_echo('csv_process:error:invalid:callback'));
	forward(REFERER);
}


if (!is_callable($callback)) {
	register_error(elgg_echo('csv_process:error:uncallable:callback'));
	forward(REFERER);
}

if ((!$_FILES['csv']['tmp_name'] || $_FILES['csv']['error']) && !$location) {
	register_error(elgg_echo('csv_process:error:upload'));
	forward(REFERER);
}

elgg_register_event_handler('shutdown', 'system', __NAMESPACE__ . '\\process_csv');

$time = time();
$csv_location = $location ? $location : $_FILES['csv']['tmp_name'];

elgg_set_config('csv_process_time', $time);
elgg_set_config('csv_process_location', $csv_location);
elgg_set_config('csv_process_callback', $callback);

if (!file_exists(elgg_get_config('dataroot') . 'csv_process_log')) {
	mkdir(elgg_get_config('dataroot') . 'csv_process_log'); 
}

forward('admin/administer_utilities/csv_process?time=' . $time);
