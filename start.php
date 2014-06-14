<?php

namespace csv_process;

elgg_register_event_handler('init', 'system', __NAMESPACE__ . '\\init');

function init() {
	elgg_register_action('csv_process', dirname(__FILE__) . '/actions/csv_process.php', 'admin');
	
	elgg_register_admin_menu_item('administer', 'csv_process', 'administer_utilities');
	
	elgg_register_ajax_view('csv_process/ajax/progress');
}


function process_csv() {
	$time = elgg_get_config('csv_process_time');
	$location = elgg_get_config('csv_process_location');
	$csv_callback = elgg_get_config('csv_process_callback');
	
	$fp = fopen(elgg_get_config("dataroot") . "csv_process_log/{$time}log.txt", "w");
	
	$lines = 0;
	if(($handle = fopen($location, 'r')) !== false) {
			
		while(($data = fgetcsv($handle)) !== false) {
			$lines++;

			$log = $csv_callback($data, $lines);
			
			if ($log) {
				fputs($fp, $log . "\n");
			}
		}
		fclose($handle);
	}

	$log_location = elgg_get_config("dataroot") . "csv_process_log/{$time}log.txt";
    fputs($fp, elgg_echo('csv_process:complete', array($lines, $log_location)) . "\n");
	fclose($fp);
	
}
