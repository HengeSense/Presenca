<?php
	include_once("includes/loginCheck.php");

	$filename = basename($_SERVER['PHP_SELF']);
	$path = str_replace($filename, '', $_SERVER['PHP_SELF']);

	setcookie($chave, '', 0, $path);
	header("Location: $path");	
?>