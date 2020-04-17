<link rel="stylesheet" type="text/css" href="css/default.css" />
<html lang="en">
<head>
  <title>My Account</title>
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
	    margin-left: 37%;
	}
	</style>
</head>
<?php
session_save_path(getcwd() . '/');
session_start();

include_once "function.php";


$username = $_SESSION['username'];
//pull first name
$query = "SELECT fname FROM account WHERE username='$username'";
$fname = mysql_fetch_array(mysql_query($query));
//pull last name
$query = "SELECT lname FROM account WHERE username='$username'";
$lname = mysql_fetch_array(mysql_query($query));
//pull Email
$query = "SELECT email FROM account WHERE username='$username'";
$email = mysql_fetch_array(mysql_query($query));
//pull password
$query = "SELECT password FROM account WHERE username='$username'";
$password = mysql_fetch_array(mysql_query($query));

//echo $SESSION['username'];
if(isset($_POST['submit'])) {
  //check to see if updated passwords match
  if($_POST['password'] != $_POST['passwordconfirm']){
    $update_error = "Passwords do not match.";
    echo "Passwords do not match.";
  }else{
    //set variables
    //$username_update = mysql_real_escape_string($_POST['username']);
    $password_update = mysql_real_escape_string($_POST['password']);
    $email_update = mysql_real_escape_string($_POST['email']);
    $fname_update = mysql_real_escape_string($_POST['fname']);
    $lname_update = mysql_real_escape_string($_POST['lname']);
    $password_update = mysql_real_escape_string($_POST['password']);

    //check to make sure email isn't already in use
    $query = "select * from account where email='$email_update'";
    if(!($result = mysql_query($query))){
      die ("<p class=\"errorText\">Email was not available.</p>");
    }else{
      if(mysql_num_rows($result) == 0){
        //validate Email
        if(filter_var($email_update,FILTER_VALIDATE_EMAIL)){
          //query to update database
          $query = "UPDATE account SET password = '$password_update', email = '$email_update', fname = '$fname_update', lname = '$lname_update' WHERE username = '$username'";
          if(!($result = mysql_query($query))){
            $update_error = "error updating";
            echo "An error occured when updating account information";
          }
        }else{
          $update_error = "Email wasn't valid.";
          echo "Email wasn't valid.";
        }
      }
      header("Refresh:0");
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
	<div id="form1" class="signup">
		<form action="" method="post">
      <form method="post" action="<?php echo "update_user.php"; ?>">
        <table width="100%">
          <tr>
            <td  width="20%">Username:</td>
            <td width="80%"><input class="text"  type="text" name="username" value= <?php echo htmlentities($username); ?> disabled="disabled"><br /></td>
          </tr>
          <tr>
            <td  width="20%">First Name:</td>
            <td width="80%"><input class="text"  type="text" name="fname" value= <?php echo htmlentities($fname[0]); ?> ><br /></td>
          </tr>
          <tr>
            <td  width="20%">Last Name:</td>
            <td width="80%"><input class="text"  type="text" name="lname" value= <?php echo htmlentities($lname[0]); ?>><br /></td>
          </tr>
          <tr>
            <td  width="20%">Password:</td>
            <td width="80%"><input class="text"  type="password" name="password" value= <?php echo htmlentities($password[0]); ?>><br /></td>
          </tr>
          <tr>
            <td  width="20%">Re-enter Password:</td>
            <td width="80%"><input class="text"  type="password" name="passwordconfirm" value= <?php echo htmlentities($password[0]); ?>><br /></td>
          </tr>	<tr>
              <td  width="20%">Email:</td>
              <td width="80%"><input class="text"  type="text" name="email" value= <?php echo htmlentities($email[0]); ?>><br /></td>
            </tr>
          <tr>

            <td><input name="submit" type="submit" value="Update"><input name="reset" type="reset" value="Reset"><br /></td>
          </tr>
        </table>
      </form>
    </form>
  </div>
</body>
