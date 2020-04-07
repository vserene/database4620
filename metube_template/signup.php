<link rel="stylesheet" type="text/css" href="css/default.css" />
<?php
session_start();

include_once "function.php";

if(isset($_POST['submit'])) {
    //check passwords match
		if($_POST['password'] == "" || $_POST['passwordconfirm'] == "") {
			$register_error = "Passwords do not match.";
		}
		else {
			$check = user_exist_check($_POST['username'],$_POST['password'],$_POST['email']); // Call functions from function.php
			if($check == 1) {
        $_SESSION['username']=$_POST['username'];
				include_once('mysqlClass.inc.php');
        $query = "select id from account where username = '$_SESSION[username]'";
        if($result= mysql_query($query)){
          //for playlist creation?
        }else{
          $register_error = "error";
        }
			}else if($check == 2){
        $register_error = "Email isn't valid";
      }else if($check == 3){
        $register_error = "No email entered";
      }else if($check == 4)
        $register_error = "Username already exists";
		}
}



?>
	<form method="post" action="<?php echo "index.php"; ?>">

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
      <td  width="20%">Re-enter Password:</td>
      <td width="80%"><input class="text"  type="password" name="passwordconfirm"><br /></td>
    </tr>	<tr>
  			<td  width="20%">Email:</td>
  			<td width="80%"><input class="text"  type="text" name="email"><br /></td>
  		</tr>
		<tr>

			<td><input name="submit" type="submit" value="Login"><input name="reset" type="reset" value="Reset"><br /></td>
		</tr>
	</table>
	</form>

<?php
  if(isset($login_error))
   {  echo "<div id='passwd_result'>".$login_error."</div>";}
?>
