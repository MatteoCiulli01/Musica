<!DOCTYPE html>                      
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/SignUp.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="./script/script.js"></script>

        <?php
            include "api/apiUser.php";
        ?>
    </head>
    <body style="background-color:#121212; ">
        <div id="allbox">
            <div class="page-header">
                <a href="index.html"><img src="img/Musica.jpeg" style="width:50px; height:50px"></a>
            </div>
			<div id="modulo">
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
                <button id="login" class="btn btn-primary" name="Login" onclick="matchCredenziali()">Log in</button>
                </br></br><div><p align="center">Non possiedi un account? <a href="SignUp.php"><b>Registrati</b></a></p></div>
            </div>
            <div id="status">
                <!--dove verranno visualizzate le risposte delle richieste xhr-->
            </div>
    </body>
</html>