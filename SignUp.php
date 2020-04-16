<!DOCTYPE html>
<?php 
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
?>                                      
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/SignUp.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body style="background-color:#121212; ">
    <?php
        if(array_key_exists('Conferma', $_POST))
        {
            $_SESSION["Cognome"] = $_POST["Surname"];
            $_SESSION["Nome"] = $_POST["Name"];
            $_SESSION["Sesso"] = $_POST["gender"];
            $_SESSION["eMail"] = $_POST["eMail"] ;
            $_SESSION["Password"] = md5($_POST["Password"]);
            $_SESSION["ShowAllBox"] = true;
            $_SESSION["ShowRisultato"] = false;
        }
    ?>
        <div id="allbox" <?php if ($_SESSION["ShowAllBox"]==true){?>style="display:none"<?php } ?>>
				<div class="page-header">
					<a href="index.html"><img src="img/Musica.jpeg" style="width:50px; height:50px"></a>
				</div>
			<div id="modulo">
				<form method="post" >
						<h2>Modulo di iscrizione</h2>
						<div id="Cognome">
						<label >Cognome</label>
							<input value= "<?php if(isset($_SESSION["Cognome"])== true){ echo $_SESSION["Cognome"]; }?>" type="Surname" class="form-control" name="Surname" placeholder="inserisci qui il tuo cognome" required>
						</div>
						<div id="Nome">
							<label>Nome</label>
							<input value= "<?php if(isset($_SESSION["Nome"])== true){echo $_SESSION["Nome"];} ?>" type="Name" class="form-control" name="Name" placeholder="inserisci qui il tuo nome"	required>
						</div>
						<div id="Sesso">
							<label>Sesso</label><br>
							<input type="radio" name="gender" value="male" > Maschio
							<input type="radio" name="gender" value="female"> Femmina
							<input type="radio" name="gender" value="other"> Altro
						</div>
						<div id="eMail">
							<label>Indirizzo eMail</label>
							<input value= "<?php if(isset($_SESSION["eMail"])== true){echo $_SESSION["eMail"];} ?>" name="eMail" class="form-control" id="eMail" placeholder="inserisci qui il tuo indirizzo eMail"	required>
						</div>
						<div id="Password">
						<label >Password</label>
						<input name = "Password" type="password" class="form-control" id="Password"	placeholder="inserisci qui la tua password"	required>
						</div>
						<button type="submit" class="btn btn-primary" name="Conferma" >Conferma</button>
						<button type ="reset" class="btn" name="Annulla" >Annulla</button>
				</form>
			</div>
        </div>
        <div id="Risultato" <?php if ($_SESSION["ShowRisultato"]==true){?>style="display:none"<?php } ?>>
            <form method="post">
                <div id="Cognome">
                    <label>Cognome:     <?php echo $_SESSION["Cognome"]; ?> </label>
                </div>
                <div id="Nome">
                    <label>Nome:     <?php echo $_SESSION["Nome"]; ?> </label>
                </div>
                <div id="Sesso">
                    <label>Sesso:     <?php echo $_SESSION["Sesso"]; ?> </label>
                </div>
                <div id="eMail">
                    <label>eMail:     <?php echo $_SESSION["eMail"]; ?> </label>
                </div>
                <button type="Submit" name="Registra">Registra</button>
                <button type="Submit" name="Correggi" >Correggi</button>
            </form>
            <?php 
                if(array_key_exists("Correggi",$_POST))
                {
                    $_SESSION["ShowAllBox"] = false;
                    $_SESSION["ShowRisultato"] = true;
                }
            ?>
        </div>
    </body>
</html>
