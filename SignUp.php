<!DOCTYPE html>                  
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/SignUp.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="./script/script.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body style="background-color:#121212; ">
        <div id="allbox">
				<div class="page-header">
					<a href="index.html"><img src="img/Musica.jpeg" style="width:50px; height:50px"></a>
				</div>
			<div id="modulo">
				<form id="signup" method="post">
                        <h2>Modulo di iscrizione</h2>
						<label >Username</label>
						<input id="Username" value= "<?php if(isset($_SESSION["Username"])== true){ echo $_SESSION["Username"]; }?>" name = "Username" type="text" class="form-control"	placeholder="Username"	required>
                        
                        <label>Indirizzo email</label>
                        <input id="eMail" value= "<?php if(isset($_SESSION["eMail"])== true){ echo $_SESSION["eMail"]; }?>" name="eMail" type="text" class="form-control" placeholder="Indirizzo email"	required>

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
                            <label class="form-check-label" for="terms"><small>Accetto <a href="index.html"><b>Termini e condizioni</b></a> e <a href="index.html"><b>Informativa sulla privacy Musica</b></a>.</small></label>
                        </div></br>
                        
                        <div class="g-recaptcha" data-sitekey="6LfdnewUAAAAAOHpq6TWzzJ5Q5wzPsYCHubWXmj8"></div></br>

						<button type="submit" class="btn btn-primary" name="Conferma" onclick="setUtente()">Conferma</button>
						<button type="reset" class="btn" name="Annulla" onclick="history.back()">Annulla</button>

                        </br></br><div><p align="center">Hai già un account? <a href="LogIn.php"><b>Esegui il log in</b></a></p></div>
				</form>
			</div>
        </div>
    </body>
</html>

<?php
    include("api/apiUser.php");
    session_start();

    if(isset($_POST['Conferma']))
    {
        header("Location: LogIn.php");
    }
?> 