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
	<body onload="getMappe();" class="mainbody">
		<div class="page-container">
			<!-- start: PAGE HEADER-->
			<div class="page-header-wrapper">
				<div class="page-header" >
                    <a href="./indexUser.php"><img src="img/Musica.png" class="TitleIcon"></a>
                    
                    <?php
                        if(isset($_SESSION["user"])) //nel caso l'utente abbia effettuato il login
                        {
                            echo    '<a href="./pageLezioni.php" class="link linkLezioni"><img class="dropbtn" src="img/lesson.png">Lezioni</a>
                                    <a href="./pageLezioniUser.php" class="link linkLezioni"><img class="dropbtn" src="img/lessonuser.png">Le Tue Lezioni</a>';
                        }
                    ?>

					<div class="User">
						<?php
							if(isset($_SESSION["user"])) //nel caso l'utente abbia effettuato il login
							{
                                echo '<div id="username" class="usernameDisplay">' . $_SESSION["user"] . '</div>';
                                echo    '<img onclick="DropdownFunction()" class="dropbtn" src="img/Utente.png">
                                        <div id="Dropdown" class="dropdown-content">
                                            <img class="leftarrow" src="img/leftarrow.png" onclick="DropdownFunction()">
                                            <a href="indexUser.php">Home</a>
                                            <a href="pageLezioniUser.php">Le Tue Lezioni</a>
                                            <a href="pageLezioni.php?logout=true">Log Out</a>
                                        </div>';
							}
							else //nel caso l'utente non sia loggato
							{
                                echo    '<div class="loginAlert"><a href="LogIn.php">Effettua il login</a></div>
                                            <img onclick="DropdownFunction()" class="dropbtn" src="img/Utente.png">
                                            <div id="Dropdown" class="dropdown-content">
                                            <img class="leftarrow" src="img/leftarrow.png" onclick="DropdownFunction()">
                                            <a href="indexUser.php">Home</a>
                                            <a href="SignUp.php">Sign Up</a>
                                            <a href="LogIn.php">Log In</a>
                                        </div>';
							}

							if(isset($_GET["logout"])) //alla pressione del bottone di logout
							{
								session_destroy();
								header("Location: ./pageLezioni.php");
							}
						?>
					</div>

				</div>
			</div>
			<!-- end: PAGE HEADER-->

			<!-- start: PAGE CONTENT-->
			<div class="page-content-wrapper">
				<div class="page-content">
					<h2>Lezioni</h2>
					<div id="contentLezioni">
                        <!-- DOVE VERRANNO MOSTRATE LE MAPPE -->
                    </div>
                    <div id="contentLezioniALL" class="modulo">
                        <!-- DOVE VERRANNO MOSTRATE LE LEZIONI -->
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