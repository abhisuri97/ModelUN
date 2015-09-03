<?php
//create_cat.php
include 'connect.php';
include 'header.php';

$sql = "SELECT
			topic_id,
			topic_subject
		FROM
			topics
		WHERE
			topics.topic_id = " . mysql_real_escape_string($_GET['id']);
			
$result = mysql_query($sql);

if(!$result)
{
	echo 'The committee could not be displayed, please try again later.';
}
			if(!isset($_SESSION['signed_in']))
			{
				echo 'You must be <a href="signin.php">signed in</a> to upload. You can also <a href="signup.php">sign up</a> for an account.';
			}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'This committe doesn&prime;t exist.';
	}
	else
	{
		while($row = mysql_fetch_assoc($result))
		{
			//display post data
			echo '
					
						<h2>' . $row['topic_subject'] . ' upload</h2>
					';
		
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
						users.user_level,
						users.school_name
					FROM
						posts
					LEFT JOIN
						users
					ON
						posts.post_by = users.user_id
					WHERE
						posts.post_topic = " . mysql_real_escape_string($_GET['id']);
						
			$posts_result = mysql_query($posts_sql);

			if(!$posts_result)
			{
				echo '<tr><td>The uploads could not be displayed, please try again later.</tr></td></table>';
			}
			else
			{
				if($_SESSION['user_level'] == 1 || $_SESSION['user_level']==2)
					{
						//the user is an admin
						echo 'Welcome to the admin side <br>
						<div class="alert alert-danger"><b>In other news there might be a missing iPad...report to the nearest secretariat member or go to Mr.Mendozas room</b></div>
						<div class="alert alert-warning"><b>Denton HS deleted their account accidentally (yeah...idk how...and pretty much deleted all their students off the system). Please ask Denton kids in your committee for their names and re-add them to the roster (if they are in your committee). Contact 2108619271 or suriabhinav1997@gmail.com for more info.</b></div>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">

  Add a Delegate</button>';
  $topicsider = $_GET['id'];
  $topics = mysql_query("SELECT * FROM topics where topic_id='$topicsider'");
  while($finalizedselect = mysql_fetch_assoc($topics)) {
  if($finalizedselect['finalized']==0) {
  	echo '</button>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2"> Finalize your score</button>';
  }
  else {
  	echo '<br><h4><div class="alert alert-success">Your Scores have been finalized</div></h4>';
  }}
echo '
<script>
						$(function() {
    $(".row").click(function() {
        $(this).find("div").slideToggle();
    });
});
</script>
<style>
.btn-primary2 {
  color: #FFF;
  background-color: #5bb75b;
  border: 3px #5bb75b solid;
  border-radius: 3px;
  margin-right: 5px !important;
  height: 30px;
  line-height: 12px;
}
.btn-primary3 {
  color: #FFF;
  background-color: #5bb75b;
  opacity:.5;
  border: 3px #5bb75b solid;
  border-radius: 3px;
  margin-right: 5px !important;
  height: 30px;
  line-height: 12px;
}
.btn-primary2:hover {
	background-color:#FFF;
	color: #5bb75b;
}
</style>
';
				
						while($posts_row = mysql_fetch_assoc($posts_result))
							{
								echo '<div class="row" style="border:1px solid #000;border-radius:5px;margin:5px;cursor:pointer"><style>.post-content{text-align:left}div.row div{display:none;cursor:text}</style>
								<table style="width:100%;height: 50px">';
								if($posts_row['total']==0) {
									echo '
								<td style="text-align:left;max-width:10%;padding-left: 15px"><a class="btn btn-primary2" href="grade.php?id='.$posts_row['post_id'].'">Grade</a></td>';}
								else {echo '
								<td style="text-align:left;max-width:10%; padding-left: 15px"><a class="btn btn-primary3" href="grade.php?id='.$posts_row['post_id'].'">Edit Grade</a></td>';}

								echo '
								<td style="text-align:left;width: 15%"><em>Student Name:</em><br> ' .$posts_row['delegate_name'] .'</td>
								<td style="text-align:left;width: 15%"><em>School Name:</em><br> ' .$posts_row['school_name'] .'</td>

								<td style="text-align:left;width:15%"><em>Delegate Score:</em> '.$posts_row['total'].'</td>
								<td style="text-align:left;width: 30%"><em>Country/Representative Name:</em><br> ' .$posts_row['country_name'] .'</td>


								<td style="text-align:left;width:10%; padding-right: 15px" class="opener"><b>Click to Expand</b></td></table>
										<div class="col-md-4">
										<p class="post-content"><b>Country/Representative Name:</b><br>' . $posts_row['country_name']. '</p>
										<p class="post-content" style="text-align:left"> 
										<b>Scores</b><br>';
										if($posts_row['post_topic']<=21 && $posts_row['post_topic']>=18)
											{echo 'Crisis Reaction: ' . $posts_row['grade1'] . '<br/>
										Notes: ' . $posts_row['grade2'] . ' <br/>
										Mod/Unmod Caucus: ' . $posts_row['grade3'] . ' <br/>
										Directive Writing: ' . $posts_row['grade4'] . ' <br/>
										Integrity Caucus: ' . $posts_row['grade5'] . ' <br/>
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
										if($posts_row["upload_url"]!=null) 
										{
											echo '<p class="post-content"><a href="uploads/' . $posts_row["upload_url"] . '"><b>Download Paper</b></a></p>';
										}
										else {
											echo '<p class="post-content">Did not upload paper</p>';
										}
										echo '<p class="post-content"><a href="edit.php?id='.$posts_row['post_id'].'"><b>Add/Replace Paper</b></a></p>
										<p class="post-content"><a href="delete2.php?id='.$posts_row['post_id'].'"><b>Delete Entry (no show)</b></a></p></div></div>';
									  	}
							echo '
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<form enctype="multipart/form-data" method="post" action="upload.php?id='.$row['topic_id'].'" id="uploadform">
                    <h2>Add a Delegate</h2>
                    <p>If the delegates are in a pair, put both their names here. <br>If you do not know the student/delegate name, ask them or put in "unknown" or their country name again.</p>
                    <label for="delegate-name">
                        <input type="text" name="delegate-name" id="uploaderfield" placeholder="Student/Delegate Name"/>
 					</label>
                     <label for="ccmember">
                        <input type="text" name="country" id="uploaderfield" placeholder="Country/Representative Name"/>
            		 </label>';
            		                                    
            		 echo '<select name="school_name" id="uploaderfield" style="width:100%">';
					 $userlist = mysql_query("SELECT * FROM users WHERE user_level='0'");
					 	echo '<option value="0">Select a School</option>';
            		 while($posts_row2 = mysql_fetch_assoc($userlist))
					{
						echo '<option value="' . $posts_row2['user_id'] . '">' . $posts_row2['school_name'] .'</option>';
					}  
				echo '</select>
       
             <br><br>   
            <input type="submit" value="Add Delegate" class="btn btn-default btn-black"/>
        </form></div></div></div></div>

	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<form enctype="multipart/form-data" method="post" action="finalize.php?id='.$row['topic_id'].'" id="uploadform">
                    <h2>Finalize your Scores</h2>
                    <p>Click to notify us that you have finalized your scores. Please do not edit grades after doing so.</p>
                
       
             <br><br>   
            <input type="submit" value="Finalize Scores" class="btn btn-default btn-black"/>
        </form></div></div></div></div></div>
        ';
					}
					
			}
			
			

			
			//finish the table
			echo '</table>';
		}
	}
}

include 'footer.php';
?>