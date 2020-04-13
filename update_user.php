<link rel="stylesheet" type="text/css" href="css/default.css" />
<?php
Session_save_path('/home/mfetch/public_html/metube/');
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
