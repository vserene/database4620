<?php
Session_save_path('/home/mfetch/public_html/metube/');
session_start();
include_once "function.php";

/******************************************************
*
* upload document from user
*
*******************************************************/

$username=$_SESSION['username'];
//create result variable
$result = "";


//Create Directory if doesn't exist
if(!file_exists('uploads/')){
	mkdir('uploads/', 0755);
}

$dirfile = 'uploads/'.$username.'/';
//make directory for file if it doesn't already exist and change permissions
if(!file_exists($dirfile)){
	mkdir($dirfile, 0755);
	chmod($dirfile, 0755);
}

//try to upload
//get file error value
$error_check = $_FILES["file"]["error"];
if($error_check > 0 ){
	if($error_check == 1){
		$check_result = "File size is too large";
		echo "file size error1";
	}else if($error_check == 2){
		$check_result = "File size is too large";
		echo "file size error2";
	}else if($error_check == 3){
		$check_result = "Error occured during upload";
		echo "upload error3";
	}else if($error_check == 4){
		$check_result = "Upload Error";
		echo "upload error4";
	}else{
		$check_result = "Upload Error";
		echo "Upload error 4+";
	}
}else{
	//upload file prep
	$upfile = $dirfile.urlencode($_FILES["file"]["name"]);
	//check to see if file already is in system
	if(file_exists($upfile)){
		echo "file already uploaded";
		$result="5"; //The file has been uploaded.
	}else{
		if(is_uploaded_file($_FILES["file"]["tmp_name"])){
			if(!move_uploaded_file($_FILES["file"]["tmp_name"],$upfile)){
				//Failed to move file from temporary directory
				$result="6";
				echo "failed to move file to temp directory";
			}else{
				//could sort to category here if wanted
				$file_name = (string)$_FILES['file']['name'];
				$file_type = (string)$_FILES['file']['type'];
				//insert into media table
				echo "inseting to table";
				$insert = "insert into media(
							mediaid, filename,filepath,type)".
							"values(NULL,'". urlencode($_FILES["file"]["name"])."','$dirfile','".$_FILES["file"]["type"]."')";
				if(!($queryresult = mysql_query($insert))){
						$result = "upload failed";
						echo "upload failed";
						die("Insert into Media error in media_upload_process.php " .mysql_error());
						$result="0";
				}else{
					$mediaid = mysql_insert_id();
					//insert into upload table
					$insertUpload="insert into upload(uploadid,username,mediaid) values(NULL,'$username','$mediaid')";
					$queryresult = mysql_query($insertUpload)
						  or die("Insert into view error in media_upload_process.php " .mysql_error());
					$keyword1 = $_POST['tag1'];
				//	echo $keyword1;
					if(!(empty($keyword1))){
						$query = "insert into media_tags(mediaid,tag) values('$mediaid','$keyword1')";
						mysql_query($query);
					}
					$keyword2 = $_POST['tag2'];
					echo $keyword2;
					if(!(empty($keyword2))){
						$query = "insert into media_tags(mediaid,tag) values('$mediaid','$keyword2')";
						mysql_query($query);
					}
					$keyword3 = $_POST['tag3'];
					echo $keyword3;
					if(!(empty($keyword3))){
						$query = "insert into media_tags(mediaid,tag) values('$mediaid','$keyword3')";
						mysql_query($query);
					}
				}
				chmod($upfile, 0644);
				}
			}
		}
	}

	//You can process the error code of the $result here.
?>

<meta http-equiv="refresh" content="0;url=browse.php?result=<?php echo $result;?>">
