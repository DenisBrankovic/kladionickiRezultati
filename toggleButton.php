<?php		
	if(!isset($_SESSION)){
		session_start();
	}
	if(isset($_SESSION["userId"]) && $_SESSION["userId"] === 4 && $_SESSION["username"] == "alen"){
		$dataChange = "<a href='dataChange.php'>Admin</a>";
	}else{
		$dataChange = null; 
	}
?> 
<!DOCTYPE html>
<html>
<head>
	<link type="text/css" rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Raleway:wght@400;800&display=swap" rel="stylesheet">
	<title>toggleButton</title>
	<style type="text/css">
		.toggleBtn{
			width: 40px;
			height: 50px;
			position: absolute;
			left: 0;
			top: 0; 
			margin-left: 3px;
			z-index: 1;
		}
		.stripe{
			width: 27px;
			height: 4px;
			background-color: gold;
			margin: 4px 0;
		}
		.navSidebar{
			position: absolute;
			top:0;
			left: 0;
			bottom: 0;
			width: 30px;
			height: 30px;
			padding: 0 5px;
			border-radius: 10px;
			background-color: transparent;
			z-index: -1; 
			transition: all 0.3s ease-in-out;
		}
		ul{
			list-style: none; 
			padding-left: 15px;
		}
		.navSidebar ul{
			padding-top: 15px;
			overflow: hidden; 
			visibility: hidden;
		}
		.navSidebar ul li{
			line-height: 20px;
			list-style: none;
		}
		.navSidebar ul li a{
			display: block;
			height: 25px;
			padding-top: 10px;
			padding-left: 15px;
			text-decoration: none;
			color: gold;
			font-family: 'Montserrat', sans-serif;
			font-size: 100%;
			white-space: nowrap;
			opacity: 0;
			transition: all 0.3s ease-in-out; 
		}
		#wrap{
			height: 100%; 
		}
	</style>
</head>
<body>
	<div class="navMain">
		<div class="toggleBtn" onclick="toggleNav()">
			<div class="stripe"></div>
			<div class="stripe"></div>
			<div class="stripe"></div>
		</div>
		<aside class="navSidebar">
			<ul style="width: 100px">
				<li><a href="index.php">Home</a></li>
				<li><a href="statistics.php">Statistika</a></li>
				<li><?= $dataChange ?></li>
				<li><a href="introduction.php">Help</a></li>
				<li><?php
					if(isset($_SESSION["userId"])){
						echo "<a href='includes/logout.inc.php'>Log out</a>";
					}else{
						echo "<a href='login.php'>Log in</a>";
					}
				?></li>
			</ul>
			</aside>
	</div>
</body>
<script src="sideBarMenu.js"></script>
</html>