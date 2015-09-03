<?php
//create_cat.php
include 'connect.php';
include 'header.php';

$sql = "SELECT
			categories.cat_id,
			categories.cat_name,
			categories.cat_description,
			COUNT(topics.topic_id) AS topics
		FROM
			categories
		LEFT JOIN
			topics
		ON
			topics.topic_id = categories.cat_id
		GROUP BY
			categories.cat_name, categories.cat_description, categories.cat_id";

$result = mysql_query($sql);

if(!isset($_SESSION['signed_in']))
{
	echo '<br> <h4>Thank you for visiting. Click one of the links below to proceed. <br><br>
	<a href="signin.php" class="btn btn-default btn-black">Sign in</a>
	<a href="signup.php" class="btn btn-default btn-black">Sign Up</a>  ';;
}
else {
	if(!$result)
{
	echo 'Error Connecting to Database, try later';
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'No categories defined yet.';
	}
	else
	{
		//prepare the table

			
		while($row = mysql_fetch_assoc($result))
		{		
			echo '<tr>';
				echo '<form action="" method="post">';
				if($_SESSION['user_level']==1) {
					$username=$_SESSION['user_name'];
					$committeerestrict=mysql_query("SELECT * FROM users WHERE user_name='$username'");
					while($query1=mysql_fetch_array($committeerestrict)) 
					echo '<h3><a class="btn btn-default btn-black" href="committee.php?id=' . $query1['restricted'] . '">' . 'Go to your committee' . '</a></h3>' . $row['cat_description'];
				}	
				else {
				echo '<td class="leftpart">';
					echo '<h3><a class="btn btn-default btn-black" href="list.php?id=' . $row['cat_id'] . '">' . 'Select a committee' . '</a></h3>' . $row['cat_description'];
				echo '</td>';}
				// if($_SESSION['user_level']==2)
				// echo '<td><a href="delete.php?id='.$row['cat_id'].'">Delete</a></td>';
				
				
			echo '</tr>';

			
		}
		if($_SESSION['user_level']==2) {
			$attendee_actual = mysql_query("SELECT * FROM users");
			while($queryx = mysql_fetch_array($attendee_actual)) {
				$counter= 0;
				$newvar = $queryx['user_id'];
				$postquery = mysql_query("SELECT * FROM posts WHERE post_by='$newvar'");
				while($querynew = mysql_fetch_array($postquery)) {
					$counter++;
				}
				mysql_query("UPDATE users set act_users = '$counter' where user_id = '$newvar' ");
			}
			$score_actual = mysql_query("SELECT * FROM users");
			while($querya = mysql_fetch_array($score_actual)) {
				$grand_total= 0;
				$newervar = $querya['user_id'];
				$postaquery = mysql_query("SELECT * FROM posts WHERE post_by='$newervar'");
				while($queryanew = mysql_fetch_array($postaquery)) {
					$grand_total+=$queryanew['total'];
				}
				mysql_query("UPDATE users set user_total = '$grand_total' where user_id = '$newervar' ");
			}
				echo '<h2>School Totals</h2>';
				$schoolname = mysql_query("SELECT * FROM users WHERE act_users BETWEEN 4 and 7 ORDER BY (user_total/act_users) DESC");
				echo '
				<h4>Division 1 (4-7 delegates)</h4>
				<table border="1" width="100%">
			  <tr>
				<th>Username</th>
				<th>Total Score</th>
				<th>Attendees</th>
				<th>School Name</th>
				<th>Average</th>

			  </tr>';
				while ($query2=mysql_fetch_array($schoolname)) {
					echo '<tr>';
					if($query2['user_level'] == 0) {
						$average = ($query2['user_total'])/($query2['act_users']);

						echo '<td>' . $query2['user_name'] . '</td>';
						echo '<td>' . $query2['user_total'] . '</td>';
						echo '<td>' . $query2['act_users'] . '</td>';
						echo '<td>' . $query2['school_name'] . '</td>';
						echo '<td>' . round($average,4) . '</td>';
					}
					echo '</tr>';
			}

			$schoolname = mysql_query("SELECT * FROM users WHERE act_users BETWEEN 8 and 11 ORDER BY (user_total/act_users) DESC");
				echo '
				</table><h4>Division 2 (8-11 delegates)</h4>
				<table border="1" width="100%">
			  <tr>
				<th>Username</th>
				<th>Total Score</th>
				<th>Attendees</th>
				<th>School Name</th>
				<th>Average</th>

			  </tr>';
				while ($query2=mysql_fetch_array($schoolname)) {
					echo '<tr>';
					if($query2['user_level'] == 0) {
						$average = ($query2['user_total'])/($query2['act_users']);

						echo '<td>' . $query2['user_name'] . '</td>';
						echo '<td>' . $query2['user_total'] . '</td>';
						echo '<td>' . $query2['act_users'] . '</td>';
						echo '<td>' . $query2['school_name'] . '</td>';
						echo '<td>' . round($average,4) . '</td>';
					}
					echo '</tr>';
			}

			$schoolname = mysql_query("SELECT * FROM users WHERE act_users BETWEEN 12 and 26 ORDER BY (user_total/act_users) DESC");
				echo '
				</table><h4>Division 3 (12-26 delegates)</h4>
				<table border="1" width="100%">
			  <tr>
				<th>Username</th>
				<th>Total Score</th>
				<th>Attendees</th>
				<th>School Name</th>
				<th>Average</th>

			  </tr>';
				while ($query2=mysql_fetch_array($schoolname)) {
					echo '<tr>';
					if($query2['user_level'] == 0) {
						$average = ($query2['user_total'])/($query2['act_users']);

						echo '<td>' . $query2['user_name'] . '</td>';
						echo '<td>' . $query2['user_total'] . '</td>';
						echo '<td>' . $query2['act_users'] . '</td>';
						echo '<td>' . $query2['school_name'] . '</td>';
						echo '<td>' . round($average,4) . '</td>';
					}
					echo '</tr>';
			}
			echo '</table><h2>Top members by committee</h2>
				
			';
			$committee = mysql_query("SELECT DISTINCT post_topic FROM posts");

						while($query3 = mysql_fetch_array($committee)) {
							$x = $query3['post_topic'];
							
							$committeename = mysql_query("SELECT * FROM topics WHERE topic_id = '$x'");
							while($query5=mysql_fetch_array($committeename)) {
								$y = $query5['topic_subject'];
								if($query5['finalized']==1) {
								$newer = "<span style='color: #F79E21'>(finalized!)</span>";}
								else {$newer="";}
								echo '<h4>' . $y . $newer .'</h4>';
								echo '<table border="1" width="100%">
									  <tr>
										<th>Student Name</th>
										<th>Country/Representative Name</th>
									
										<th>Score</th>
										<th>School</th>
									</tr>';

							$test1 = mysql_query("SELECT * FROM posts WHERE post_topic='$x' ORDER BY total DESC");
							while($query4 = mysql_fetch_array($test1)) {
								if($query4['country_name'] != null) {
								echo '<td>' . $query4['delegate_name'] . '</td>';
								$school = $query4['post_by'];
								echo '<td>' . $query4['country_name'] . '</td>';
								echo '<td>' . $query4['total'] . '</td>';
								$test2 = mysql_query("SELECT * FROM users WHERE user_id='$school'");
								while($query8=mysql_fetch_assoc($test2)) {
										echo '<td>' . $query8['school_name'] . '</td>';

								}
								echo '<tr>';
							}
							}
							echo '</table><br><br>';
						}
					
				}
				
			
		}
		
	}
}
}

include 'footer.php';
?>
