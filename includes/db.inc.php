<?php
	$dbHost = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbName = "betting";
	
	$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName); 
				
	if(!$conn){
		die("Unable to establish connection.");
	}