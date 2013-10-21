<?php
/*
Author by: Mark E Taylor
Created: 11/09/2013
Last updated: 12/09/2013

Revision history: 
11/09/2013 - Initial creation.
12/09/2013 - Finalised code.

*** Two factor authentication system - part 1. ***

Description: Entry page for the two factor authentication system.
Requests a user name and password before proceding onto auth_send_code.php
*/

session_start();

/*
If the page has not been entered before these system variables will not be set.
If they are not then the login page will be displayed.
If they are set then check the user name and password before continuing to the auth_send_code.php page.
*/
if(isset($_POST['userid']) && isset($_POST['password'])){
	/* Load some constants. */
	include_once("library/config.php");
	include_once("library/open.php");
	include_once("library/auth_functions.php"); /* Redirect() and KillSession() */
	include_once("load_config.php");

	$userId   = $_POST['userid'];
	$password = $_POST['password'];
		
	/* Check if the user id and password combination exist in database. Compare the encrypted password attempt against the encrypted stored password. */
	$query = "SELECT userid,password FROM ".USERS_TABLE." WHERE userid='".$userId."' AND HEX(AES_ENCRYPT('".$password."', 'Gogingve580Meocedha504'))=password";
	$result = $database_object->query($query);
	
	if ($result->num_rows==1){
	/* The user id and password match so set the session and open the next page. */
		$_SESSION['db_is_logged_in'] = true;
		$_SESSION['userid'] = $userId;
		Redirect('auth_send_code.php', $Bln_Replace = 1, $Int_HRC = NULL);
		exit(0);
	} else {
		Redirect('auth_password.php', $Bln_Replace = 1, $Int_HRC = NULL);
		exit(0);
	}
	include "library/close.php";
}

print<<<END
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8" />

<link href="css/style.css" rel="stylesheet" media="screen" type="text/css" />
<link href="css/forms.css" rel="stylesheet" media="screen" type="text/css" />
<link href="css/table.css" rel="stylesheet" media="screen" type="text/css" />

<title>Logon page</title>
</head>
<body>

<form action="" method="post" id="login">
 <table>
  <tr>
   <td>User name</td>
   <td><input name="userid" type="text"></td>
  </tr>
  <tr>
   <td>Password</td>
   <td><input name="password" type="password"></td>
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