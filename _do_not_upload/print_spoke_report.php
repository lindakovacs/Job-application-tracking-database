<?php
/*
Author by: Mark E Taylor
Created: 30/04/2013
Last updated: 30/04/2013

Revision history: 
30/04/2013 - Initial creation.

Description: Displays applications that have a status of 'Spoke to agency'.
*/

/* Load some constants. */
include_once("load_config.php");

include_once("library/config.php");
include_once("library/open.php");

$_GET['title'] = 'Spoke to agency report';
include_once("includes/header-htmlhead.php");
include_once("includes/header-navigation.php");
$i=1;

echo "<article>\n<div class='content'>\n";

$query = "SELECT id,role,reference,date FROM ".APP_TABLE." WHERE STATUS='Spoke to agency'";
$result = $database_object->query($query);

echo "<p>Summary of job applications which have a status of 'Spoke to agency'.</p>\n";

if($result->num_rows>0){
	echo "<table id='summary'>";
	echo "<thead><tr><th>No.</th><th>ID</th><th>Role</th><th>Reference</th><th>Date</th></tr></thead><tbody>\n";
	
	while($line = $result->fetch_assoc()){
		echo "<tr>";
		echo "<td class='centre'>$i</td><td class='centre'><a href='edit_job.php?id=$line[id]'>$line[id]</a></td><td>$line[role]</td><td>$line[reference]</td><td>$line[date]</td>";
		echo "</tr>\n";
		$i++;
	}
	echo "</tbody>\n</table>";
} else {
	echo "<p>No applications have a status of 'Spoke to agency' at the moment.</p>\n";
}
$result->free_result();
include_once("library/close.php");

echo "</div><!-- End of content. -->\n</article>\n";

include_once("includes/footer.php");
?>