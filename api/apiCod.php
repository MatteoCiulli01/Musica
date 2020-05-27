<?php
	$requestMethod = $_SERVER["REQUEST_METHOD"];
	include('../class/Cod.php');
	$cd = new Cod();
        switch($requestMethod)
        {
            case 'MATCH':
            $obj=json_decode(file_get_contents("php://input"),true);
            $cod = $obj['confirm_code'];
            $us = $obj['username'];
            $cd->_confirm_code = $cod;
            $cd->_username = $us;
            $data = $cd->matchCode();
            $response = array("result"=>$data);
            echo json_encode($response);
            break;
            default:
                header("HTTP/1.0 405 Method Not Allowed in apiUser.php");
                break;
        }
    ?>
