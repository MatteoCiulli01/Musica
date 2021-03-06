<!DOCTYPE html>                  
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="./script/script.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body class="mainbody">
        <div id="allbox">
				<div class="page-header">
					<a href="index.html"><img src="img/Musica.png" class="TitleIcon"></a>
				</div>
			<div class="modulo" id="modulo_signup">
				<form id="signup" method="post">
                        <h2>Modulo di iscrizione</h2>
						<label >Username</label>
						<input id="Username" name ="Username" type="text" class="form-control"	placeholder="Username"	required>
                        
                        <label>Indirizzo email</label>
                        <input id="eMail" name="eMail" type="text" class="form-control" placeholder="Indirizzo email"	required>

						<label >Password</label>
						<input id="Password" value= "" name = "Password" type="password" class="form-control" placeholder="Password" required>

                        <div id="Sesso" required>
							<label>Sesso</label><br>
							<input type="radio" name="gender" value="male" > Maschio
							<input type="radio" name="gender" value="female"> Femmina
							<input type="radio" name="gender" value="other"> Altro
                        </div>
                        
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="terms" required>
                            <label class="form-check-label" for="terms"><small>Accetto <a href="index.html"><b>Termini e condizioni</b></a> e <a href="index.html"><b>Informativa sulla privacy Audioneer</b></a>.</small></label>
                        </div></br>
                        
                        <div class="g-recaptcha" data-sitekey="6LfdnewUAAAAAOHpq6TWzzJ5Q5wzPsYCHubWXmj8"></div></br>
                </form>
                <div class="signup-btn">
                    <button id="signupBtn" type="submit" class="btn btn-primary" name="Conferma" onclick="setUtente()">Conferma</button>
                    <button type="reset" class="btn" name="Annulla" onclick="history.back()">Annulla</button>
                </div>

                </br></br><div><p align="center">Hai già un account? <a href="LogIn.php"><b>Esegui il log in</b></a></p></div>
        
                <div id="SignUpStatus" class="status">
                <!--dove verranno visualizzate le risposte delle richieste xhr-->
                </div>

            </div>
        </div>

                <div id="attEmail" style="display:none">
                <p>Registrazione eseguita, controlla la tua casella mail e inserirsci il codice di conferma:</p>
                <input type="text" id="confCod" maxlength="6" size="6"></input>
                <button class="btn btn-primary" type="button" name="conf" id="conf" onclick="controlloCod()">Conferma</button>
                <p id="error"></p>
                </div>

                <div id="check" style="display:none"> <!-- div che verrà mostrato a video solo dopo la registrazione per un certo periodo di tempo, serve per far capire all'utente che l'account è stato creato con successo-->
                <p><h1>L'account è stato registrato correttamente con l'username</h1></p>
                <p id="us"></p><p>Verrai reindirizzato a una pagina di login tra :</p>
                <p id="countdown"></p>
                </div>

    </body>
</html>

<?php
    include("api/apiUser.php");
    session_start();
?> 