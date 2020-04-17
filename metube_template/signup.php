<link rel="stylesheet" type="text/css" href="css/default.css" />
<html lang="en">
<head>
  <title>Sign Up!</title>
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


if(isset($_POST['submit'])) {
    //check passwords match
		if($_POST['password'] == $_POST['passwordconfirm']){
			$check = user_exist_check($_POST['username'],$_POST['password'],$_POST['email'],$_POST['fname'],$_POST['lname']);
			if($check == 1){
				$_SESSION['username']=$_POST['username'];
				include_once('mysqlClass.inc.php');
				$query = "SELECT id FROM account WHERE username = '$_SESSION[username]'";
				if($result = mysql_query($query)){
					//more creation can be added here
				}else{
					$signup_error = "error";
				}
			}else if($check == 2){
				$signup_error = "Email isn't vaild.";
				echo "Email isn't valid.";
			}else if($check == 3){
				$signup_error = "No email entered.";
				echo "No email is entered.";
			}else if($check == 4){
				$signup_error = "Username already exists.";
				echo "Username already exists.";
			}
		}else{
			$signup_error = "Passwords do not match.";
			echo "Passwords do not match.";
		}
	//	user_exist_check($_POST['username'],$_POST['password'],$_POST['email']);
	//	if($_POST['password'] != "" || $_POST['passwordconfirm']) {
	//		$signup_error = "Passwords do not match.";
	//	}
	//	else {
	//		$check = user_exist_check($_POST['username'],$_POST['password'],$_POST['email']); // Call functions from function.php
	//		if($check == 1) {
  //      $_SESSION['username']=$_POST['username'];
	//			include_once('mysqlClass.inc.php');
  //      $query = "select id from account where username = '$_SESSION[username]'";
				//$ref_error = "";
  //      if($result= mysql_query($query)){
          //for playlist creation?
  //      }else{
  //        $signup_error = "error";
  //      }
	//		}else if($check == 2){
  //      $signup_error = "Email isn't valid";
  //    }else if($check == 3){
  //      $signup_error = "No email entered";
  //    }else if($check == 4)
  //      $signup_error = "Username already exists";
	//	}
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
        <li><a href="index.php">Login</a></li>
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
	<div id="form1" class="signup">
		<form action="" method="post">
			<form method="post" action="<?php echo "signup.php"; ?>">

				<table width="100%">
					<tr>
						<td  width="20%">Username:</td>
						<td width="80%"><input class="text"  type="text" name="username"><br /></td>
					</tr>
					<tr>
						<td  width="20%">First Name:</td>
						<td width="80%"><input class="text"  type="text" name="fname"><br /></td>
					</tr>
					<tr>
						<td  width="20%">Last Name:</td>
						<td width="80%"><input class="text"  type="text" name="lname"><br /></td>
					</tr>
					<tr>
						<td  width="20%">Password:</td>
						<td width="80%"><input class="text"  type="password" name="password"><br /></td>
					</tr>
			    <tr>
			      <td  width="20%">Re-enter Password:</td>
			      <td width="80%"><input class="text"  type="password" name="passwordconfirm"><br /></td>
			    </tr>	<tr>
			  			<td  width="20%">Email:</td>
			  			<td width="80%"><input class="text"  type="text" name="email"><br /></td>
			  		</tr>
					<tr>

						<td><input name="submit" type="submit" value="Sign Up"><input name="reset" type="reset" value="Reset"><br /></td>
					</tr>
				</table>
				</form>
			</form>
		</div>
	</body>
</html>
<?php
  if(isset($login_error))
   {  echo "<div id='passwd_result'>".$login_error."</div>";}
?>
