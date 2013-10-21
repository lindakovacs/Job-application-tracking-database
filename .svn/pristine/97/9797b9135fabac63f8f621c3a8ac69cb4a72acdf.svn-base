<?php
/*
Author by: Mark E Taylor
Created: 11/09/2013
Last updated: 12/09/2013

Revision history: 
11/09/2013 - Initial creation.
12/09/2013 - Finalised code.

*** Two factor authentication system - part 3. ***

Description: Final code in the authentication system. Called by auth_send_code.php.
Requests the code (sent by email) before continuing onto index.php
*/

session_start();

/*
If the page has not been entered before these system variables will not be set.
If they are not then the login page will be displayed.
If they are set then check then for the code (sent by email) before continuing onto index.php.
*/
if(isset($_POST['code']) and isset($_SESSION['db_is_logged_in'])==true){
	/* Load some constants. */
	include_once("library/config.php");
	include_once("library/open.php");
	include_once("library/auth_functions.php"); /* Redirect() and KillSession() */
	include_once("load_config.php");
		
	$code = $_POST['code'];
	$userid = $_SESSION['userid'];
		
	/* Check the user code against the database. */
	$query = "SELECT code, expired FROM ".USERS_TABLE." WHERE userid = '$userid'";
	$result = $database_object->query($query);
	$row = $result->fetch_assoc();
	$db_code = $row['code'];
	$timestamp = $row['expired'];

	$now = new DateTime("now");
	$timestamp = new DateTime($timestamp);
	
/* 	If 'now' < (expired + LOGON_CODE_EXPIRATION_PERIOD) then continue and check the code is correct. */
if($now <= $timestamp){
			/* Now check if the code is correct. If the user code matches then set the session variables and then open index.php. */
			/* Also reset the expired time and the code in the database. */
				if($code == $db_code){
					$query = "UPDATE ".USERS_TABLE." SET code=NULL, expired=NULL WHERE userid = '$userid'";
					$result = $database_object->query($query);
					include "library/close.php";
					$_SESSION['user_'.$userid.'_logged_in'] = true;
					$_SESSION['userid'] = $userid;
					Redirect('index.php', $Bln_Replace = 1, $Int_HRC = NULL);
					exit(0);
				} else {
					include "library/close.php";
					Redirect('auth_password.php', $Bln_Replace = 1, $Int_HRC = NULL);
					exit(0);
				}
} else {
	$_SESSION['code_expired'];
	Redirect('auth_password.php', $Bln_Replace = 1, $Int_HRC = NULL);
	exit(0);
	}
}

print<<<END
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8" />

<link href="css/style.css" rel="stylesheet" media="screen" type="text/css" />
<link href="css/forms.css" rel="stylesheet" media="screen" type="text/css" />
<link href="css/table.css" rel="stylesheet" media="screen" type="text/css" />

<title>Code request page</title>
</head>
<body>

<form action="" method="post" id="code">
 <table>
  <tr>
   <td>Unlock code</td>
   <td><input name="code" type="number" size="6" min="0" max="999999" ></td>
  </tr>
  <tr>
   <td></td>
   <td><input name="login" type="submit" value="Login"></td>
  </tr>
 </table>
</form>

</body>
</html>
END;
?>