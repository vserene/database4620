<?php
session_start();
include_once "function.php";

/******************************************************
*
* download by username
*
*******************************************************/

$username=$_SESSION['username'];
$mediaid=$_REQUEST['id'];

//insert into upload table
$insertDownload="insert into download(downloadid,username,mediaid) values(NULL,'$username','$mediaid')";
$queryresult = mysql_query($insertDownload)

?>

<?php
$query = "SELECT * FROM media WHERE mediaid='".$_GET['id']."'";
$result = mysql_query( $query );
$result_row = mysql_fetch_row($result);
$filepath=$result_row[2];
$filename=$result_row[1];
?>

<a href='<?php echo $filepath.$filename; ?>' download='$filename'></a>