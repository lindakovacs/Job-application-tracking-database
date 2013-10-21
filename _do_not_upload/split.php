<?php
/*
Author by: Mark E Taylor
Created: 12/10/2012
Last updated: 12/10/2012
Usage: php -f split.php
Revision history: 
12/10/2012 - Initial creation.

Description: 
*/

include_once("load_config.php");
include_once("library/config.php");
include_once("library/open.php");
$names = array();

$query = "SELECT id, contact_name FROM ".APP_TABLE." WHERE contact_name<>''";
$result = $database_object->query($query);

while($line = $result->fetch_array(MYSQLI_ASSOC)){
	
	$names = explode(" ", $line['contact_name']);
	
	echo "First name = $names[0] and last name = $names[1]\n";
	
	$query2 = "UPDATE ".APP_TABLE." SET first_name='$names[0]', last_name='$names[1]',contact_name='' WHERE id=$line[id]";
	$insert = $database_object->query($query2);
}

?>