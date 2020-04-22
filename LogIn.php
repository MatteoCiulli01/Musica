<!DOCTYPE html>                                 
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/SignUp.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body style="background-color:#121212; ">
        <div id="allbox">
				<div class="page-header">
					<a href="index.html"><img src="img/Musica.jpeg" style="width:50px; height:50px"></a>
				</div>
			<div id="modulo">
				<form method="post" >
                    <h2>Log In</h2>
                    <div id="eMail">
                        <label>Indirizzo eMail</label>
                        <input name="eMail" class="form-control" id="eMail" placeholder="inserisci qui il tuo indirizzo eMail"	required>
                    </div>
                    <div id="Password">
                        <label >Password</label>
                        <input name = "Password" type="password" class="form-control" id="Password"	placeholder="inserisci qui la tua password"	required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="Conferma" >Log in</button>
                    <button type ="reset" class="btn" name="Annulla" >Annulla</button>
                </form>
                <?php
                    if(array_key_exists("Conferma",$_POST))
                    {
                        $email = $_POST["eMail"];
                        $password = $_POST["Password"];
                    }
                ?>
			</div>
    </body>
</html>
