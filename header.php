<?php
	if(!isset($_SESSION)){
		session_start();
	}
		
	if(isset($_SESSION["userId"]) && $_SESSION["userId"] === 4 && $_SESSION["username"] === "alen" ){
		$dataChange = "<a href='dataChange.php'>Admin</a>";
		$_SESSION["admin"] = "<a href='dataChange.php'>Admin</a>";
	}else{
		$dataChange = null; 
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>header</title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Raleway:wght@400;800&display=swap" rel="stylesheet">
	<style>
		body{
			background-color: #000; 
		}
		a{
			text-decoration: none;
			color: gold;
			font-family: 'Montserrat', sans-serif;
			font-size: 80%;
		}
		nav{
			width: 98.3vw; 
			display: flex;
			justify-content: space-around;
		}
		#header{
			visibility: hidden;
		}
		@media only screen and (min-width: 1000px){
			nav{
				width: 96.5vw; 
				padding: 7px;
				border: solid gold 1px;
				border-radius: 10px;
				font-size: 130%; 
			}
			#header{
				visibility: visible; 
			}
		}
	</style>
</head>
<body>
	<nav id="header">
		<a href="index.php">Home</a>
		<a href="statistics.php">Statistika</a>
		<?= $dataChange ?>
		<a href="introduction.php">Help</a>
		<?php
			if(isset($_SESSION["userId"])){
				echo "<a href='includes/logout.inc.php'>Log out</a>";
			}else{
				echo "<a href='login.php'>Log in</a>";
			}
		?>
	</nav>
</body>
</html>