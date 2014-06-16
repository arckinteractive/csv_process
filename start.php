<?php

namespace csv_process;

elgg_register_event_handler('init', 'system', __NAMESPACE__ . '\\init');

function init() {
	elgg_extend_view('css/admin', 'css/admin/csv_process');
	
	elgg_register_admin_menu_item('administer', 'csv_process', 'administer_utilities');
	
	elgg_register_plugin_hook_handler('csv_process', 'callbacks', __NAMESPACE__ . '\\register_demo_handler');
	
	elgg_register_action('csv_process', dirname(__FILE__) . '/actions/csv_process.php', 'admin');
	elgg_register_action('csv_process/log_download', dirname(__FILE__) . '/actions/log_download.php', 'admin');
	
	elgg_register_ajax_view('csv_process/ajax/progress');
}


/**
 * process the csv
 */
function process_csv() {
	ini_set('auto_detect_line_endings', TRUE);
	
	$time = elgg_get_config('csv_process_time');
	$location = elgg_get_config('csv_process_location');
	$csv_callback = elgg_get_config('csv_process_callback');
	$delimiter = elgg_get_config('csv_process_delimiter');
	$enclosure = elgg_get_config('csv_process_enclosure');
	$escape = elgg_get_config('csv_process_escape');

	$lines = 0;
	if(($handle = fopen($location, 'r')) !== false) {
			
		while(($data = fgetcsv($handle, 0, $delimiter, $enclosure, $escape)) !== false) {
			$lines++;

			$params = array('data' => $data, 'line' => $lines, 'last' => false, 'time' => $time);
			$log = $csv_callback($params);
			
			if ($log) {
				log($log, $params);
			}
		}
		fclose($handle);
	}
	
	// call the callback one last time with the final line count so they can log summary info
	$log = $csv_callback(array(), $lines, true);
	if ($log) {
		log($log, array('time' => $time));
	}

    log(elgg_echo('csv_process:complete', array($lines)), array('time' => $time));
}


/**
 * register a demo handler for a csv
 * 
 * @param type $hook
 * @param type $type
 * @param array $return
 * @param type $params
 * @return type
 */
function register_demo_handler($hook, $type, $return, $params) {
	$label = elgg_echo('csv_process:handler:label');
	$handler = __NAMESPACE__ . '\\demo_handler';
	
	$return[$handler] = $label;
	
	return $return;
}


/**
 * do something with our data
 * returned strings will sent to the log for this instance
 * 
 * @param type $data
 * @param type $line
 */
function demo_handler($params) {
	if ($params['last']) {
		return "Log some summary information... after {$params['line']} lines";
	}
	
	// $data is an array of values from the row
	// $line is the line number we're processing
	
	//sleeping as this is super-fast, lets let the log show for the demo
	sleep(1);
	
	// log every line here for demo purposes
	// for something like a line count it's best for performance not to log every line
	// you can log intervals of lines with a modulus check
	// eg. if ($line % 100) { return $line . ' lines processed'; } else { return false; }
	// will log every 100th line
	return "First Cell: {$params['data'][0]}, Line: {$params['line']}";
}


function log($message, $params) {
	file_put_contents(elgg_get_config("dataroot") . "csv_process_log/{$params['time']}log.txt", $message . "\n", FILE_APPEND);
}