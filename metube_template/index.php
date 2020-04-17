<html lang="en">
<head>
  <title>MeTube</title>
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
	    margin-left: 60%;
	}
	</style>


</head>
<?php
session_save_path(getcwd() . '/');
session_start();

include_once "function.php";

if(isset($_POST['submit'])) {
		if($_POST['username'] == "" || $_POST['password'] == "") {
			$login_error = "One or more fields are missing.";
		}
		else {
			$check = user_pass_check($_POST['username'],$_POST['password']); // Call functions from function.php
			if($check == 1) {
				$login_error = "User ".$_POST['username']." not found.";
			}
			elseif($check==2) {
				$login_error = "Incorrect password.";
			}
			else if($check==0){
				$_SESSION['username']=$_POST['username']; //Set the $_SESSION['username']
				header('Location: browse.php');
			}
		}
}



?>
<body onload="loadInfo()">

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
      <!--  <li><a href="index.php">Home</a></li>-->
        <!--<li><a href="#">Help</a></li>-->
      </ul>
      <ul class="nav navbar-nav navbar-right">
    <!--    <li><a href="update_user.php">My Account</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>-->
      </ul>
    </div>
  </div>
</nav>
<body>
	<div id="form1" class="login">
		<form action="" method="post">
			<table width="100%">
				<tr>
					<td  width="20%">Username:</td>
					<td width="80%"><input class="text"  type="text" name="username"><br /></td>
				</tr>
				<tr>
					<td  width="20%">Password:</td>
					<td width="80%"><input class="text"  type="password" name="password"><br /></td>
				</tr>
				<tr>
					<td>
					<!--	<input id="login" type="submit" class="submit1" value="Login" onclick="verifyUser()"/>-->
					<!--	<form action="" method="post">-->
							<input name="submit" type="submit" value="Login">
							<input name="reset" type="reset" value="Reset">
							<input type="button" onclick="location.href='signup.php';" value="Sign Up" />
					<!--	</form>-->
						<!--<a href="signup.php" class="button">Sign Up</a>-->
					<!--	<input name="signup" type="submit" value="Sign Up" href= "signup.php">-->
						<br />
					</td>
				</tr>
			</table>
		</form>
</div>
</body>
</html>
<?php
  if(isset($login_error))
   {  echo "<div id='passwd_result'>".$login_error."</div>";}
?>
