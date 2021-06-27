<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Introduction</title>
	<meta name="viewport" content="width=device-width, initial-scale = 1.0">
	<link type="text/css" rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Raleway:wght@400;800&display=swap" rel="stylesheet">
	<style type="text/css">
		
		body{
			height: 700px;
			background-color: #000;
		}
		a{
			text-decoration: none;
			color: gold;
		}
		p{
			font-family: 'Montserrat', sans-serif;
			font-size: 80%; 
			color: gold; 
		}
		h1{
			margin-top: 30px;
			font-family: 'Montserrat', sans-serif;
			color: gold;
			text-align: center;
			margin-bottom: 0;
		}
		h3{
			font-family: 'Montserrat', sans-serif; 
			color: gold;
		}
		#contents{
			margin: 10px;  
		}
		
		@media only screen and (min-width: 1000px){
			body{
				height: 700px;
				background-color: #000;
			}
			a{
				text-decoration: none;
				color: gold;
			}
			p{
				font-family: 'Montserrat', sans-serif;
				font-size: 100%; 
				color: gold; 
			}
			h1{
				margin-top: 0px;
				margin-bottom: 10px;
				font-family: 'Montserrat', sans-serif;
				color: gold;
				text-align: center;
			}
			.navMain{
				visibility: hidden;
			}
			#contents{
				margin: 20px; 
			}
		}
	</style>
</head>
<body>
	<?php include "toggleButton.php"; ?>
	<div id="wrap" onclick="closeToggleNav()">
		<header>
			<h1>Help</h1>
		</header>
		<?php include "header.php" ?>
		<div id="contents">
			<h3>Front Page</h3>
			<p>Na naslovnoj strani se nalazi samo trenutni rezultat koji se svakodnevno umanjuje za predefinisanu vrijednost od 1 KM.<br>
			Promjenu dnevnog uloga ili unos dobitka može da vrši samo ulogovani korisnik.</p>
			
			<h3>Unos i promjena podataka</h3>
			<p>Polje <b><i>NOVA UPLATA</i></b>, služi za upisivanje eventualne dodatne uplate u toku dana. Koristi se samo onda kad je, pored podrazumijevane uplate od 1 KM
			bilo dodatnih dnevnih uplata. Znači, unosom u ovo polje ne mijenja se podrazumijevana uplata, samo se dodaje nova za taj dan.<br>
			Polje <b><i>PROMJENA ULOGA</i></b> služi za promjenu podrazumijevanog uloga. 
			<b><i>UNOS DOBITKA</i></b> služi za upisivanje istoimene pojave.<br>
			<b><i>BRISANJE ZADNJEG UNOSA</i></b> <br>
			Ovim poljem se ne može mijenjati podrazumijevana uplata. Ono služi samo za ispravljanje eventualne greške napravljene
			pri upisivanju dodatnih uplata ili dobitaka.</p>
			<h3>Dani bez uplate</h3>
			<p>Ako nije bilo uplate u polje <b><i>PROMJENA ULOGA</i></b> se jednostavno upiše 0. Na taj način se u podacima registruje dan bez uplate,
			tako da on ipak ulazi u statistiku, odnosno aplikacija ga u svojim kalkulacijama neće ignorisati kao nepostojeći.</p>
		</div>
	</div>
	
</body>
</html>