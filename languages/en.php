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
	'csv_process:file:location:help' => "For files too large to upload, enter the filesystem path to the csv.  Make sure the file has correct permissions and is readable by the webserver.",
	'csv_process:label:callback' => "CSV Processor",
	'csv_process:complete' => "CSV Processing is complete.  %s lines were processed.",
	'csv_process:error:uncallable:callback' => "Callback function cannot be found on this system",
	'csv_process:handler:label' => "Demo CSV Handler",
	'csv_process:label:delimiter' => "Delimiter",
	'csv_process:label:delimiter:help' => "Character that separates the cells - default: comma",
	'csv_process:label:enclosure' => "Enclosure",
	'csv_process:label:enclosure:help' => "Character that encloses cell data - default: double-quote",
	'csv_process:label:escape' => "Escape",
	'csv_process:label:escape:help' => "Character that escapes special characters - default: back-slash",
	'csv_process:form:confirm' => "Double-check your settings.  The wrong csv with the wrong handler, or wrong delimiter etc. can lead to unexpected results.  Are you sure you want to continue?",
	'csv_process:error:empty:args' => "Delimiter, enclosure, and escape must be defined",
	'csv_process:nofile' => "File not found",
	'csv_process:log:download' => "Download Log",
	'csv_process:log:download:blurb' => "This is a preview of the log for this process.  The last line of the log is retrieved every 2 seconds, so not all lines may show here.  This is intended to show the progress of the script.  The full log can be downloaded here: %s",
	'csv_process:nolog' => "Waiting for log initiation...",
);
					
add_translation("en", $english);
