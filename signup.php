<link rel="stylesheet" type="text/css" href="css/default.css" />
<?php
Session_save_path('/home/mfetch/public_html/metube/');
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

<?php
  if(isset($login_error))
   {  echo "<div id='passwd_result'>".$login_error."</div>";}
?>
