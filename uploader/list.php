<?php
//category.php
include 'connect.php';
include 'header.php';

//first select the category based on $_GET['cat_id']
$sql = "SELECT
			cat_id,
			cat_name,
			cat_description
		FROM
			categories
		WHERE
			cat_id = " . mysql_real_escape_string($_GET['id']);

$result = mysql_query($sql);

if(!$result)
{
	echo 'The committees could not be displayed, please try again later.' . mysql_error();
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'This page does not exist.';
	}
	else
	{
		//display category data
		while($row = mysql_fetch_assoc($result))
		{
			echo '<h2>Committees List</h2><br />';
		}
	
		//do a query for the topics
		$sql = "SELECT	
					topic_id,
					topic_subject,
					topic_date,
					topic_cat,
					description
				FROM
					topics
				WHERE
					topic_cat = " . mysql_real_escape_string($_GET['id']);
		
		$result = mysql_query($sql);
		
		if(!$result)
		{
			echo 'The committees could not be displayed, please try again later.';
		}
		else
		{
			if(mysql_num_rows($result) == 0)
			{
				echo 'There are no committees in this category yet.';
			}
			else
			{
				//prepare the table	
					echo '<style>
						h4{letter-spacing: 0px;}
					</style>';
				while($row = mysql_fetch_assoc($result))
				{				
							echo '<h4><a href="committee.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a></h4>';
							echo '<p>' . $row['description'] . '</p><br>';
						echo '</td>';
					echo '</tr>';
				}
			}
		}
	}
}

include 'footer.php';
?>
