#csv_process


This is intended for developers who routinely use csvs for functions such as data
imports.

This plugin aims to take much of the legwork out of csv processing.
It provides an admin page for uploading/selecting the csv, selecting the function
to process the csv, setting csv specific settings, and watching/downloading a log
file showing how the script performed.

The form for handling csv functions is found at Admin -> Utilities -> CSV Processing

##Installation

Install/unzip/clone to the mod directory of your elgg installation

The directory should be named csv_process

Enable the plugin through the admin plugins page

##Dependencies

This plugin requires the vroom plugin
[https://github.com/jumbojett/vroom](https://github.com/jumbojett/vroom)


##Integration

There are only 3 steps required to integrate to this plugin

1. Register a plugin hook handler to declare a callback function

2. Declare your callback function

3. Define your callback function


Register your plugin hook handler:
```
elgg_register_plugin_hook_handler('csv_process', 'callbacks', 'myplugin_csv_callbacks');
```

Declare your callback function:
```
function myplugin_csv_callbacks($hook, $type, $return, $params) {	
    $return['myplugin_csv_process'] = elgg_echo('myplugin:handler:label');
    return $return;
}
```
The return value is an associative array with your callback function name as the key
and a label describing the function as a value.  These will be used to populate
the dropdown input for selecting how to process the csv.


Define your callback function
```
/**
 *
 *  @params array()
 */
function myplugin_csv_process($params) {

    static $skipped;

    // you can always know what line you are on with $params
    if ($params['line'] == 1) {
        // first line is our column headers, nothing to do here
        return;
    }

    // the $params['last'] flag indicates that there are is no more data
    // this can be used to log any final tallies or information
    // when the 'last' flag is true data will be an empty array
    if ($params['last']) {
        return "{$params['line']} lines processed, {$skipped} skipped users";
    }

    // our data is an array in $params['data']
    // do something with it
    $user = get_user($params['data'][0]);
    
    if (!$user) {
        $skipped++;
        return; // nothing to do here
    }


    // a returned string from the function will automatically be logged
    // but you can always log extra stuff yourself
    csv_process\log("my log message", $params);
}
```


That's all.  Sort our what to do with your data and let this plugin handle the interface.