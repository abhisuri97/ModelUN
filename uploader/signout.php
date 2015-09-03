<?php
//signout.php
include 'connect.php';
include 'header.php';

echo '<h2>Sign out</h2>';

//check if user if signed in
if($_SESSION['signed_in'] == true)
{
	//unset all variables
	$_SESSION['signed_in'] = NULL;
	$_SESSION['user_name'] = NULL;
	$_SESSION['user_id']   = NULL;

	echo 'Succesfully signed out, thank you for visiting. <br> <a href="http://www.smhmun.org" class="btn btn-default btn-black">Return to main site</a> <br><br>
	<a href="signin.php" class="btn btn-default btn-black">Sign in again</a> ';
}
else
{
	echo 'You are not signed in. Would you <a href="signin.php">like to</a>?';
}

include 'footer.php';
?>
