<?php
	require "data.php";
	$stats = array();
	$stats = getStats();
		
	$numberOfPlays = number_format($stats[0]);
	$hourlyProfit = number_format($stats[1], 2, ".", " ");
	$dailyProfit = number_format($stats[2], 2, ".", " ");
	$monthlyProfit = number_format($stats[3], 2, ".", " ");
	$yearlyProfit = number_format($stats[4], 2, ".", " ");
	$profitPerPlay = number_format($stats[5], 2, ".", " ");

	// foreach($stats as $s){
		// $s = number_format($s, 2, ".", " ");
	// }
	 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Stats</title>
	<meta name="viewport" content="width = device-width, initial-scale = 1.0">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Raleway:wght@400;800&display=swap" rel="stylesheet"> 
	<style type="text/css">
		body{
			display: flex;
			flex-wrap: wrap;
			background-color: #000;
			justify-content: center; 
		}
		a{
			text-decoration: none; 
		}
		p{
			font-family: 'Montserrat', sans-serif;
			color: gold;
		}
		h1, h2, h3, h4{
			font-family: 'Montserrat', sans-serif;
			color: gold;
			text-align: center; 
		}
		h1{
			margin-top: 35px;
			margin-bottom: 0;
		}
		#betList{
			width: 95vw;
			padding-right: 15px;
		}
		#betList p, #betListLink{
			font-size: 0.6em;
		}
		.stats{
			width: 90%;
			display: flex;
			justify-content: space-around;
		}
		.stats p{
			font-size: 0.9em;
			border: solid gold 1px;
			margin: 1px;
		}
		.statsTitle{
			width: 60%;
			margin-right: 5px;
			padding: 5px;
			text-align: center;
		}
		.statsNumbers{
			width: 40%;
			padding: 5px;
			text-align: center;
		}
		#average{
			padding-left: 10px;
			font-family: 'Montserrat', sans-serif;
			margin: 10px 5px;
			width: 90vw;
		}
		
		@media only screen and (min-width: 1000px){
			body{
				background-color: #000;
			}
			h1{
				margin-top: 0;
				margin-bottom: 10px;
			}
			#average{
				width: 97.5%;
				display: flex;
				justify-content: space-around;
			}
			#betList{
				width: 70vw;
			}
			#betList p, #betListLink{
				font-size: 1em;
			}
			.stats{
				display: block;
				align-items: center;
				height: 70px;
				width: 15%;
				margin-top: 20px;
				padding-top: 15px; 
				border: solid gold 3px;
				border-radius: 20px;
			}
			.stats p{
				font-size: 1.3em; 
				border: none;
				margin: 1px;
				text-align: center;
			}
			.statsTitle{
				width: 100%;
				margin-right: 0px;
				padding: 0px;
				text-align: center;
			}
			.statsNumbers{
				width: 100%;
				padding: 5px;
				text-align: center;
			}
			.navMain{
				visibility: hidden;
			}
		}
	</style>
</head>
<body style="width:100vw">
<?php include "toggleButton.php"; ?> 
<div id="wrap" onclick="closeToggleNav()">
	<header>
		<h1>Statistika</h1>
		<?php include "header.php" ?>
	</header>
	<div id="average">
		<div class="stats">
			<p class="statsTitle">Broj uplata</p>		
			<p class="statsNumbers"><?= $numberOfPlays ?></p>
		</div>
		<div class="stats">
			<p class="statsTitle">Po uplati</p>		
			<p class="statsNumbers"><?= $profitPerPlay ?></p>
		</div>
		<div class="stats">
			<p class="statsTitle">Po satu</p>
			<p class="statsNumbers"><?= $hourlyProfit ?></p>
		</div>
		<div class="stats">
			<p class="statsTitle">Dnevno</p>
			<p class="statsNumbers"><?= $dailyProfit ?></p>
		</div>
		<div class="stats">
			<p class="statsTitle">Mjesečno</p>
			<p class="statsNumbers"><?= $monthlyProfit ?></p>
		</div>
		<div class="stats">
			<p class="statsTitle">Godišnje</p>
			<p class="statsNumbers"><?= $yearlyProfit ?></p>
		</div>
	</div>
		<h2>Dobitni dani</h2>
		<a href="statistics.php" id="betListLink">Prikaži sve uplate</a>
	<div style="display:flex; justify-content:center">
		<div id="betList">
			<div style="display:flex; justify-content:space-around; border:solid gold 3px; margin:2px;">
				<div style="display:inline; width:25%;"><p style="text-align:center; font-family: 'Montserrat', sans-serif;">Datum</p></div>
				<div style="display:inline; width:25%"><p style="text-align:center; font-family: 'Montserrat', sans-serif;">Uplata</p></div>
				<div  style="display:inline; width:25%"><p style="text-align:center; font-family: 'Montserrat', sans-serif;">Rezultat</p></div>
				<div style="display:inline; width:25%"><p style="text-align:center; font-family: 'Montserrat', sans-serif;">Ukupni rezultat</p></div>
			</div>
			<?php getWins() ?>
		</div>
	</div>
</div>
</body>
</html>