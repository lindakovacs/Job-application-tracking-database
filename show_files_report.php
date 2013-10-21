<?php
/*
Author by: Mark E Taylor
Created: 10/07/2013
Last updated: 12/07/2013

Revision history:
10/07/2013 - Initial creation.
12/07/2013 - Updated to allow the deletion of files.

Description: Shows a list of the files stored.
*/

$_GET['title'] = 'Show files';
include_once "includes/header-htmlhead.php";
/* The connection to the database is made in the HTML navigation file, 'header-navigation.php' . */
include_once "includes/header-navigation.php";

echo "<article>\n<div class='content'>\n";

$query = "SELECT * FROM ".UPLOADS_TABLE;
$result = $database_object->query($query);

if ($result->num_rows>0) {
	if($result->num_rows>1){
		echo "<p>There are $result->num_rows files stored in the database:</p>\n";
		} else {
		echo "<p>There is one file stored in the database:</p>\n";
		}
	echo "<table id='summary'>\n";
	echo "<thead><tr><th>Delete</th><th>Job ID</th><th>Filename</th><th>Description</th><th>File size</th><th>Date</th></tr><thead>\n<tbody>\n";

	while ($line = $result->fetch_assoc()) {
		$filesize = number_format($line['filesize']/1024, 0);
		$short_filename = substr($line['filename'], 0, COL_WIDTH_FILENAME);
		$filename = HTTP_UPLOADS_PATH.htmlspecialchars($line['filename']);

		echo "<tr>
				<td><form action='confirm_delete_file.php' method='post'><input type='hidden' name='id' value='$line[id]'><input type='submit' value='Delete'></form></td>
				<td class='centre'><a href='edit_job.php?id=$line[applicationid]'>$line[applicationid]</a></td>
				<td><a href='$filename' target='_blank'>$short_filename</a></td>
				<td>$line[description]</td>
				<td>${filesize}Kb</td>
				<td>$line[dateuploaded]</td>
				</tr>\n";
	}
	echo "</tbody></table>\n";
} else {
	echo "<p>No files stored in the database.</p>";
}
$result->free_result();
include_once "library/close.php";

echo "</div><!-- End of content. -->\n</article>\n";

include_once "includes/footer.php";
?>