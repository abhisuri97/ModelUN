<?php
include 'connect.php';
include 'header.php';
$committeename = 0;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	if(isset($_POST['submit']))
	{
		$grade1=$_POST['grade1'];
		$grade2=$_POST['grade2'];
		$grade3=$_POST['grade3'];
		$grade4=$_POST['grade4'];
		$grade5=$_POST['grade5'];
		if(!isset($_POST['grade6']))
			$grade6=0;
		else {
		$grade6=$_POST['grade6'];
	}
	if(!isset($_POST['grade7']))
			$grade7=0;
		else {
		$grade7=$_POST['grade7'];
	}
		$comments=$_POST['comments'];
	
	if(isset($grade1) && isset($grade2) && isset($grade3) && isset($grade4) && isset($grade5) && isset($comments)) {
		$query3=mysql_query("update posts set grade1='$grade1', grade2='$grade2', grade3='$grade3', grade4='$grade4', grade5='$grade5', grade6='$grade6', grade7='$grade7', comments='$comments', total=($grade1+$grade2+$grade3+$grade4+$grade5+$grade6+$grade7) where post_id='$id'");
		if($query3)
		{
			$query4=mysql_query("SELECT * FROM posts WHERE post_id='$id'");
			while($query5 = mysql_fetch_assoc($query4)) {
				echo 'Success. Return to the <a href="committee.php?id='. $query5['post_topic']. '">Committee Page</a>.';
			}
		}
		else
			echo 'Something went wrong';
	}
else
			echo 'Make sure all fields are filled out please!';
}
}
$query6=mysql_query("SELECT * FROM posts WHERE post_id='$id'");
while($query7=mysql_fetch_assoc($query6)) {
	 $committeename=$query7['post_topic'];
}
echo '<h2>The grader</h2><p>These point ranges are the most updated (ignore anything else). So use these :)</p><form method="post" action="">
<style>
td {text-align: left; padding: 10px}
td.one {text-align:right; width: 50%}
</style>';
$query8=mysql_query("SELECT * FROM posts WHERE post_id='$id'");
while ($query9=mysql_fetch_assoc($query8)) {
if($committeename<=21 && $committeename>=18) {
echo '
<table width="100%">
<tr>
	<td class="one">Crisis Reaction (3-15):</td><td><input type="text" name="grade1" value="'.$query9['grade1'].'"/></input></td>
</tr>
<tr>
	<td class="one">Notes(2-10):</td><td><input type="text" name="grade2" value="'.$query9['grade2'].'"/></td>
	</tr>
<tr>
	<td class="one">Moderated/Unmoderated Caucus (5-25):</td><td><input type="text" name="grade3" value="'.$query9['grade3'].'"/></td>
	</tr>
<tr>
	<td class="one">Directive Writing (6-30):</td><td><input type="text" name="grade4" value="'.$query9['grade4'].'"/></td>
	</tr>
<tr>
	<td class="one">Integrity (4-20):</td><td><input type="text" name="grade5" value="'.$query9['grade5'].'"/></td>
	</tr>
	<tr>
	<td class="one">General Comments</td><td><textarea name="comments" />'.$query9['comments'].'</textarea></td>
	</tr>
	<br>
	</table>
		<input type="submit" name="submit" value="update" />
</form>';
}
else {
	echo'
<table width="100%">
<tr>
	<td class="one">Position Paper (0-10):</td><td><input type="text" name="grade1" value="'.$query9['grade1'].'"/></td>
</tr>
<tr>
	<td class="one">Parliamentary Procedure (3-15):</td><td><input type="text" name="grade2" value="'.$query9['grade2'].'"/></td>
	</tr>
<tr>
	<td class="one">Speaker List (2-10):</td><td><input type="text" name="grade3" value="'.$query9['grade3'].'"/></td>
	</tr>
<tr>
	<td class="one">Notes (1-5):</td><td><input type="text" name="grade4" value="'.$query9['grade4'].'" /></td>
	</tr>
<tr>
	<td class="one">Moderated/Unmoderated Caucus (4-20):</td><td><input type="text" name="grade5" value="'.$query9['grade5'].'"/></td>
	</tr>
<tr>
	<td class="one">Resolution Drafting (3-15):</td><td><input type="text" name="grade6" value="'.$query9['grade6'].'"/></td>
	</tr>
<tr>
	<td class="one">Integrity(5-25):</td><td><input type="text" name="grade7" value="'.$query9['grade7'].'"/></td>
	</tr>
	<tr>
	<td class="one">General Comments</td><td><textarea name="comments"/>'.$query9['comments'].'</textarea></td>
	</tr>
	<br />
	</table>
	<input type="submit" name="submit" value="update" />
</form>';
}
}
include 'footer.php';
?>
