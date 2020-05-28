<?php //DA ADATTARE I METODI ALLE CLASSI DEL DATABASE
	$requestMethod = $_SERVER["REQUEST_METHOD"];
	include('../class/Song.php');
	$song = new Song();
	switch($requestMethod)
	{
		case 'GET':
			$id = '';
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
			echo $js_encode;
			break;

		case 'GETNOTLOGGED':
			$id = '';
			if(isset($_GET['id']))
			{
				$id = $_GET['id'];
				$song->_id = $id;
				$data = $song->one(); //NON ANCORA IMPLEMENTATO
			}
			else
			{
				$data = $song->getLite();
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
			echo $js_encode;
			break;

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
			$newSong = json_decode(file_get_contents("php://input"),true);

			if(strcmp($newSong['Titolo'],"") != 0 && strcmp($newSong['Genere'],"") != 0 && strcmp($newSong['Anno'],"") != 0 && strcmp($newSong['Album'],"") != 0 && strcmp($newSong['Path'],"") != 0) //controlla che tutti i valori siano stati passati
			{
				$song->_titolo = $newSong['Titolo'];
				$song->_durata = 10;
				$song->_anno = $newSong['Anno'];
				$song->_genere = $newSong['Genere'];
				$song->_url_canzone = "../songs/" . $newSong['Path'];
				$song->_cod_album = $newSong['Album'];
				$data = $song->insert();

				if(is_numeric($data)) //solo se il messaggio è un valore numerico
				{
					$newFile = fopen($song->_url_canzone, "wb");
					fwrite($newFile, base64_decode($newSong['File']));
					fclose($newFile);
				}
			}
			else
			{
				echo "Inserisci tutti i dati";
			}
			break;

		/* DA IMPLEMENTARE
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