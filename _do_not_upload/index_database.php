<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8" />

<meta name="keywords" content="WORD, WORD" />
<meta name="description" content="WORD, WORD" />
<meta name="author" content="Mark E Taylor" />
<meta name="copyright" content="&copy; 2000-<?php date_default_timezone_set('Europe/London'); echo date('Y');?> Mark E Taylor" />

<meta name="verify-v1" content="UljtH7LG3ckJ7GA201Lp5RkN/e+OeG9owhnmzmfYhos=" />

<link href="data/feed_NAME.xml" rel="alternate" type="application/rss+xml" title="TITLE" />

<link href="css/style.css"  rel="stylesheet" media="screen" type="text/css" />
<title></title>

</head>

<?php
include_once("includes/variables.php");

/* Connect to database. */
include_once("library/config.php");
include_once("library/open.php");

$table = 'table_name';
$value = 'value';
$col1 = 'col_name';  /* Date field. */
$col2 = 'col_name';
$col3 = 'col_name';
$col4 = 'col_name';

$query = "SELECT $col1, $col3, $col4, DATE_FORMAT($col2 ,\"%W %D %M %Y @ %l:%i%p\") as $col2 FROM $table where ID=$value";

$result = @mysql_query($query) or die('Query failed: ' . mysql_error());
$number_of_rows = mysql_num_rows($result);

/* If you get back only one row. */
$row = mysql_fetch_assoc($result);

/* How to create a set associative array. */
$details = array($col1=>$row[$col1], $col2=>$row[$col2], $col3=>$row[$col3], $col4=>$row[$col4]);

/* ********* Or as a table. ********* */
/* Printing results in HTML table. */
/* The caption before the table is the SQL query. Debug only. */
echo "<table>\n<caption>Statement used to create table: $query </caption>";

/* Top row of table. */
echo "<tr><td> $col1 </td><td> $col2 </td><td> $col3 </td><td> $col4 </td><td> $col5 </td></tr>";

while ($row = mysql_fetch_row($result)) {
	echo "\t<tr>\n";
	foreach ($row as $col_value) {
	    echo "<td>$col_value</td>\n";
	}
	echo "</tr>\n";
}
echo "</table>\n";

/* INSERT */
$query = "INSERT INTO $table ($column1, $column2) VALUE($value1, $value2)";

/* UPDATE */
$query = "UPDATE $table SET $column1=$value1,$column1=$value1 WHERE ID=1";

/* Free resources and close the database. */
mysql_free_result($result);
include_once("library/close.php");

?>

<body>
</body>

</html>