<?php

echo '<br><br>';

// get a list of our callbacks
$options = elgg_trigger_plugin_hook('csv_process', 'callbacks', array(), array());

if (!$options) {
	// we have no callbacks, nothing to show here
	echo elgg_echo('csv_process:nocallbacks');
	return;
}

asort($options);

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


echo '<label>' . elgg_echo('csv_process:label:delimiter') . '</label>';
echo elgg_view('input/text', array(
	'name' => 'delimiter',
	'value' => ',',
	'size' => 2,
	'maxlength' => 2
));
echo elgg_view('output/longtext', array(
	'value' => elgg_echo('csv_process:label:delimiter:help'),
	'class' => 'elgg-subtext'
));


echo '<label>' . elgg_echo('csv_process:label:enclosure') . '</label>';
echo elgg_view('input/text', array(
	'name' => 'enclosure',
	'value' => '"',
	'size' => 2,
	'maxlength' => 2
));
echo elgg_view('output/longtext', array(
	'value' => elgg_echo('csv_process:label:enclosure:help'),
	'class' => 'elgg-subtext'
));


echo '<label>' . elgg_echo('csv_process:label:escape') . '</label>';
echo elgg_view('input/text', array(
	'name' => 'escape',
	'value' => '\\',
	'size' => 2,
	'maxlength' => 2
));
echo elgg_view('output/longtext', array(
	'value' => elgg_echo('csv_process:label:escape:help'),
	'class' => 'elgg-subtext'
));

echo elgg_view('input/submit', array('value' => elgg_echo('submit')));


?>

<script>
	$('form.elgg-form-csv-process').submit(function(e) {
		if (confirm(elgg.echo('csv_process:form:confirm'))) {
			return true;
		}
		
		return false;
	});
</script>