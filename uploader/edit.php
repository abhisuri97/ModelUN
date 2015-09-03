<?php
include 'connect.php';
include 'header.php';
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$delname = mysql_query("SELECT * FROM posts where post_id='$id'");
	$query2=mysql_fetch_array($delname);
	if(isset($_FILES['doc']))
			{
			    $errors= array();
			    $file_name = $_FILES['doc']['name'];
			    $file_size =$_FILES['doc']['size'];
			    $file_tmp =$_FILES['doc']['tmp_name'];
			    $file_type=$_FILES['doc']['type'];   
			    $tmp = explode('.',$_FILES['doc']['name']);
			    $file_ext=strtolower(end($tmp));
			    $extensions = array("pdf","docx"); 		
			    if(in_array($file_ext,$extensions )=== false){
			     	$errors[]="extension not allowed, please choose a pdf or docx file.";
			    }
			    if($file_size > 20971520){
			    	$errors[]='File size must be less than 20 MB';
			    }
			    $file_newname2 = $query2['delegate_name'] . '_edited_' . $query2['country_name'] . '_' . time() . '.' .end($tmp);			
	
			    if(empty($errors)==true)
			    {
			        move_uploaded_file($file_tmp,"uploads/".$file_newname2);
			        $query4=mysql_query("update posts set upload_url='$file_newname2' where post_id='$id'");
					if($query4)
					{
						echo 'Success. Go back to the <a href="summary.php"> Summary </a> tab.';
					}
			    }
			    else
			    {
			        echo "There was a problem with uploading. Please check to see if the file was less than 20 MB and was in .PDF or .DOCX format. Try again.";
			    }
			}
}

echo '

					<form enctype="multipart/form-data" method="post" action="" id="uploadform">
                    <label for="delegate-name">
                        <input type="text" name="delegate-name" id="uploaderfield" placeholder="' . $query2['delegate_name'] . '" readonly/>
 					</label>
                     <label for="ccmember">
                        <input type="text" name="country" id="uploaderfield" placeholder="' . $query2['country_name'] . '" readonly/>
            		 </label>                                       
            <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-primary btn-file">
                        Upload Paper<input type="file" name="doc">
                    </span>
                </span>
                <input type="text" class="form-control" id="uploaderfield" readonly>
            </div>
       
             <br><br>   
            <input type="submit" value="Submit Paper" class="btn btn-default btn-black"/>
        </form>';

include 'footer.php';
?>
