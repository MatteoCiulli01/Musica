<!DOCTYPE html>                                 
<html>
    <script>
        function matchCredenziali()
        {
            username = document.getElementById("Username").value;
            password = document.getElementById("Password").value;
            xhr = new XMLHttpRequest();
            xhr.open("MATCH", 'http://localhost:80/api/apiUser.php', true);
            xhr.onerror = function()
            { 
                alert('Errore');
            };
            xhr.send(
                JSON.stringify({
                    "username":username,
                    "password":password
                })
            );
        }
    </script>
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
                    <h2>Log in</h2>
                    <div id="username">
                        <label>Username</label>
                        <input name="Username" class="form-control" id="username" placeholder="Username"	required>
                    </div>
                    <div id="Password">
                        <label >Password</label>
                        <input name = "Password" type="password" class="form-control" id="Password"	placeholder="Password"	required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="Conferma" >Log in</button>
                    <button type ="reset" class="btn" name="Annulla" onclick="history.back()">Annulla</button>

                    </br></br><div><p align="center">Non possiedi un account? <a href="SignUp.php"><b>Registrati</b></a></p></div>
                </form>
                <?php
                    if(array_key_exists("Conferma",$_POST))
                    {
                        $username = $_POST["Usurname"];
                        $password = $_POST["Password"];
                    }
                ?>
			</div>
    </body>
</html>
