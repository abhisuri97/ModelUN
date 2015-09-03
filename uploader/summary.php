<?php
//create_cat.php
include 'connect.php';
include 'header.php';

$sql = "SELECT
			topic_id,
			topic_subject
		FROM
			topics";
			
$result = mysql_query($sql);
$grand_total = 0;
$counter = 0;
if(!isset($_SESSION['signed_in']))
			{
				echo '<tr><td colspan=2>You must be <a href="signin.php">signed in</a> to upload. You can also <a href="signup.php">sign up</a> for an account.';
}
else {
if(!$result)
{
	echo 'The committee could not be displayed, please try again later.';
}
else
{

	if(mysql_num_rows($result) == 0)
	{
		echo 'This page doesn&prime;t exist.';
	}
	else
	{
			$result2 = $result;
			$row = $result2;
	
			//fetch the posts from the database
			$posts_sql = "SELECT
						posts.post_id,
						posts.post_topic,
						posts.delegate_name,
						posts.country_name,
						posts.upload_url,
						posts.post_date,
						posts.post_by,
						posts.grade1,
						posts.grade2,
						posts.grade3,
						posts.grade4,
						posts.grade5,
						posts.grade6,
						posts.grade7,
						posts.comments,
						posts.total,
						users.user_id,
						users.user_name,
						users.attendees
					FROM
						posts
					LEFT JOIN
						users
					ON
						posts.post_by = users.user_id";
						
			$posts_result = mysql_query($posts_sql);
			
			if(!$posts_result)
			{
				echo 'The posts could not be displayed, please try again later.';
			}
			else
			{
				if($_SESSION['user_level'] == 0 || $_SESSION['user_level'] ==1 )
					{
						//the user is an admin
						echo '<h4>Assignment and Summary Page</h4><script>
						$(function() {
    $(".row").click(function() {
        $(this).find("div").slideToggle();
    });
});
</script>';
						
						echo '
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Add a Delegate
</button>

	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <h2>Upload Form</h2>
							<form enctype="multipart/form-data" method="post" action="committeeupload.php" id="uploadform">
                    <label for="delegate-name" class="test">
                        <input type="text" name="delegate-name" id="uploaderfield" placeholder="Student/Delegate Name"/>
 					</label>
                     <label for="ccmember" class="test">
                        <input type="text" name="country" id="uploaderfield" placeholder="Country/Representative Name"/>
            		 </label>';

            		 echo '<label class="test">
            		 <select name="committee_name" id="uploaderfield" style="width:100%!important">
            		 <option>Select a Committee</option>';
					while($topics_row = mysql_fetch_assoc($result))
					{
						echo '<option value="' . $topics_row['topic_id'] . '">' . $topics_row['topic_subject'] . '</option>';
					}
				echo '</select></label>';	
            		echo'                                      
      <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-primary btn-file test">
                        Upload Paper (.pdf or .docx)<input type="file" name="doc">
                    </span>
                </span>

                <input type="text" class="form-control test" id="uploaderfield" readonly>
            </div></div>
            
           
       <p>Note that paper upload is <b>not necessary</b>. If not uploading, make sure the delegate brings a physical copy of his/her position paper. You do not need to click the "Upload Paper" button.</p>
             <br><br>   
             <label>
            <input type="submit" value="Add Delegate" class="btn btn-default btn-black test"/></label>
        </form>
       </div>
        </div>
  </div>

						
        ';



        	echo '<br><br><h4>List of Your Registered Delegates</h4>';
			$username=$_SESSION['user_id'];
						while($posts_row = mysql_fetch_assoc($posts_result))
							{
								$temporary = $posts_row['post_topic'];
								$delname = mysql_query("SELECT * FROM topics where topic_id='$temporary'");
								$query2=mysql_fetch_array($delname);
								$committeename = $query2['topic_subject'];
								if ($posts_row['post_by'] == $_SESSION['user_id'])
								{
									$counter++;
								echo '<div class="row" style="border:1px solid #000;border-radius:5px;margin:5px;cursor:pointer"><style>.post-content{text-align:left}div.row div{display:none;cursor:text} </style>
								<table style="width:100%;height: 50px">
								<td style="text-align:left;width: 25%;padding-left:15px"><em>Student Name:</em> '.$posts_row['delegate_name'].'</td> 
								<td style="text-align:left;width:20%"><em>Student Score:</em> '.$posts_row['total'].'</td>
								<td style="text-align:left;width: 40%"><em>Committee Name:</em> ' .$committeename .'</td>
								<td style="text-align:left;width:10%" class="opener"><b>Click to Expand</b></td></table>
										<div class="col-md-4">
										<p class="post-content"><b>Committee Name:</b><br>' . $committeename . '</p>
										<p class="post-content"><b>Country/Representative Name:</b><br>' . $posts_row['country_name']. '</p>
										<p class="post-content" style="text-align:left"> 
										<b>Scores</b><br>';
										if($posts_row['post_topic']<=21 && $posts_row['post_topic']>=18)
											{echo 'Crisis Reaction: ' . $posts_row['grade1'] . '<br/>
										Notes: ' . $posts_row['grade2'] . ' <br/>
										Mod/Unmod Caucus: ' . $posts_row['grade3'] . ' <br/>
										Directive Writing: ' . $posts_row['grade4'] . ' <br/>
										Integrity: ' . $posts_row['grade5'] . ' <br/>
										</p>';
										}
										else{
											echo 'Position Paper: ' . $posts_row['grade1'] . '<br/>
										Parliamentary Procedure: ' . $posts_row['grade2'] . ' <br/>
										Speaker List: ' . $posts_row['grade3'] . ' <br/>
										Notes: ' . $posts_row['grade4'] . ' <br/>
										Mod/Unmod Caucus: ' . $posts_row['grade5'] . ' <br/>
										Resolution Draft: ' . $posts_row['grade6'] . ' <br/>
										Integrity: ' . $posts_row['grade7'] . ' <br/>
										</p>';
										}
										echo '</div>
										<div class="col-md-4">
										<p class="post-content">
										<b>Comments:</b><br>' . $posts_row['comments'] . ' <br/>
										</p>
										</div>
										<div class="col-md-4">										
										<p class="post-content"><b>Delegate Total Score:</b> <br>' . $posts_row['total'] . '</p>
										<p class="post-content">Other Options:</p>'; 
										$grand_total +=$posts_row['total'];
										if($posts_row["upload_url"]!=null) 
										{
											echo '<p class="post-content"><a href="uploads/' . $posts_row["upload_url"] . '"><b>Download Paper</b></a></p>';
										}
										else {
											echo '<p class="post-content">Did not upload</p>';
										}
										echo '<p class="post-content"><a href="edit.php?id='.$posts_row['post_id'].'"><b>Add/Replace Paper</b></a></p>
										<p class="post-content"><a href="delete2.php?id='.$posts_row['post_id'].'"><b>Delete Entry</b></a></p></div></div>';
									  	}
							}
				
					}
					//finish the table
			echo '</table>';
			}
		
									/*fix this*/echo '<h4>grand total = ' . $grand_total . '</h4>';
									$querytotal=mysql_query("update users set user_total='$grand_total' where user_id='$username'");
									$querycounter = mysql_query("update users set act_users='$counter' where user_id='$username'");



			
			
			
		}
	}

}
include 'footer.php';
?>