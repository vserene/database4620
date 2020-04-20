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

$query="SELECT * FROM media WHERE mediaid=$ID";
$result=mysql_query($query);
$filepath = $result->filepath; 
$filetype = $result->type;
$filename = $result->filename;

if(file_exists)){
    header("Pragma: public");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: ".$filetype);
    header("Content-Length: ".filesize($filepath));
    readfile($filepath);
}

?>



