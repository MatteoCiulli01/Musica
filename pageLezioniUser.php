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
	<body onload="getLezioniUser();" class="mainbody">
		<div class="page-container">
			<!-- start: PAGE HEADER-->
			<div class="page-header-wrapper">
				<div class="page-header" >
					<a href="./indexUser.php"><img src="img/Musica.png" class="TitleIcon"></a>
					<a href="./pageLezioni.php" class="link linkLezioni"><img class="dropbtn" src="img/lesson.png">Lezioni</a>
					<a href="./pageLezioniUser.php" class="link linkLezioni"><img class="dropbtn" src="img/lessonuser.png">Le Tue Lezioni</a>
					<div class="User">
						<?php
							if(isset($_SESSION["user"])) //nel caso l'utente abbia effettuato il login
							{
								echo '<div id="username" class="usernameDisplay">' . $_SESSION["user"] . '</div>';
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
						<img onclick="DropdownFunction()" class="dropbtn" src="img/Utente.png">
						<div id="Dropdown" class="dropdown-content">
							<img class="leftarrow" src="img/leftarrow.png" onclick="DropdownFunction()">
							<a href="indexUser.php">Home</a>
							<a href="indexUser.php?logout=true">Log Out</a>
						</div>
					</div>

				</div>
			</div>
			<!-- end: PAGE HEADER-->

			<!-- start: PAGE CONTENT-->
			<div class="page-content-wrapper">
				<div class="page-content">
					<div id="titoloLezioniUser">
						<h2>Le Tue Lezioni<img id="addLezioniBtn" src="./img/addbtn.png" onclick="showAddLezione();"></img></h2>
					</div>
					<div id="contentLezioni"></div>
					<div id="addLessonPanel" class="modulo">
						<form method="post">
							<h2>Pianifica lezione</h2>
							<div id="LezEnterInsegnante">
								<label>Insegnante</label>
								<select id="LezInsegnante" onchange="getInsegnantiMap(); checkifLessonAvailable()">
								</select>
							</div>
							<div id="LezEnterDataOra">
								<label>Data e ora</label>
								<input onchange="checkifLessonAvailable()" type="datetime-local" id="LezDate" name = "datetime" class="form-control" placeholder="Data e ora" required>
							</div>
							<div id="LezLuogo">
								<iframe id="LezMappa" src="" width="100%" height="350px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
							</div>
						</form>
						<div class="add-btn">
							<button class="btn btn-primary" name="Aggiungi" onclick="addLezione()">Aggiungi</button>
							<button class="btn btn-secondary" name="Annulla" onclick="showAddLezione()">Annulla</button>
						</div>
						<div id="LezStatus" class="status"></div>
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