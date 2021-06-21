<?php
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$dbname = 'caturperkasaland';
	$conn = mysqli_connect($host, $user, $password) or die(mysql_error());
	mysqli_select_db($conn, $dbname) or die("nodatabase");
?>