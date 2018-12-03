<?php
	$host = "localhost";
	$username = "root";
	$password = "";
	$database = "db_nphilips";
	
	$connection= mysqli_connect($host, $username, $password, $database);
	
	$error = mysqli_connect_error();
	if($error != null){
		die("<p>Unable to connect to database:  ".$error."</p>");
	}
?>