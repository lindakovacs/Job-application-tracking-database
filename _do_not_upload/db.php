<?php
/*
Author by: Mark E Taylor
Created: 25/09/2012
Last updated: 25/09/2012
Usage: php -f db.php
Revision history: 
25/09/2012 - Initial creation.

Description: Inserts random numbers into a database table.
*/

include_once("includes/variables.php");

$number = 10;
$table = 'random';
$col1 = 'power';
$random_high = 10000;
$random_low = 10;

include_once("library/config.php");
include_once("library/open.php");

echo "Inserting $number random numbers (between $random_low and ".RANDOM_HIGH.") into the table $table in the database ".DATABASE.".\n";

for($i=1;$i<=$number;$i++){
	$random = rand($random_low, RANDOM_HIGH);
	
	$query = "INSERT INTO $table ($col1) VALUE($random)";

	$result = mysql_query($query) or die("Query failed: ".mysql_error().".\n");
}

/* As no real results are returned there is no need to free the results resource.  If the query works it will return a sucess code of 0. */

if(!$result){
	echo "Something may have gone wrong as the result code was not 0.\n";
	var_dump($result);
	mysql_free_result($result);
}

include_once("library/close.php");

echo "All done.\n";
?>