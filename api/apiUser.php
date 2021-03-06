<?php
    include(__DIR__ . '/../class/User.php');
    //DA ADATTARE I METODI ALLE CLASSI DEL DATABASE
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $user = new User();
        switch($requestMethod)
        {

            case 'GET':
                /*$id = '';
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];
                    $song->_id = $id;
                    $data = $song->one(); //NON ANCORA IMPLEMENTATO
                }
                else
                {
                    $data = $song->getAll();
                }
                if(!empty($data))
                {
                    $js_encode = json_encode($data, true);
                }
                else
                {
                    $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet.'), true);
                }
                header('Content-Type: application/json');
                echo $js_encode;*/
                break;
                
            case 'POST':
                $newUser = json_decode(file_get_contents("php://input"),true);

                if(strcmp($newUser['eMail'],"") != 0 && strcmp($newUser['Sesso'],"") != 0 && strcmp($newUser['Username'],"") != 0 && strcmp($newUser['Password'],"") != 0) //controlla che tutti i valori siano stati passati
                {
                    $user->_email = $newUser['eMail'];
                    $user->_sesso = $newUser['Sesso'];
                    $user->_admin = 0;
                    $user->_confirmed = 0;
                    $user->_username = $newUser['Username'];
					$user->_password = md5($newUser['Password']);
    
                    $data = $user->insert();

                    if(is_numeric($data)) //solo se il messaggio è un valore numerico
                    {
                        echo $data;
                    }
                }
                else
                {
                    echo "Inserisci tutti i dati";
                }
                break;
    
            case 'MATCH':
                $userToMatch = json_decode(file_get_contents("php://input"),true);

                if(strcmp($userToMatch['Username'],"") != 0 && strcmp($userToMatch['Password'],"") != 0) //controlla che tutti i valori siano stati passati
                {
                    $user->_username = $userToMatch['Username'];
                    $user->_password = md5($userToMatch['Password']);
                    $data = $user->match();
                    $check = $user->ifConf($userToMatch['Username']);
                    if($data == 0)
                    {
                        echo "Nome utente o password errati o account inesistente";
                    }
                    else
                    {
                        if($check == 0)
                        {
                            $data = $user->error();
                            $response = array("result"=>$data);
                            echo json_encode($response);
                        }
                        else
                        {
                            session_start();
                            $_SESSION["user"] = $userToMatch['Username'];
                            $js_encode = json_encode($data, true);
                            header('Content-Type: application/json');
                            echo $js_encode;
                        }
                    }
                }
                else
                {
                    echo "Nome utente o password errati o account inesistente";
                }
                break;
            /* DA IMPLEMENTARE
            case 'DELETE':
                $id = $_GET['id'];
                $student->_id = $id;
                $data = $student->delete();
                if(!empty($data))
                {
                    $js_encode = json_encode(array($data), true);
                }
                else
                {
                    $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet.'), true);
                }
                header('Content-Type: application/json');
                echo $js_encode;
                break;
    
            case 'PATCH':
                $stud = json_decode(file_get_contents("php://input"),true);
    
                if(strcmp($stud['id'], "")!=0) //controlla che l'id sia passato
                {
                    $student->_id = $stud['id'];
                    foreach($stud as $key => $value)
                    {
                        if(strcmp($value,"")!=0) //controlla che il valore sia passato
                        {
                            $student->{"_$key"} = $value; //$student->_name = Pippo
                        }
                    }
    
                    $data = $student->patch();
                    if(!empty($data))
                    {
                        $js_encode = json_encode(array($data), true);
                    }
                    else
                    {
                        $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet or data is the same as previous.'), true);
                    }
                    header('Content-Type: application/json');
                    echo $js_encode;
                }
                else //mancanza di id
                {
                    echo "PATCH studente non valido";
                }
                break;
    
            case 'PUT':
                $stud = json_decode(file_get_contents("php://input"),true);
    
                if(strcmp($stud['id'],"") != 0 && strcmp($stud['name'],"") != 0 && strcmp($stud['surname'],"") != 0 && strcmp($stud['sidi_code'],"") != 0 && strcmp($stud['tax_code'],"") != 0) //controlla che tutti i valori siano stati passati
                {
                    $student->_id = $stud['id'];
                    $student->_name = $stud['name'];
                    $student->_surname = $stud['surname'];
                    $student->_sidiCode = $stud['sidi_code'];
                    $student->_taxCode = $stud['tax_code'];
    
                    $data = $student->put();
                    if(!empty($data))
                    {
                        $js_encode = json_encode(array($data), true);
                    }
                    else
                    {
                        $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet or data is the same as previous.'), true);
                    }
    
                    header('Content-Type: application/json');
                    echo $js_encode;
                }
                else //mancanza di id
                {
                    echo "PUT studente non valido";
                }
                break;
                */
    
            default:
                header("HTTP/1.0 405 Method Not Allowed in apiUser.php");
                break;
        }
    ?>
