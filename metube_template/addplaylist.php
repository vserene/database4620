<link rel="stylesheet" type="text/css" href="css/default.css" />
<html lang="en">
<head>
	<title>Add to Playlist</title>
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

	#form{
		width:50%;
		top:70px;
		font-family:verdana;
		font-size:16px;
		padding-top: 30px;
		padding-left: 3%;
		padding-right: 1%;
		float:left;
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
<?php
	session_save_path(getcwd() . '/');
	session_start();

	include_once "function.php";

	$user_query = mysql_query("SELECT * FROM account WHERE username = '" . $_SESSION['username'] . "'");
	$user = mysql_fetch_assoc($user_query);

	$media_query = mysql_query("SELECT * FROM media WHERE mediaid = '" . $_GET['id'] . "'");
	$media = mysql_fetch_assoc($media_query);

	$mediaid = $_GET['id'];

	if (isset($_GET['pid']))
	{
		$pid = $_GET['pid'];

		$pquery = mysql_query("SELECT * FROM playlists WHERE id = '$pid'");
		$plist = mysql_fetch_assoc($pquery);

		$result = mysql_query("SELECT * FROM playlist_media WHERE playlist_id = '$pid' AND media_id = '$mediaid'");
		if (mysql_num_rows($result)==0)
		{
			$addquery = mysql_query("INSERT INTO playlist_media (playlist_id, media_id) VALUES ('$pid', '$mediaid')");

			if ($addquery)
			{
				echo "<script>alert('Successfully added " . $media['filename'] . " to " . $plist['name'] . "!');"
				. "window.location.href='addplaylist.php?id=$mediaid';"
				. "</script>";
			}
			else
			{
				echo "<script>alert('Unable to add " . $media['filename'] . " to " . $plist['name'] . "!');"
				. "window.location.href='addplaylist.php?id=$mediaid';"
				. "</script>";
			}
		}
		else
		{
			echo "<script>alert('You have already added " . $media['filename'] . " to " . $plist['name'] . "!');"
			. "window.location.href='addplaylist.php?id=$mediaid';"
			. "</script>";
		}
	}

	$playlist_query = mysql_query("SELECT * FROM playlists WHERE user_id = '" . $user['id'] . "'");
	$playlist_output = "";
	while ($playlist = mysql_fetch_assoc($playlist_query))
	{
		if ($playlist['name'] != 'My Uploads')
		{
			$playlist_output .= "<tr>"
			. "<td><a href=addplaylist.php?id=$mediaid&pid=" . $playlist['id'] . ">" . $playlist['name'] . "</a></td>"
			. "</tr>";
		}
	}
?>
<body>
	<div id="form">
		<div><span style="background:#339900;color:#FFFFFF;">Choose Playlists for <?php echo $media['filename'] ?>:</span></div><br>

		<table style="width:75%">
			<?php echo $playlist_output; ?>
		</table>

		<br><a href='browse.php'>Back to Home</a>
	</div>
</body>