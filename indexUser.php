<!DOCTYPE html>
<html lang="en" dir="ltr" class="sid-plesk">
	<head>
		<title>Musica</title>
		<meta name="copyright" content="Copyright 1999-2018. Plesk International GmbH. All rights reserved.">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<meta http-equiv="Cache-Control" content="no-cache">
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="stylesheet" href="css/style.css" type="text/css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		
		<script src="./script/script.js"></script>
		<script src="./script/indexScript.js"></script>

		<?php session_start();?>
	</head>
	<body onload="getCanzoni();" class="mainbody">
		<div class="page-container">
			<!-- start: PAGE HEADER-->
			<div class="page-header-wrapper">
				<div class="page-header" >
					<a href=""><img src="img/Musica.png" class="TitleIcon"></a>
					<div class="User">
						<?php
							if(isset($_SESSION["user"])) //nel caso l'utente abbia effettuato il login
							{
								echo '<div class="usernameDisplay">' . $_SESSION["user"] . '</div>';
							}
							else //nel caso l'utente non sia loggato
							{
								session_destroy();
								header("Location: ./index.html");
							}

							if(isset($_GET["logout"])) //alla pressione del bottone di logout
							{
								session_destroy();
								header("Location: ./index.html");
							}
						?>
						<input onclick="DropdownFunction()" class="dropbtn" type="image" src="img/Utente.png" ></input>
						<div id="Dropdown" class="dropdown-content">
							<a href="indexUser.php?logout=true">Log Out</a>
						</div>
					</div>

				</div>
			</div>
			<!-- end: PAGE HEADER-->

			<!-- start: PAGE CONTENT-->
			<div class="page-content-wrapper">
				<div class="page-content">
					<!--<h2>Artisti</h2>
					<div id="contentArtisti"></div>
					<br>-->
					<h2>Canzoni</h2>
					<div id="contentCanzoni"></div>
				</div>
			</div>
			<!-- end: PAGE CONTENT-->

			<!-- start: PAGE FOOTER-->
			<div class="page-footer-wrapper">
				<div class="page-footer">
					Sito creato da Matteo Ciulli, Jacopo Famà, Lorenzo Lombardi e Mauro Lapio. 2020
				</div>
			</div>
			<!-- end: PAGE FOOTER-->
		</div>
	</body>
</html>