<?php

$english = array(	
	'csv_process:process' => "Process CSV",
	'admin:administer_utilities:csv_process' => "CSV Processing",
	'csv_process:nocallbacks' => "There are no csv processing utilities registered",
	'csv_process:error:invalid:callback' => "Invalid csv processing callback",
	'csv_process:error:upload' => "There was a problem with the file upload",
	'csv_process:callback:help' => "Make sure you pick the correct processing selection.  Processing a csv with the wrong function can lead to unexpected results.  It's recommended you back up your database before processing csvs that will add/edit/remove data from the system",
	'csv_process:file:upload' => "Upload CSV",
	'csv_process:file:upload:help' => "If the csv is small enough you may upload it directly here",
	'csv_process:file:location' => "CSV Location",
	'csv_process:file:location:help' => "For files too large to upload, enter the filesystem path to the csv",
	'csv_process:label:callback' => "CSV Processor",
	'csv_process:complete' => "CSV Processing is complete.  %s lines were processed.  This full log can be found at %s",
	'csv_process:error:uncallable:callback' => "Callback function cannot be found on this system",
);
					
add_translation("en", $english);
