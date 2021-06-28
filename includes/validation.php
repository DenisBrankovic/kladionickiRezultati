<?php

	function emptyInputSignUp($username, $password, $passwordRpt){
		$result;
		if(empty($username) || empty($password) || empty($passwordRpt)){
			$result = true;
		}else{
			$result = false;
		}
		return $result;
	}
	
	function invalidUsername($username){
		$result;
		if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
			$result = true;
		}else{
			$result = false;
		}
		return $result;
	}
	
	function passwordMatch($password, $passwordRpt){
		$result;
		if($password !== $passwordRpt){
			$result = true;
		}else{
			$result = false;
		}
		return $result; 
	}
	
	function usernameExists($conn, $username){
		$sql = "select * from users where username = ?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("location: ../signUp.php?error=usernameExists");
			exit(); 
		}
		
		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);
		
		$resultData = mysqli_stmt_get_result($stmt);
		
		if($row = mysqli_fetch_assoc($resultData)){
			return $row; 
		}else{
			$result = false;
			return $result;
		}
		mysqli_stmt_close($stmt);
	}
	
	function createUser($conn, $username, $password){
		$sql = "insert into users values(null, ?, ?)";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("location: ../signUp.php?error=stmtFailed");
			exit(); 
		}
		
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		
		mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPassword); 
		mysqli_stmt_execute($stmt);		
		mysqli_stmt_close($stmt);
		header("location: ../login.php?error=none");
		exit(); 
	}
	
	function emptyInputLogIn($username, $password){
		$result;
		if(empty($username) || empty($password)){
			$result = true;
		}else{
			$result = false;
		}
		return $result;
	}
	
	function logInUser($conn, $username, $password){
		$usernameExists = usernameExists($conn, $username, $password);
		
		if($usernameExists === false){
			header("location: ../login.php?error=invalidLogin");
			exit(); 
		}
		 
		$passwordHashed = $usernameExists["password"];
		$checkedPassword = password_verify($password, $passwordHashed);
		
		if($checkedPassword === false){
			header("location: ../login.php?error=invalidLogin");
			exit(); 
		}else if($checkedPassword === true){
			session_start();
			$_SESSION["userId"] = $usernameExists["userId"];
			$_SESSION["username"] = $usernameExists["username"];
			$_SESSION["password"] = $usernameExists["password"];
			header("location: ../index.php");
			exit();
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	