<?php
/*
Author by: Mark E Taylor
Created: 01/05/2013
Last updated: 18/09/2013

Revision history: 
01/05/2013 - Initial creation.
08/05/2013 - Added some checks for the report number.
18/09/2013 - Updated to accomadate the newly added 'contract' field.

Description: A generalised reporting page.
Usage: print_report.php?reportnumber=n
*/

include_once("includes/header-htmlhead.php");
include_once("includes/header-navigation.php");
	
/* !The MySQL 'where' select clauses and report names. $_GET(reportnumber) will point to one of the items in this array. */
$select_where = array(" WHERE status='spoke to agency'", " WHERE status='in progress'", " WHERE follow_up=TRUE", " WHERE contract=TRUE");
$report_name  = array("Spoke To Agency", "In Progress", "Follow Up", "Contract");
	
	include_once("includes/header-htmlhead.php");
	include_once("includes/header-navigation.php");
	
if(!empty($_GET) && key($_GET)=='reportnumber'){
	$report_number = $_GET['reportnumber'];
} else {
	$report_number = 999;
}

/* !If the report number is valid then display the report. Report numbers are in the range 0 to the size of the array $select_where. */
if($report_number < count($select_where) && $report_number > -1 ){
	$_GET['title'] = "Print '".$report_name[$report_number]." report";

	echo "<article>\n<div class='content'>\n";
	$i=1;

	$query = "SELECT id,role,company,reference,date, salary_high FROM ".APP_TABLE.$select_where[$report_number];
	$result = $database_object->query($query);
	
	if($result->num_rows){
		echo "<p>Summary of job applications which have a status of '".$report_name[$report_number]."'.</p>\n";
	
		echo "<table id='summary'>";
		echo "<thead><tr><th>No.</th><th>ID</th><th>Role</th><th>Company</th><th>Salary high</th><th>Reference</th><th>Date</th></tr></thead><tbody>\n";
		
		while($line = $result->fetch_assoc()){
			echo "<tr>";
			echo "<td class='centre'>$i</td><td class='centre'><a href='edit_job.php?id=$line[id]'>$line[id]</a></td><td>$line[role]</td><td>$line[company]</td><td>&pound;".number_format($line['salary_high'],0)."</td><td>$line[reference]</td><td>$line[date]</td>";
			echo "</tr>\n";
			$i++;
		}
		echo "</tbody>\n</table>";
		} else {
			echo "<p>No applications have a status of '".$report_name[$report_number]."' at the moment.</p>\n";
		}
	$result->free_result();
	
	} else {
	
		$_GET['title'] = "Invalid report number selected";

		echo "<article>\n<div class='content'>\n";
			echo "<p>Incorrect report number provided. Reports available are:</p>";	
			for($rn=0; $rn<count($select_where); ++$rn){
				echo "$rn - $report_name[$rn].<br/>";
			}
		
}

include_once("library/close.php");

echo "</div><!-- End of content. -->\n</article>\n";

include_once("includes/footer.php");
?>