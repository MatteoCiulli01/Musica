<?php //DA ADATTARE I METODI ALLE CLASSI DEL DATABASE
	$requestMethod = $_SERVER["REQUEST_METHOD"];
	include(__DIR__ . '/../class/Lesson.php');
	$lesson = new Lesson();
	switch($requestMethod)
	{
		case 'GETLEZ':
			$map = json_decode(file_get_contents("php://input"),true);
			$url = $map["map"];

            $data = $lesson->getAll($url);
            
			if(!empty($data))
			{
				$js_encode = json_encode($data, true);
			}
			else
			{
				$js_encode = "";
			}
			header('Content-Type: application/json');
			echo $js_encode;
			break;

		case 'GETMAPS':
			$data = $lesson->getMaps();
			
			if(!empty($data))
			{
				$js_encode = json_encode($data, true);
			}
			else
			{
				$js_encode = "";
			}
			header('Content-Type: application/json');
			echo $js_encode;
			break;

		case 'GETUSER':
            $data = $lesson->getAllUser($_GET["user"]);
            
			if(!empty($data))
			{
				$js_encode = json_encode($data, true);
			}
			else
			{
				$js_encode = "";
			}
			header('Content-Type: application/json');
			echo $js_encode;
			break;
			
			case 'GETDROPINS':
				$data = $lesson->getDropdownInsegnanti();
				
				if(!empty($data))
				{
					$js_encode = json_encode($data, true);
				}
				else
				{
					$js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet.'), true);
				}
				header('Content-Type: application/json');
				echo $js_encode;
				break;

			case 'CHECKINS':
				$data = $lesson->checkifAvailable($_GET['ins'], $_GET['date']);
				
				if(!empty($data))
				{
					$js_encode = json_encode($data, true);
				}
				else
				{
					$js_encode = "";
				}
				header('Content-Type: application/json');
				echo $js_encode;
				break;

			case 'GETINSMAPPA':
				$data = $lesson->getInsMappa($_GET['ins']);
				
				if(!empty($data))
				{
					$js_encode = json_encode($data, true);
				}
				else
				{
					$js_encode = "";
				}
				header('Content-Type: application/json');
				echo $js_encode;
				break;

			case 'POST':
				$newLesson = json_decode(file_get_contents("php://input"),true);
	
				if(strcmp($newLesson['Username'],"") != 0 && strcmp($newLesson['DataOra'],"") != 0 && strcmp($newLesson['Insegnante'],"") != 0) //controlla che tutti i valori siano stati passati
				{
					$lesson->_id_utente = $newLesson['Username'];
					$lesson->_data_ora = $newLesson['DataOra'];
					$lesson->_id_insegnante = $newLesson['Insegnante'];
					$data = $lesson->insert();

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

			case 'DELETE':
				$id = $_GET['id'];
				$lesson->_id = $id;
				$data = $lesson->delete();
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
            
        /* DA IMPLEMENTARE

		case 'DELETE':
			$id = $_GET['id'];
			$song->_id = $id;
			$data = $song->delete();
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
		
		case 'POST':
			$newLesson = json_decode(file_get_contents("php://input"),true);

			if(strcmp($newLesson['Titolo'],"") != 0 && strcmp($newLesson['Genere'],"") != 0 && strcmp($newLesson['Anno'],"") != 0 && strcmp($newLesson['Album'],"") != 0 && strcmp($newLesson['Path'],"") != 0) //controlla che tutti i valori siano stati passati
			{
				$song->_titolo = $newLesson['Titolo'];
				$song->_durata = 10;
				$song->_anno = $newLesson['Anno'];
				$song->_genere = $newLesson['Genere'];
				$song->_url_canzone = "../songs/" . $newLesson['Path'];
				$song->_cod_album = $newLesson['Album'];
				$data = $song->insert();

				if(is_numeric($data)) //solo se il messaggio è un valore numerico
				{
					$newFile = fopen($song->_url_canzone, "wb");
					fwrite($newFile, base64_decode($newLesson['File']));
					fclose($newFile);
				}
			}
			else
			{
				echo "Inserisci tutti i dati";
			}
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
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}
?>