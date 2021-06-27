<?php
	require "data.php";
	session_start();
		
	
	if(!isset($_SESSION["userId"]) || !isset($_SESSION["username"])){
		header("location:index.php"); 
	}
	
	if(isset($_POST['wagerChangeBtn'])){
		$wager = $_POST['wager']; 
		$result = wagerChange($wager); 
		if($result)header("location: statistics.php");
	}
	
	if(isset($_POST['winBtn'])){
		$win = $_POST['win'];
		$result = resultModification($win);
		if($result)header("location: index.php");
	}
		
	if(isset($_POST["additionalWagerBtn"])){
		$wager = $_POST['additionalWager']; 
		$result = additionalDailyBet($wager);
		if($result)header("location: statistics.php");
	}

	if(isset($_POST['deleteBtn'])){
		$result = deleteLastEntry(); 
		if($result)header("location: statistics.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Raleway:wght@400;800&display=swap" rel="stylesheet">
	<title>dataChange</title>
	<meta name="viewport" content="width=device-width, initial-scale = 1.0">
	<style>
		#dataChange{
			height: 800px;
			display: flex;
			flex-wrap: wrap;
			justify-content: space-around;
			padding-top: 5px;
			padding-bottom: 5px;
		}
		.form{
			width: 200px;
			height: 180px; 
			color: gold;
			display: flex;
			justify-content: space-around;
			align-items: center;
			border: solid gold 1px;
			border-radius: 20px;
		}
		body{
			background-color: #000;
			text-align: center;
		}
		h2{
			margin-top: 35px;
			margin-bottom: 0;
			color: gold;
		}
		p{
			font-family: 'Montserrat', sans-serif;
		}
		@media only screen and (min-width: 1000px){
			body{
				background-color: #000;
			}
			h2{
				margin-top: 0;
				margin-bottom: 10px;
				color: gold;
			}
			#dataChange{
				height: 1000px;
				padding-top: 100px;
			}
			.form{
				width: 20%;
				height: 21%; 
				color: gold;
				display: flex;
				justify-content: space-around;
				align-items: center;
				border: solid gold 1px;
				border-radius: 20px;
			}
			.navMain{
				visibility: hidden;
			}
		}
		@media only screen and (min-width: 380px) and (max-width: 600px){
			#dataChange{
				height: 400px;
			}
		}
	</style>
</head>
<body>
<?php include "toggleButton.php"; ?>
<div id="wrap" onclick="closeToggleNav()">
	<header>
		<h2 style="font-family: 'Montserrat', sans-serif;">Promjena podataka</h2>
	</header>	
	<?php include "header.php" ?>
	<div id="dataChange">
		<div class="form">
			<form action="dataChange.php" method="POST">
				<h4 style="font-family: 'Montserrat', sans-serif;">Nova uplata</h4>
				<label for="additionalWager" style="font-family: 'Montserrat', sans-serif;">Ulog &nbsp; </label>
				<input type="text" name="additionalWager" id="additionalWager" style="width: 100px; border: solid gold 1px; background-color: black; color:gold"/><br><br>
				<p id="additionalMessage" style="color:gold; font-size: 80%"></p> 
				<input type="submit" name="additionalWagerBtn" value="Potvrdi" style="color:gold; background-color:black"/>
			</form>
		</div>
		<div class="form">
			<form action="dataChange.php" method="POST">
				<h4 style="font-family: 'Montserrat', sans-serif;">Promjena uloga</h4>
				<label for="wager" style="font-family: 'Montserrat', sans-serif;">Ulog &nbsp; </label>
				<input type="text" name="wager" id="wagerAmount" style="width: 100px; border: solid gold 1px; background-color: black; color:gold"/><br><br>
				<p id="message" style="color:gold; font-size: 80%"></p> 
				<input type="submit" name="wagerChangeBtn" value="Potvrdi" style="color:gold; background-color:black"/>
			</form>
		</div>
		<div class="form"> 
			<form action="dataChange.php" method="POST"> 
				<h4 style="font-family: 'Montserrat', sans-serif;">Unos dobitka</h4>
				<label for="win" style="font-family: 'Montserrat', sans-serif;">Dobitak &nbsp; </label>
				<input type="text" name="win" id="winnings" style="width: 100px; border: solid gold 1px; background-color: black; color:gold"/><br><br>
				<p id="winMessage" style="color:gold; font-size: 80%"></p>
				<button name="winBtn"><img src="pictures/smiley.jpg" alt="smiley" style="width: 30px; height: 30px"></button>
			</form>
		</div>
		<div class="form" style="display:flex">
			<form action="dataChange.php" method="POST">
				<h4 style="font-family: 'Montserrat', sans-serif;">Brisanje zadnjeg unosa</h4>
				<input type="submit" name="deleteBtn" value="Obriši" style="background-color: black; color:gold">
			</form>
		</div>
	</div>
	<script type='text/javascript'>
	
		function additionalCommaCorrection(){
			let txt = document.getElementById("additionalWager"); 
			let val = txt.value;
			if(val.includes(",")){
				let newVal = val.replace(",", ".");
				txt.value = newVal; 
			}
		}
	
		function wrongAdditonalWagerInput(){
			let txt = document.getElementById("additionalWager"); 
			let val = txt.value;
			
			if(isNaN(val)){
				let msg = document.getElementById("additionalMessage"); 
				msg.innerHTML = "Pogrešan unos."; 
				txt.style.borderColor = "red"; 
				txt.value = ""; 
			}
		}
		
		let txtAddWager = document.getElementById("additionalWager");
		txtAddWager.addEventListener("input", additionalCommaCorrection);
		txtAddWager.addEventListener("input", wrongAdditonalWagerInput);
	
		//Wager change validation 
		
		function commaCorrection(){
			let txt = document.getElementById("wagerAmount"); 
			let val = txt.value;
			if(val.includes(",")){
				let newVal = val.replace(",", ".");
				txt.value = newVal; 
			}
		}
	
		function wrongWagerInput(){
			let txt = document.getElementById("wagerAmount"); 
			let val = txt.value;
			
			if(isNaN(val)){
				let msg = document.getElementById("message"); 
				msg.innerHTML = "Pogrešan unos."; 
				txt.style.borderColor = "red"; 
				txt.value = ""; 
			}
		}
		
		let txtAmount = document.getElementById("wagerAmount");
		txtAmount.addEventListener("input", commaCorrection);
		txtAmount.addEventListener("input", wrongWagerInput); 
		
		
		//Win input validation 
		
		function winCommaCorrection(){
			let txt = document.getElementById("winnings"); 
			let val = txt.value;
			if(val.includes(",")){
				let newVal = val.replace(",", ".");
				txt.value = newVal; 
			}
		}
				
		function wrongWinInput(){
			let winTxt = document.getElementById("winnings"); 
			let val = winTxt.value;
			
			if(isNaN(val)){
				let msg = document.getElementById("winMessage"); 
				msg.innerHTML = "Pogrešan unos."; 
				winTxt.style.borderColor = "red"; 
				winTxt.value = ""; 
			}
		}
		
		let winTxtBox = document.getElementById("winnings");
		winTxtBox.addEventListener("input", winCommaCorrection); 
		winTxtBox.addEventListener("input", wrongWinInput);
	</script>
</div>
</body>
</html>