<?php
	require_once "db.inc.php";
	require_once "validation.php";

	if(isset($_POST["submitBtn"])){
		$username = $_POST["username"];
		$password = $_POST["password"];	
		
		if(!emptyInputSignUp($username, $password) !== false){
			header("location: ../login.php?error=emptyInput");
			exit();
		}
		if(invalidUsername($username) !== false){
			header("location: ../login.php?error=invalidUsername");
			exit();
		}
		if(invalidUsername($password) !== false){
			header("location: ../signUp.php?error=invalidLogin");
			exit();	
		}
		logInUser($conn, $username, $password);
	}else{
		header("location: ../login.php");
		exit();
	}
	