<link rel="stylesheet" type="text/css" href="css/default.css" />
<html lang="en">
<head>
  <title>Messages</title>
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
	    margin-left: 3%;
	}
  #header1{
    top:70px;
    font-family:verdana;
    font-size:16px;
    margin-top: 10px;
    margin-left: 0%;
  }
  #header2{
    top:70px;
    font-family:verdana;
    font-size:16px;
    margin-top: -23px;
    margin-left: 25%;
  }
  #header3{
    top:20px;
    font-family:verdana;
    font-size:16px;
    margin-top: -23px;
    margin-left: 70%;
  }
  #send{
    width:300px;
    margin-left: 10%%;
  }
  </style>
</head>
<?php
Session_save_path('/home/mfetch/public_html/metube/');
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
  <div id="form1" class="login">
		<form action="" method="post">
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
          echo "Message to: ";
          echo $exists_array[0];
          $query2 = "select * from contacts where username";
          echo ' <input type="submit" name="send" value="Send Message"><br>';
          echo '<textarea name="message" cols="50" rows="4"></textarea>';
      }
    }
  }

    ?>
</form>
<?php
  if(isset($_POST['send'])){
    $user_f = $_SESSION['username'];
    //echo $user_f;
    $user_t = $_SESSION['search'];
    //echo $user_t;
    $message = $_POST['message'];
    //echo $message;
    $query = "insert into messages(user_t, user_f, message) values('$user_t','$user_f', '$message')";
    if(!($result = mysql_query($query))){
      echo "Message failed to send.";
    }else{
      echo "Message was sent.";
    }

  }
 ?>
</div>
</body>
</html>
