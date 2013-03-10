<?php
	$dir = '../axjQMP';
	$item = scandir($dir);
	foreach($item as $i)
	{
		if($i == '.' || $i == '..') continue;
		unlink($dir.DIRECTORY_SEPARATOR.$i);
	}
?>