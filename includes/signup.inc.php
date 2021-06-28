<?php

	if(isset($_POST["submitBtn"])){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$passwordRpt = $_POST["passwordRpt"];
		
		require_once "db.inc.php";
		require_once "validation.php";
		
		if(emptyInputSignUp($username, $password, $passwordRpt) !== false){
			header("location: ../signUp.php?error=emptyInput");
			exit();
		}
		if(invalidUsername($username) !== false){
			header("location: ../signUp.php?error=invalidUsername");
			exit();
		}
		if(passwordMatch($password, $passwordRpt) !== false){
			header("location: ../signUp.php?error=passwordMismatch");
			exit();
		}
		if(usernameExists($conn, $username) !== false){
			header("location: ../signUp.php?error=usernameExists");
			exit();
		}
		
		createUser($conn, $username, $password);
	}else{
		header("location: ../sugnUp.php"); 
		exit();
	}
	
	