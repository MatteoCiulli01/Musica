<!DOCTYPE html>
<?php
    include('../class/User.php');
    session_start();
    if (empty($_SESSION["ShowRisultato"]))
	{
        $_SESSION["ShowRisultato"] = true;
    }
    if (empty($_SESSION["ShowAllBox"]))
	{
        $_SESSION["ShowAllBox"] = false;
    }
    if($_SESSION["ShowRisultato"] == true)
    {
        $_SESSION["ShowAllBox"] = false;
    }
    if($_SESSION["ShowAllBox"] == false)
    {
    	$_SESSION["ShowRisultato"] = true;
    }

    if(isset($_POST['Conferma']))
    {
        header("Location: LogIn.php");
        confirm(); //tentativo di insert utente DA FIXARE
    }

    function confirm()
    {
        $user = new User();
        $user->_username = $_POST["Username"];
        $user->_sesso = $_POST["Sesso"];
        $user->_email = $_POST["eMail"];
        $user->_password = $_POST["Password"];

        $user->_admin = 0;

        $user->insert();
    }
?>                                      
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/SignUp.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="script.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body style="background-color:#121212; ">
        <div id="allbox" <?php if ($_SESSION["ShowAllBox"]==true){?>style="display:none"<?php } ?>>
				<div class="page-header">
					<a href="index.html"><img src="img/Musica.jpeg" style="width:50px; height:50px"></a>
				</div>
			<div id="modulo">
				<form id="signup" method="post">
                        <h2>Modulo di iscrizione</h2>
                        <div id="Username">
						<label >Username</label>
						<input value= "<?php if(isset($_SESSION["Username"])== true){ echo $_SESSION["Username"]; }?>" name = "Username" type="text" class="form-control" id="Username"	placeholder="Username"	required>
                        </div>
                        
						<div id="eMail">
							<label>Indirizzo email</label>
							<input value= "<?php if(isset($_SESSION["eMail"])== true){ echo $_SESSION["eMail"]; }?>" name="eMail" type="text" class="form-control" id="eMail" placeholder="Indirizzo email"	required>
                        </div>

						<div id="Password">
						<label >Password</label>
						<input value= "" name = "Password" type="password" class="form-control" id="Password" placeholder="Password" required>
                        </div>

                        <div id="Sesso" required>
							<label>Sesso</label><br>
							<input type="radio" name="gender" value="male" > Maschio
							<input type="radio" name="gender" value="female"> Femmina
							<input type="radio" name="gender" value="other"> Altro
                        </div>
                        
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                            <label class="form-check-label" for="exampleCheck1"><small>Accetto <a href="index.html"><b>Termini e condizioni</b></a> e <a href="index.html"><b>Informativa sulla privacy Musica</b></a>.</small></label>
                        </div></br>
                        
                        <div class="g-recaptcha" data-sitekey="6LfdnewUAAAAAOHpq6TWzzJ5Q5wzPsYCHubWXmj8"></div></br>

						<button  type="submit" class="btn btn-primary" name="Conferma">Conferma</button>
						<button  class="btn" name="Annulla" onclick="history.back()">Annulla</button>

                        </br></br><div><p align="center">Hai già un account? <a href="LogIn.php"><b>Esegui il log in</b></a></p></div>
				</form>
			</div>
        </div>
    </body>
</html>