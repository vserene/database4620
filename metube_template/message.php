<link rel="stylesheet" type="text/css" href="css/default.css" />
<html lang="en">
<head>
  <title>Messages</title>
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
	    margin-left: 3%;
	}
  #header1{
    top:70px;
    font-family:verdana;
    font-size:16px;
    margin-top: 10px;
    margin-left: 0%;
  }
  #header2{
    top:70px;
    font-family:verdana;
    font-size:16px;
    margin-top: -23px;
    margin-left: 25%;
  }
  #header3{
    top:20px;
    font-family:verdana;
    font-size:16px;
    margin-top: -23px;
    margin-left: 70%;
  }
  </style>
</head>
<?php
session_save_path(getcwd() . '/');
session_start();

include_once "function.php";


$username = $_SESSION['username'];


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
  <div id="form1" class="login">
  	<form action="" method="post">
      <div style="background:#339900;color:#FFFFFF; width:150px;">Messages:</div><br>
      <input type="button" name="submit" value="Send Message" onclick="location.href='send_message.php';"><br>
      <div style="background:#339900;color:#FFFFFF; width:150px;" id = "header1">From:</div>
      <div style="background:#339900;color:#FFFFFF; width:150px;" id = "header2">Message:</div>
      <div style="background:#339900;color:#FFFFFF; width:150px;" id = "header3">Date:</div><br>
      <table cellpadding="0" cellspacing="0">

    		<?php
          $received = "select user_f, message, date from messages where user_t = '$username'";
          $received_q = mysql_query($received);
          if($received_q == FALSE){
            echo "error";
          }
        //  $received_a = mysql_fetch_array($received_q);
    			while ($result_row = mysql_fetch_row($received_q))
    			{
    		?>
            <tr valign="top">
    			<td>

           </td>
                <td width="280">
                  <div>
                    <?php echo $result_row[0];?>
                  </div>
                </td>
                <td width="500">
                  <div>
                    <?php echo $result_row[1];?>
                  </div>
                </td>
                <td width="300">
                  <div>
                    <?php echo $result_row[2];?>
                  </div>
                </td>
    		</tr>
            <?php
    			}
    		?>
    	</table>
    </form>
    </div>
  </body>
  </html>
