<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_save_path('/home/mfetch/public_html/metube/');
	session_start();
	include_once "function.php";
	include_once 'mysqlClass.inc.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media browse</title>
<link rel="stylesheet" type="text/css" href="css/default.css" />
<script type="text/javascript" src="js/jquery-latest.pack.js"></script>
<script type="text/javascript">
function saveDownload(id)
{
	$.post("media_download_process.php",
	{
       id: id,
	},
	function(message)
    { }
 	);
}
</script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<!--  <link rel='stylesheet' href="index.css"/>
<script src="index.css"></script>-->
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
		margin-left: 55%;
}
#form2{
		height:45px;
		width:55%;
		top:70px;
		font-family:verdana;
		font-size:16px;
		margin-top: -50px;
		margin-left: 5%;
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
        <!--<li><a href="#">Help</a></li>-->
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="update_user.php">My Account</a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<body>
<?php $username = $_SESSION['username'] ?>
<p>Welcome <?php echo $username ?></p>
<a href='update_user.php'>Update Account</a>
<a href='media_upload.php'  style="color:#FF9900;">Upload File</a>
<div id='upload_result'>
<?php
	if(isset($_REQUEST['result']) && $_REQUEST['result']!=0)
	{

		echo upload_error($_REQUEST['result']);

	}
?>
</div>
<br/><br/>

<?php


	$query = "SELECT * from media";
	$result = mysql_query( $query );
	if (!$result)
	{
	   die ("Could not query the media table in the database: <br />". mysql_error());
	}
?>
<div id="form1" class="login">
	<form action="" method="post">
    <div style="background:#339900;color:#FFFFFF; width:150px;">Uploaded Media</div>
	<table width="50%" cellpadding="0" cellspacing="0">
		<?php
			while ($result_row = mysql_fetch_row($result))
			{
		?>
        <tr valign="top">
			<td>
					<?php
						echo $result_row[0];
					?>
			</td>
            <td>
            	<a href="media.php?id=<?php echo $result_row[0];?>" target="_blank"><?php echo $result_row[1];?></a>
            </td>
            <td>
            	<a href="<?php echo $result_row[2].$result_row[1];?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row[0];?>);">Download</a>
            </td>
		</tr>
        <?php
			}
		?>
	</table>
</form>
</div>
<div id="form2" class="login">
	<form action="" method="post">
    <div style="background:#339900;color:#FFFFFF; width:150px;">Search for Media</div><br>
	<table width="50%" cellpadding="0" cellspacing="0">
		<form class="search">
		  <input class="search" type="text" placeholder="Search"
		    aria-label="Search" name="search">
			<input type="submit" name="submit" value="Search">
			<?php
				if(isset($_POST['submit'])){
					$search_word = $_POST['search'];
					$query = "select mediaid from media_tags where tag = '$search_word'";
					$mediaid_list = mysql_query($query);
					while ($mediaid_row = mysql_fetch_row($mediaid_list)){
						?>
						<tr valign="top">
					<td>
						<?php
						//	echo $mediaid_row[0];
							$test = $mediaid_row[0];
							$query2 = "select * from media where mediaid = '$test'";
							$result = mysql_query($query2);
							$result_row = mysql_fetch_array($result);
							//if(!($result_row = mysql_query($query2))){
								//echo "query fucked";
							//}else{
								//echo "shit wasn't query";
							//}
							echo $result_row[0];
							//echo $resultrow;
							?>
					</td>
		            <td>
		            	<a href="media.php?id=<?php echo $result_row[0];?>" target="_blank"><?php echo $result_row[1];?></a>
		            </td>
		            <td>
		            	<a href="<?php echo $result_row[2].$result_row[1];?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row[0];?>);">Download</a>
		            </td>
				</tr>
		        <?php
					}
				}
					?>
		</form>

	</table>
</form>
</div>
</body>
</html>
