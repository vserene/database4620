<?php
Session_save_path('/home/mfetch/public_html/metube/');
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media Upload</title>
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
        <li><a href="update_user.php">My Account</a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<body>
  <div id="form1" class="signup">
		<form action="media_upload_process.php" method="post" enctype="multipart/form-data">

      <form method="post" action="media_upload_process.php" enctype="multipart/form-data" >

        <p style="margin:0; padding:0">
        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
         Add a Media: <label style="color:#663399"><em> (Each file limit 10M)</em></label><br/>
         <input  name="file" type="file" size="50" />

      	<input value="Upload" name="submit" type="submit"/>
        </p>


       </form>
     </form>
   </div>
</body>
</html>
