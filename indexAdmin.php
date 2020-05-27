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
	<body onload="getArtisti(); getCanzoni(); getAlbumDropdown();" class="mainbody" style="background-color:#121212; ">
		<div class="page-container">
			<!-- start: PAGE HEADER-->
			<div class="page-header-wrapper">
				<div class="page-header" >
					<a href=""><img src="img/Musica.png" class="TitleIcon"></a>
					<div class="User">
						<input onclick="DropdownFunction()" class="dropbtn adminLogo" type="image" src="img/admin.png"></input>
						<div id="Dropdown" class="dropdown-content">
							<a href="indexAdmin.php?logout=true">Log Out</a>
						</div>
						<?php
							if(isset($_SESSION["user"]) && $_SESSION["user"]=="admin") //nel caso l'utente abbia effettuato il login
							{
								echo '<div class="usernameDisplay">' . $_SESSION["user"] . '</div>';
							}
							else//nel caso l'utente non sia loggato come admin
							{
								header("Location: ./index.html");
								session_destroy();
							}

							if(isset($_GET["logout"])) //alla pressione del bottone di logout
							{
								session_destroy();
								header("Location: ./index.html");
							}
						?>
					</div>
				</div>
			</div>
			<!-- end: PAGE HEADER-->

			<!-- start: PAGE CONTENT-->
			<div class="page-content-wrapper">
				<div class="page-content">
					<h2>Artisti</h2>
					<div id="contentArtisti"></div>
					<br>
					<h2>Canzoni</h2>
					<div id="contentCanzoni"></div>
					<div id="addSongs">
						<img class="addBtn" src="./img/addbtn.png" onclick="showAddCanzone()"></img>
						<div id="addSongPanel" class="modulo">
							<form method="post">
								<h2>Aggiungi canzone</h2>
								<div id="EnterTitolo">
									<label>Titolo</label>
									<input id="Title" name="Title" class="form-control" placeholder="Titolo" required>
								</div>
								<div id="EnterGenere">
									<label>Genere</label>
									<input id="Genre" name = "Genre" class="form-control" placeholder="Genere" required>
								</div>
								<div id="EnterAnno">
									<label>Anno</label>
									<input id="Year" name = "Year" class="form-control" placeholder="Anno" required>
								</div>
								<div id="EnterFile">
									<label>File MP3</label>
									<input onchange="checkifMP3()" type="file" id="File" name = "mp3" class="form-control" placeholder="File" required>
								</div>
								<div id="EnterAlbum">
									<label>Album</label>
									<select id="Album" default="Seleziona Album">
									</select>
								</div>
							</form>
							<div class="add-btn">
								<button class="btn btn-primary" name="Aggiungi" onclick="addCanzone()">Aggiungi</button>
								<button class="btn btn-secondary" name="Annulla" onclick="hideAddCanzone()">Annulla</button>
							</div>
							<div id="status"></div>
						</div>
					</div>
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