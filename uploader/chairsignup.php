<?php
//signup.php
include 'connect.php';
include 'header.php';

echo '<h3>Sign up</h3><br />';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    /*the form hasn't been posted yet, display it
	  note that the action="" will cause the form to post to the same page it is on 
	  if(isset($_POST['myname'])) { echo htmlentities ($_POST['myname']); }
	  */

    echo '
 		<form method="post" action="" id="uploadform">
                    <label for="user-name">
                        <input type="text" name="user_name" id="uploaderfield" placeholder="Username" />
 					</label>
                    
 					<label for="Password">
                        <input type="password" name="user_pass" id="uploaderfield" placeholder="Password" />
 					</label>  
 					<label for="Pass again">
                        <input type="password" name="user_pass_check" id="uploaderfield" placeholder="Password Again" />
 					</label>   
 					<label for="Pass again">
                        <input type="text" name="restrict" id="uploaderfield" placeholder="Restricted ID" />
 					</label>
 					                          
             <br><br>   
            <input type="submit" value="Sign Up" class="btn btn-default btn-black"/>
        </form>
 	 ';
}
else
{
    /* so, the form has been posted, we'll process the data in three steps:
		1.	Check the data
		2.	Let the user refill the wrong fields (if necessary)
		3.	Save the data 
	*/
	$errors = array(); /* declare the array for later use */
	
	if(!empty($_POST['user_name']))
	{
		//the user name exists
		if(!ctype_alnum($_POST['user_name']))
		{
			$errors[] = 'The username can only contain letters and digits.';
		}
		if(strlen($_POST['user_name']) > 30)
		{
			$errors[] = 'The username cannot be longer than 30 characters.';
		}
	}
	else
	{
		$errors[] = 'The username field must not be empty.';
	}
	
	
	if(!empty($_POST['user_pass']))
	{
		if($_POST['user_pass'] != $_POST['user_pass_check'])
		{
			$errors[] = 'The two passwords did not match.';
		}
	}
	else
	{
		$errors[] = 'The password field cannot be empty.';
	}

	if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
	{
		echo 'Uh-oh.. a couple of fields are not filled in correctly..<br /><br />';
	
		foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
		{
			echo '<p><b>' . $value . '</b></p>'; /* this generates a nice error list */
		}
		echo '<br><br><h4><a class="btn btn-default btn-black" href="signup.php">RETURN TO FORM</a></h4>';
	}
	else
	{

		//the form has been posted without, so save it
		//notice the use of mysql_real_escape_string, keep everything safe!
		//also notice the sha1 function which hashes the password
		$sql = "INSERT INTO
					users(user_name, user_pass, user_date, user_level, restricted)
				VALUES('" . mysql_real_escape_string($_POST['user_name']) . "',
					   '" . sha1($_POST['user_pass']) . "',
						NOW(),
						1,
						'" . mysql_real_escape_string($_POST['restrict']) ."')";
						
		$result = mysql_query($sql);
		if(!$result)
		{
			$username = $_POST['user_name'];
			$query = mysql_query("SELECT user_name FROM users WHERE user_name='$username'");
			$counter = mysql_num_rows($query);
			if ($counter != 0) {
				echo 'Sorry this username already exists! Please choose another one. <br><a class="btn btn-default btn-black" href="signup.php">RETURN TO FORM</a>.';
			}
			else {
				echo 'Something went wrong. Try again. <br><a class="btn btn-default btn-black" href="signup.php">RETURN TO FORM</a>.';
			}
		}
		else
		{
			echo 'Succesfully registered. You can now <a href="signin.php">sign in</a> and start posting! :-)';
		}
	}
}

include 'footer.php';
?>
