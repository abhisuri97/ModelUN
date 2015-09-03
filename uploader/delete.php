<?php
include 'connect.php';
include 'header.php';
if(isset($_GET['id']))
{
$id=$_GET['id'];
$query1=mysql_query("delete from categories where cat_id='$id'");
if($query1)
{
echo "The operation was successful";
}
else 
{
	echo "The operation failed. Try again later";
}
}


include 'footer.php';
?>
