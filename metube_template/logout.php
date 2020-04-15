<?php
	/* source: https://stackoverflow.com/
	questions/12209438/logout-button-php/12209491 */
	session_start();
	session_destroy();
	header('Location: index.php');
	exit;
?>
