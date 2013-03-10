<?php
	session_start();
	if(isset($_SESSION['mashed_code'])){
		$dir1 = 'downloads/';
		$download_username = $dir1.strtotime("now").'.html';
		$filename1 = $download_username;
		$filehandle1 = fopen($filename1, 'w') or die("can't open file");
		fwrite($filehandle1,$_SESSION['mashed_code']);
		fclose($filehandle1);
		header('Content-type: text/html');
		header('Content-Disposition: attachment; filename="'.$filename1.'"');
		readfile($filename1);
		unlink($filename1);
	}
	else
	{
	}
?>
