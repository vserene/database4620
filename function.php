<?php
include "mysqlClass.inc.php";

function user_pass_check($username, $password)
{

	$query = "select * from account where username='$username'";
	$result = mysql_query( $query );

	if (!$result)
	{
	   die ("user_pass_check() failed. Could not query the database: <br />". mysql_error());
	}
	else{
		$row = mysql_fetch_row($result);
		if(strcmp($row[2],$password))
			return 2; //wrong password
		else
			return 0; //Checked.
	}
}

function updateMediaTime($mediaid)
{
	$query = "	update  media set lastaccesstime=NOW()
   						WHERE '$mediaid' = mediaid
					";
					 // Run the query created above on the database through the connection
    $result = mysql_query( $query );
	if (!$result)
	{
	   die ("updateMediaTime() failed. Could not query the database: <br />". mysql_error());
	}
}

function upload_error($result)
{
	//view erorr description in http://us2.php.net/manual/en/features.file-upload.errors.php
	switch ($result){
	case 1:
		return "UPLOAD_ERR_INI_SIZE";
	case 2:
		return "UPLOAD_ERR_FORM_SIZE";
	case 3:
		return "UPLOAD_ERR_PARTIAL";
	case 4:
		return "UPLOAD_ERR_NO_FILE";
	case 5:
		return "File has already been uploaded";
	case 6:
		return  "Failed to move file from temporary directory";
	case 7:
		return  "Upload file failed";
	}
}

function user_exist_check($username, $password, $email, $fname, $lname)
{
	$username = mysql_real_escape_string($_POST['username']);
	$password = mysql_real_escape_string($_POST['password']);
	$email = mysql_real_escape_string($_POST['email']);
	$fname = mysql_real_escape_string($_POST['fname']);
	$lname = mysql_real_escape_string($_POST['lname']);

	$query = "select * from account where username='$username'";
	//$query = "insert into account (username, password, email, type) values ('$username','$password','$email','1')";

	if(!($result = mysql_query($query))){
		die ("<p class=\"errorText\">Username was not available.</p>");
	}else{
		//username wasn't used
	//	$query = "insert into account (username, password, email, type) values ('$username','$password','$email','1')";
		if(mysql_num_rows($result) == 0){
			//checks to see if email has been used yet
			$query = "select * from account where email='$email'";
			if(!($result = mysql_query($query))){
				die ("<p class=\"errorText\">Email was not available.</p>");
			}else{
				if(mysql_num_rows($result) == 0){
					//FILTER_VALIDATE_EMAIL true email is valid
				//	echo "trying to insert";
					if(filter_var($email,FILTER_VALIDATE_EMAIL)){
						//valid email
						$query = "insert into account (username, password, email, type, fname, lname) values ('$username','$password','$email','1','$fname','$lname')";
						header('Location: browse.php');
					//	echo "insert query:" . $query;
						//check if successful
						if($insert = mysql_query($query)) {
              return 1;
            }else{
							die ("<p class=\"errorText\">Account creation was unsuccessful.</p>");
						}
					}else{
						//email wasn't valid
						return 2;
					}
				}else{
					//no email
					return 3;
				}
			}
		}else{
			//username already in system
			return 4;
		}
	}
}

?>
