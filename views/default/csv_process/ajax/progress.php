<?php
admin_gatekeeper();

$time = $vars['time'];

$line = '';

$f = fopen(elgg_get_config("dataroot") . "csv_process_log/{$time}log.txt", 'r');
if ($f === false) {
	echo 'No log file found...';
	return;
}

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

if (elgg_is_xhr()) {
	// all we need to supply is the line
	echo $line;
	return;
}
?>

<div id="csv-process-results">
<?php echo $line; ?>
</div>
<?php echo elgg_view('graphics/ajax_loader'); ?>

<script>
	function refresh_log() {
		window.setTimeout(function() {
			$('.elgg-ajax-loader').show();
			elgg.get('ajax/view/csv_process/ajax/progress', {
				data: {
					time: <?php echo $time; ?>
				},
				success: function(result) {
					$('.elgg-ajax-loader').hide();
					if (result != elgg.csv_process.results) {
						$('#csv-process-results').append('<br>' + result);
						elgg.csv_delete.results = result;
					}
					refresh_log();
				}
			});
		}, 2000);
	}
	
	$(document).ready(function() {
		elgg.provide('elgg.csv_process');
		elgg.csv_process.results = '<?php echo $line; ?>';
		refresh_log();
	});
</script>