<?php
/*
Author by: Mark E Taylor
Created: 10/10/2012
Last updated: 10/10/2012

Revision history: 
10/10/2012 - Initial creation.
11/10/2012 - Updated so it becomes generalized.

Description: Updates the 'config' table with values past on from 'config.php'.
A new config item can be added to config.php without having to amend this code.
*/

include_once("library/config.php");
include_once("library/open.php");

$config_table = "config";
$size = sizeof($_POST);

/*
Loop through the $_POST array. Dynamically create the SQL UPDATE command.
The PHP keyword 'current' returns the current element value in an array.
The PHP keyword 'key' returns the current key value in an array.
The PHP keyword 'next' moves the array pointer forward by one position.
Example query: UPDATE config SET value=7 WHERE item=summary_reporting_days
*/
for($i=0;$i<=($size-1);$i++){
	$query = "UPDATE $config_table SET value=".current($_POST)." WHERE item='".key($_POST)."'";
	$result = $database_object->query($query);
	next($_POST);
}

if($result){
	header ('location: index.php');
} else {
	header ('location: config.php?config_save=false');
}
?>