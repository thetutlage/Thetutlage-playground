<?php
	session_start();
	if(isset($_SESSION['mashed_code']))
	{
		session_destroy();
	}
	header("location:index.php");
?>
