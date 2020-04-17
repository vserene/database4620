<link rel="stylesheet" type="text/css" href="css/default.css" />
<html lang="en">
<head>
  <title>Contact List</title>
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
	    margin-left: 65%;
	}
  #form2{
      height:45px;
      width:55%;
      top:70px;
      font-family:verdana;
      font-size:16px;
      margin-top: -45px;
      margin-left: 35%;
  }
  #form3{
      height:45px;
      width:55%;
      top:70px;
      font-family:verdana;
      font-size:16px;
      margin-top: -45px;
      margin-left: 3%;
  }
	</style>
</head>
<?php
Session_save_path(getcwd() . '/');
session_start();

include_once "function.php";


$username = $_SESSION['username'];


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
    <div style="background:#339900;color:#FFFFFF; width:150px;">Subscribers:</div><br>
	<table width="50%" cellpadding="0" cellspacing="0">

		<?php
      $subscribe = "select username from contacts where contact = '$username'";
      $subscribe_q = mysql_query($subscribe);
			while ($result_row = mysql_fetch_row($subscribe_q))
			{
		?>
        <tr valign="top">
			<td>
					<?php
						echo $result_row[0];
					?>
			</td>
            <td>
            <!--	<a href="media.php?id=<?php echo $result_row[0];?>" target="_blank"><?php //echo $result_row[1];?></a>
            </td>
            <td>
            	<a href="<?php //echo $result_row[2].$result_row[1];?>" target="_blank" onclick="javascript:saveDownload(<?php //echo $result_row[0];?>);">Download</a>-->
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
    <div style="background:#339900;color:#FFFFFF; width:150px;">Subscribed To:</div><br>
	<table width="50%" cellpadding="0" cellspacing="0">
		<?php
      $subscribers = "select contact from contacts where username = '$username'";
      $subscriber_q = mysql_query($subscribers);
			while ($result_row = mysql_fetch_row($subscriber_q))
			{
		?>
        <tr valign="top">
			<td>
					<?php
						echo $result_row[0];
					?>
			</td>
            <td>
            	<!--<a href="media.php?id=<?php echo $result_row[0];?>" target="_blank"><?php //echo $result_row[1];?></a>
            </td>
            <td>
            	<a href="<?php //echo $result_row[2].$result_row[1];?>" target="_blank" onclick="javascript:saveDownload(<?php //echo $result_row[0];?>);">Download</a>-->
            </td>
		</tr>
        <?php
			}
		?>
	</table>
</form>
</div>
<div id="form3" class="login">
	<form action="" method="post">
    <div style="background:#339900;color:#FFFFFF; width:150px;">Search Contact:</div>
	<table width="50%" cellpadding="0" cellspacing="0">
    <form class="search">
      <br>
		  <input class="search" type="text" placeholder="Search"
		    aria-label="Search" name="search">
			<input type="submit" name="submit" value="Search"><br><br>
      <?php
        if(isset($_POST['submit'])){
          $username_search = $_POST['search'];
          $_SESSION['search'] = $username_search;
          $query = "select username from account where username = '$username_search'";
          if(!($exists = mysql_query($query))){
            echo "user does not exist";
          }else{
            $exists = mysql_query($query);
            $exists_array = mysql_fetch_array($exists);
            if($exists_array[0] == ''){
              echo 'user does not exist';
            }else{
              echo $exists_array[0];
              $query2 = "select * from contacts where username";
              echo '<input type="submit" name="follow" value="Follow">';
          }

        ?>
        <tr valign="top">
			<td>
			</td>
		</tr>
        <?php
			}
    }
    ?>
    <?php
    if(isset($_POST['follow'])){
      $username_search = $_SESSION['search'];
    //  echo $username_search;
    //  echo $username;
      $query5 = "select * from contacts where username = '$username' and contact = '$username_search'";
      $blah = mysql_query($query5);
      $blaharray = mysql_fetch_array($blah);
      //echo $blaharray[0];
      if($blaharray[0] == ""){
        $query = "insert into contacts(username, contact) values ('$username', '$username_search')";
        if(!($follow_contact = mysql_query($query))){
          echo "error";
        }else{
          echo "you have subscribed to this user,";?><br>
          <?php
          echo "please refresh page to see updates.";
        }
      }else{
        echo "You are already subscribed to this user.";
      }
    }
		?>
	</table>
</form>
</div>
</body>
</html>
