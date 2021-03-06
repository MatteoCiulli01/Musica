<!DOCTYPE html>                      
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="./script/script.js"></script>

        <?php
            include "api/apiUser.php";
        ?>
    </head>
    <body class="mainbody">
        <div id="allbox">
            <div class="page-header">
                <a href="index.html"><img src="img/Musica.png" class="TitleIcon"></a>
            </div>
			<div class="modulo" id="modulo_signup">
				<form method="match">
                    <h2>Log in</h2>
                    <div id="EnterUsername">
                        <label>Username</label>
                        <input id="Username" name="Username" class="form-control" placeholder="Username" required>
                    </div>
                    <div id="EnterPassword">
                        <label >Password</label>
                        <input id="Password" name = "Password" type="password" class="form-control"	placeholder="Password" required>
                    </div>
                </form>
                <div class="login-btn">
                    <button id="login" class="btn btn-primary" name="Login" onclick="matchCredenziali()">Log in</button>
                </div>
                </br></br><div><p align="center">Non possiedi un account? <a href="SignUp.php"><b>Registrati</b></a></p></div>
            </div>
            <div id="LogInStatus" class="status">
                <!--dove verranno visualizzate le risposte delle richieste xhr-->
            </div>
        </div>
            <div id="codErr" style="display:none">
                <p>Inserire il codice di conferma</p>
                <div class="DivErr">
                    <input type="text" id="confCoderr" maxlength="6" size="6"></input>
                    <button class="btn btn-primary" type="button" name="conf" id="confErr" onclick="modCod()">Conferma</button>
                </div>
                <p id="error2"></p>
            </div>

            <div id="check2" style="display:none"> <!-- div che verrà mostrato a video solo dopo la registrazione per un certo periodo di tempo, serve per far capire all'utente che l'account è stato creato con successo-->
                <p><h1>L'account è stato registrato correttamente con l'username</h1></p>
                <p id="us2"></p><p>Verrai reindirizzato a una pagina di login tra :</p>
                <p id="countdown"></p>
            </div>
    </body>
</html>