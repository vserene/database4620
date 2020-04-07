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
		if(strcmp($row[1],$password))
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

function user_exist_check($username, $password, $email)
{
	$username = mysqli_real_escape_string($username);
	$password = mysqli_real_escape_string($password);
	$email = mysqli_real_escape_string($email);

	$query = "select * from account where username='$username'";

	if(!($result = mysqli_query($query))){
		die ("<p class=\"errorText\">Username was not available.</p>");
	}else{
		if(mysqli_num_rows($result) == 0){
			$query = "select * from account where email='$email'"
			if(!($result = mysqli_query($query))){
				die ("<p class=\"errorText\">Username was not available.</p>");
			}else{
				if(mysqli_num_rows($result) == 0){
					//FILTER_VALIDATE_EMAIL true email is valid
					if(filter_var($email,FILTER_VALIDATE_EMAIL)){
						//valid email
						$query = "insert into account (username, password, email, type) values ('$username','$password','$email','1')";
						echo "insert query:" . $query;
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
