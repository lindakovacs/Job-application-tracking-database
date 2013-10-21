<?php 
/*
Author by: Mark E Taylor
Created: 10/10/2012
Last updated: 28/04/2013

Revision history: 
10/10/2012 - Initial creation.
28/04/2013 - Added new configuration item SUMMARY_REPORTING_DAYS.

Description: Sets configutation items for the application.

If a new config item needs to be added then first add it to the database and then update this form. No other code changes needs to be made to the application, i.e. save_config.php does not need to be updated.

NOTE: The 'name' of any input item needs to be the same as the value used in the config tablein the 'item' column.
This is because the save_config.php file usese this value as the key to updating the config table.
*/

$_GET['title'] = 'Configuration';
include_once("includes/header-htmlhead.php");
include_once("includes/header-navigation.php");

print<<<END
<article>
<div class="content">

<p>Update application configuration:</p>

<form action="save_config.php" method="post" id="met-form">

<fieldset title="configuration">
	<legend>Configuration</legend>
END;

echo "<label>Number of items on summary page:</label>\n";
echo "<input type='number' name='summary_number' min=1 max=35 value=".SUMMARY_NUMBER.">\n";

echo "<label>Width of the 'email' column:</label>\n";
echo "<input type='number' name='col_width_email' min=1 max=35 value=".COL_WIDTH_EMAIL.">\n";

echo "<label>Width of the 'role' column:</label>\n";
echo "<input type='number' name='col_width_role' min=1 max=35 value=".COL_WIDTH_ROLE.">\n";

echo "<label>Width of the 'agency' column:</label>\n";
echo "<input type='number' name='col_width_agency' min=1 max=35 value=".COL_WIDTH_AGENCY.">\n";

echo "<label>Width of the 'reference' column:</label>\n";
echo "<input type='number' name='col_width_reference' min=1 max=30 value=".COL_WIDTH_REFERENCE.">\n";
	
echo "<label>Number of days to summarise on the front page:</label>\n";
echo "<input type='number' name='summary_reporting_days' min=1 max=30 value=".SUMMARY_REPORTING_DAYS.">\n";

echo "<label>Number of days to summarise on the activity report:</label>\n";
echo "<input type='number' name='activity_days' min=1 max=30 value=".ACTIVITY_DAYS.">\n";

echo "<label>Width of the 'filename' column on the show files report page:</label>\n";
echo "<input type='number' name='col_width_filename' min=1 max=160 value=".COL_WIDTH_FILENAME.">\n";

echo "<label>Maximum size of files (PDFs) that can be uploaded in bytes:</label>\n";
echo "<input type='number' name='max_uploaded_file_size' min=1 max=256000 value=".MAX_UPLOADED_FILE_SIZE.">\n";

print<<<END
</fieldset>

<input type="submit" title="Update configuration" value="Update configuration" class="clearfix">
</form>

</div> <!-- End of content. -->
</article>
END;

include_once("includes/footer.php");
?>