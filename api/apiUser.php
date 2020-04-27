<?php //DA ADATTARE I METODI ALLE CLASSI DEL DATABASE
	$requestMethod = $_SERVER["REQUEST_METHOD"];
	include('../class/User.php');
    $song = new Song();
    
	switch($requestMethod)
	{
        case 'MATCH':
        $User = json_decode(file_get_contents("php://input"),true);

        if(strcmp($User['username'],"") != 0 && strcmp($User['password'],"") != 0) //controlla che tutti i valori siano stati passati
        {
            $user->_username = $User['username'];
            $user->_password = $User['password'];

            $data = $student->insert();
            $js_encode = json_encode(array($data), true);

            header('Content-Type: application/json');
            echo $js_encode;
        }
        else
        {
            $js_encode = json_encode(array('status'=>FALSE, 'message'=>'Input studente non valido'), true);
            header('Content-Type: application/json');
            echo $js_encode;
        }
        break;

        default:
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}
?>