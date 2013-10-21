<?php
/*
Author by: Mark E Taylor
Created: 11/09/2013
Last updated: 12/09/2013

Revision history: 
11/09/2013 - Initial creation.
12/09/2013 - Finalised code and added a function to destroy the session.

BUG: Needs a better way to ensure that the user is logged in and this code is not called directly.

*** Two factor authentication system - part 2. ***

Description: Called by auth_password.php.
Sends a unique code to the user to be inputted into auth_request_code.php.
*/

session_start();

include_once("library/auth_functions.php"); /* Redirect() and KillSession() */

/* Is the person accessing this page logged in or not? */
if(!isset($_SESSION['db_is_logged_in']) || $_SESSION['db_is_logged_in'] !== true){
/* If not logged in then return to login page */
	header('Location: auth_password.php');
	KillSession();
	exit;
}

/* Process steps:
1. Craate the temporary code.
2. Store in the code in the database next to users name. Store a expiration time next to the code.
3. Get the users email address from the database.
4. Send the email with the code to the user.
5. Go to the page that will request that code.
*/

/* 1. Craate the temporary code. Pad to six digits, i.e. add leading zeros. */
$code = str_pad(mt_rand(0,999999), 6, "0", STR_PAD_LEFT);

/* 2. Store in the code in the database next to users name. */
/* Load some constants. */
include_once("library/config.php");
include_once("library/open.php");
include_once("load_config.php");

/* Set a time some seconds in the future when the code will no longer be considered valid. */
/* See http://uk3.php.net/manual/en/datetime.add.php */
$now = new DateTime("now");
$expired = $now->add(new DateInterval('P0Y0M0DT0H0M'.LOGON_CODE_EXPIRATION_PERIOD.'S'));
/* Convert the date object to one that can be stored as a string. */
$expired = $expired->format('Y-m-d H:i:s');
  
$userid = $_SESSION['userid'];
$query = "UPDATE ".USERS_TABLE." SET CODE=$code, expired='$expired' WHERE userid='$userid'";
$result = $database_object->query($query);

$name = ucfirst($userid);

/* 3. Get users email address from the database. */
$query = "SELECT email from ".USERS_TABLE." WHERE userid='$userid'";
$result = $database_object->query($query);
$row = $result->fetch_assoc();
$to = $row['email'];
include "library/close.php";

/* 4. Send the email with the code to the user. */
$subject = "Your unlock code";

$message = "<html>
<head>
</head>
<body>
	<h2>Hi, $name here is your unlock code: $code.</h2>
	<p>This code is valid until: $expired</p>
</body>
</html>";

/* To send HTML mail, the Content-type header must be set */
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
$headers .= 'From: FastPi' . "\r\n" . 'Reply-To: none' . "\r\n" . 'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

/* 5. Go to the page that will request that code. */
header('Location: auth_request_code.php');
?>