<link rel="stylesheet" type="text/css" href="css/default.css" />
<html lang="en">
<head>
	<title>My Channel</title>
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
<?php
	session_save_path(getcwd() . '/');
	session_start();

	include_once "function.php";


	$username = $_SESSION['username'];

	$result = mysql_query("SELECT * FROM account WHERE username = '$username'");
	$user = mysql_fetch_assoc($result);

	if(isset($_POST['add-playlist']))
	{
		$pname = $_POST['add-playlist'];


		if (str_replace(' ', '', $pname) != "")
		{
			$pname = $_POST['add-playlist'];
			$userid = $user['id'];
			$addresult = mysql_query("INSERT INTO playlists (user_id, name) VALUES ('$userid', '$pname')");
		}

		header("Location: user_channel.php");
	}

	if (isset($_GET['del']))
	{
		$pid = $_GET['del'];
		$query = "DELETE FROM playlists WHERE id = '$pid'";
		$result = mysql_query($query);
		if ($result)
		{
			header("Location: user_channel.php");
		}
		else
		{
			die();
		}
	}

	$media_output = "";

	if (isset($_GET['show']))
	{
		$pid = $_GET['show'];

		$pquery = "SELECT * FROM playlists WHERE id = '$pid'";
		$presult = mysql_query($pquery);
		$playlist = mysql_fetch_assoc($presult);

		if ($playlist['name'] == 'My Uploads')
		{
			$media_query = "SELECT * FROM upload WHERE username = '$username'";
			$media_result = mysql_query($media_query);

			$media_output = "<p>" . $playlist['name'] . "</p>";

			if ($media_result)
			{
				$media_output .= "<table style='width:75%'>";

				while($upload = mysql_fetch_assoc($media_result))
				{
					$media_query = mysql_query("SELECT * FROM media WHERE mediaid = '" . $upload['mediaid'] . "'");
					$media = mysql_fetch_assoc($media_query);
					$media_output .= "<tr>"
					. "<td><a href='user_channel.php?show=$pid'>" . $media['filename'] . "</a></td>"
					. "</tr>";
				}

				$media_output .= "</table>";
			}
		}
	}

?>
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
	<div id="form">
		<div style="background:#339900;color:#FFFFFF; width:150px;">My Lists:</div><br>
		<form action="user_channel.php" method="post">
			<input type="text" placeholder="Playlist Name" name="add-playlist">
			<input type="submit" value="Add">
		</form>
		<table style='width:75%'>
		<?php
			$userid = $user['id'];
			$list_result = mysql_query("SELECT * FROM playlists WHERE user_id = '$userid'");
			while ($row = mysql_fetch_assoc($list_result))
			{
				echo "<tr>";
				$list_name = $row['name'];
				$list_id = $row['id'];
				echo "<td><a href='user_channel.php?show=$list_id'>$list_name</a></td>";
				if (!($list_name == 'My Uploads' || $list_name == 'Favorites'))
				{
					echo "<td><a href='user_channel.php?del=$list_id'>Delete</a></td>";
				}
				echo "</tr>";
			}
		?>
		</table>
	</div>
	<div id="form">
		<div style="background:#339900;color:#FFFFFF; width:150px;">Selected Media:</div><br>
		<?php
			echo $media_output;
		?>
	</div>
</body>