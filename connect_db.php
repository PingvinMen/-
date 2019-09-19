<?php
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$db_name = 'database';
	$link = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($link));
	mysqli_query($link, "SET NAMES 'utf8'");
?>
