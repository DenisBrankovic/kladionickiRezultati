<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Log in</title>
	<meta name="viewport" content="width = device-width, initial-scale = 1.0"> 
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Raleway:wght@400;800&display=swap" rel="stylesheet">
	<style type="text/css">	
		body{
			height: 500px; 
			background-color: #000;
		}
		h1{
			margin-top: 30px; 
			margin-bottom: 0;
			color: gold;
			text-align: center;
		}
		a{
			text-decoration: none;  
			color: gold; 
		}
		p{
			font-family: 'Montserrat', sans-serif;
			font-size: 0.8em;
			color: gold;
		}
		label{
			font-family: 'Montserrat', sans-serif;
			font-size: 80%;
		}
		#f{
			color: gold;
			margin:  35px auto;
			padding-top: 10px;
			width: 60vw;
			height: 31vh; 
			display: flex;
			flex-direction: column; 
			align-items: center;
			justify-content: space-around;
		}
		input{
			width: 85%; 
			margin: 5px;
			display: block;
			border-color: gold;
			background-color: black;
			color: gold;
		}
		#m{
			text-align: center; 
		}
		#submitBtn{			
			width: 70%;
			height: 40%;
		}
		@media only screen and (min-width: 1000px){
			#f{
				border: solid gold 1px;
				border-radius: 15px;
				width: 25vw; 
			}
			body{
				height: 500px; 
				background-color: #000;
			}
			.navMain{
				visibility: hidden;
			}
		}
		
	</style>
</head>
<body>
<?php include "toggleButton.php"; ?>
<div id="wrap" onclick="closeToggleNav()">
	<header>
		<h1 style="font-family: 'Montserrat', sans-serif;">Log in</h1>
	</header>
	<?php include "header.php" ?>
	<div id="f">
		<form action="includes/login.inc.php" method="post">
			<label for="username">&nbsp; Username</label>
			<input type="text" name="username">
			<label for="password">&nbsp; Password</label> 
			<input type="password" name="password">
			<input id="submitBtn" type="submit" name="submitBtn" value="Log in" style="height:25px">
		</form>
		<div id="m">
			<?php
				if(isset($_GET["error"])){
					if($_GET["error"] == "emptyInput"){
						echo "<p>All fields are required.</p>"; 
					}else if($_GET["error"] == "invalidLogin"){
						echo "<p>Invalid username or password.</p>";
					}
				}
			?>
		</div>
	</div>
</div>
</body>
</html>