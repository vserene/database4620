<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_save_path(getcwd() . '/');
	session_start();
	include_once "function.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media</title>
<script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
body{
	background-color: #D0D0D0;
}
.logo{
		height: 40px;
		padding-top: 2px;
		padding-right: 2px;
}
/* Remove the navbar's default margin-bottom and rounded borders */
.navbar {
	margin-bottom: 0;
	border-radius: 0;
	/*background-color: #1C5D99;*/
	background-color: #982649;
	color:white;
}

/* Set height of the grid so .sidenav can be 100% (adjust as needed) */
.row.content {height: 1000px}
/* Set gray background color and 100% height */
.sidenav {
	padding-top: 20px;
	background-color: #454955;
	height: 100%;
}

#form1{
		height:45px;
		width:55%;
		top:70px;
		font-family:verdana;
		font-size:16px;
		margin-top: 30px;
		margin-left: 3%;
}
</style>
</head>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="logo">
        <!--  <a id="img1" class="logo" href="sponsor_main.php"><img src="TRUCK1.png" class="logo"/>-->
          </a>
        </div>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="browse.php">Home</a></li>
        <li><a href="media_upload.php">Upload</a></li>
        <li><a href="user_channel.php">My Channel</a></li>
        <!--<li><a href="#">Help</a></li>-->
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="contact_list.php">Contact List</a></li>
        <li><a href="message.php">Messaging</a><li>
        <li><a href="update_user.php">My Account</a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<body>
<?php
if(isset($_GET['id'])) {
	$query = "SELECT * FROM media WHERE mediaid='".$_GET['id']."'";
	$result = mysql_query( $query );
	$result_row = mysql_fetch_row($result);

	updateMediaTime($_GET['id']);

	$filename=$result_row[1];
	$filepath=$result_row[2];
	$type=$result_row[3];
	if(substr($type,0,5)=="image") //view image
	{
		echo "Viewing Picture:";
		echo $result_row[2].$result_row[1];
		echo "<img src='".$filepath.$filename."'/>";
	}
	else //view movie
	{
?>
	<p>Viewing Video:<?php echo $result_row[2].$result_row[1];?></p>

    <!-- <object id="MediaPlayer" width=320 height=286 classid="CLSID:22D6f312-B0F6-11D0-94AB-0080C74C7E95" standby="Loading Windows Media Player components…" type="application/x-oleobject" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112">

<param name="filename" value="<?php echo $result_row[2].$result_row[1];  ?>">
<param name="Showcontrols" value="True">
<param name="autoStart" value="True">

<embed type="application/x-mplayer2" src="<?php echo $result_row[2].$result_row[1];  ?>" name="MediaPlayer" width=320 height=240></embed>

</object> -->

	<video controls width="250">
		<source src="<?php echo $result_row[2].$result_row[1];  ?>"
			type="video/wmv">

<?php
	}
}
else
{
?>
<meta http-equiv="refresh" content="0;url=browse.php">
<?php
}
?>

<br><br><div>Comments:</div>
<table cellpadding="0" cellspacing="0">
<?php
	$media = $_GET['id'];
	//echo $media;
	$query = "select * from Comments where mediaid = '$media'";
	$result = mysql_query($query);
	if($result == FALSE){
		echo "error";
	}
	while ($result_row = mysql_fetch_row($result))
	{
?>
		<tr valign="top">
		<td>

		</td>
				<td width="280">
					<div>
						<?php echo $result_row[2];
						echo ":";?>
					</div>
				</td>
				<td width="500">
					<div>
						<?php echo $result_row[1];?>
					</div>
				</td>
			</tr>
	<?php
			}
 ?>
</table>
<div>
	<div id="form1" class="login">
		<form action="" method="post">
	<textarea name="message" cols="50" rows="1"></textarea>
	<input type="submit" name="send" value="Post Comment"><br>
<?php
	if(isset($_POST['send'])){
		$message = $_POST['message'];
		$username = $_SESSION['username'];
		$mediaid = $_GET['id'];
		$query = "insert into Comments(mediaid, comment, username) values('$mediaid', '$message', '$username')";
		if(!($result = mysql_query($query))){
			echo "Could not post comment";
		}else{
			header("Refresh:0");
		}
	}
 ?>
</form>
</div>
</div>
</body>
</html>
