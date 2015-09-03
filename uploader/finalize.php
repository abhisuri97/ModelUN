<?php
//create_cat.php
include 'connect.php';
include 'header.php';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	//someone is calling the file directly, which we don't want
	echo 'This file cannot be called directly.';
}
else
{
	//check for sign in status
	if(!isset($_SESSION['signed_in']))
	{
		echo 'You must be signed in to post a upload.';
	}
	else
	{
	    {	$one = 1;
	    	$id = $_GET['id'];
			 		$sql = "UPDATE topics SET finalized='$one' WHERE topic_id='$id'";
									
					$result = mysql_query($sql);
					if($result)
					{
						echo 'Thank you. You have successfully marked your scores as finalized. Go back to the <a href="committee.php?id='.$_SESSION['user_restrict'] .'"> home </a> page.';
					}
					else {echo 'fail';}
			 
			// if(isset($_FILES['doc']))
			// {
			//     $errors= array();
			//     $file_name = $_FILES['doc']['name'];
			//     $file_size =$_FILES['doc']['size'];
			//     $file_tmp =$_FILES['doc']['tmp_name'];
			//     $file_type=$_FILES['doc']['type'];   
			//     $tmp = explode('.',$_FILES['doc']['name']);
			//     $file_ext=strtolower(end($tmp));
			//     $extensions = array("pdf","docx"); 		
			//     if(in_array($file_ext,$extensions )=== false){
			//      	$errors[]="extension not allowed, please choose a pdf or docx file.";
			//     }
			//     if($file_size > 20971520){
			//     	$errors[]='File size must be less than 20 MB';
			//     }
			//     $file_newname = $_POST['delegate-name'] . '_' . $_POST['country'] . '.' .end($tmp);				
			//     if(empty($errors)==true)
			//     {
			//         move_uploaded_file($file_tmp,"uploads/".$file_newname);
			//         $sql = "INSERT INTO 
			// 			posts(delegate_name,
			// 			country_name,
			// 			upload_url,
			// 			post_date,
			// 			post_topic,
			// 			post_by) 
			// 			VALUES ('" . $_POST['delegate-name'] . "',
			// 					'" . $_POST['country'] . "',
			// 					'" . $file_newname . "',
			// 						NOW(),
			// 						" . mysql_real_escape_string($_GET['id']) . ",
			// 						" . mysql_real_escape_string($_POST['school_name']) . ")";
									
			// 		$result = mysql_query($sql);
									
			// 		if($result && empty($errors)==true)
			// 		{
			// 			echo 'Thank you. Your paper has been submitted for review. View the <a href="summary.php">Summary</a> tab to view scores, delegates, and edit paper uploads.';
			// 		}
					
			// 	}
			// 	else
			//     {
			//         echo "There was a problem with uploading. Please check to see if the file was less than 20 MB and was in .PDF or .DOCX format. <b><a href='committee.php?id=" . $_GET['id'] . "'>Redo the form</a></b>.";
			//     }
					
			 }
			 
			    
			}
		}
	


include 'footer.php';
?>