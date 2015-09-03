<?php
include 'connect.php';
include 'header.php';
if(isset($_GET['id']))
{
$id=$_GET['id'];
$query1=mysql_query("delete from posts where post_id='$id'");
if($query1)
{
	if($_SESSION['user_level']==0) 
echo 'Success. Go back to the <a href="summary.php"> summary </a> page.';

else 
echo 'Success. Go back to the <a href="committee.php?id='.$_SESSION['user_restrict'] .'"> home </a> page.';

}
else 
{
	echo "This operation failed. Try again later";
}
}


include 'footer.php';
?>
