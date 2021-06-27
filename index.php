<?php
	require "data.php";
	$currentState = getCurrentState();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Klađenje</title>
	<meta name="viewport" content="width=device-width, initial-scale = 1.0">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Raleway:wght@400;800&display=swap" rel="stylesheet">
	<style type="text/css">
		a{
			font-family: 'Montserrat', sans-serif;
			font-size: 3em;
			text-decoration: none;  
			color: gold; 
		}
		body{
			height: 100vh;
			width: 100vw;
			padding: 0;
			background-image: url('pictures/munichSmall.jpg'); 
			background-repeat: no-repeat;
			background-size: cover;
			background-attachment: fixed;
		}
		p{
			font-size: 3em; 
		}
		h1{
			text-align: center; 
			margin-top: 70px;
			margin-bottom: 0;
			color: gold; 
		}
		
		@media only screen and (min-width: 1000px){
			
				p{
					font-size: 6em;
				}
				body{
					height: 100vh;
					width: 100vw;
					padding: 0;
					background-image: url('pictures/munich.jpg'); 
					background-repeat: no-repeat;
					background-size: cover;
					background-attachment: fixed;
				}
				h1{
					text-align: center;
					margin-top: 0;
					margin-bottom: 10px;
					color: gold; 
				}
				.navMain{
					visibility: hidden;
				}
		}
		@media only screen and (min-width: 380px) and (max-width: 600px){
			h1, #result{
				margin-top: 15px;
			}
		}
		
	</style>
</head>
<body>
		<?php include "toggleButton.php"; ?>
		<div id="wrap" onclick="closeToggleNav()">
			<h1 style="font-family: 'Montserrat', sans-serif;">Klađenje</h1>
			<?php require_once "header.php"; ?>
			<div>
				<p id="result" style="text-align: center; font-family: 'Montserrat', sans-serif;"><?= $currentState ?></p><br>
			</div>
			<script type="text/javascript">

				function displayColor(){
					let p1 = document.getElementById("result");
					let result = p1.innerHTML; 

					if (result >= 0) {
						p1.style.color = "lightgreen"; 
					}else{
						p1.style.color = "red"; 
					}
				}
				
				displayColor(); 			
			</script>
		</div>
</body>
</html>