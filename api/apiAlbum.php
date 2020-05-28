<?php //DA ADATTARE I METODI ALLE CLASSI DEL DATABASE
	$requestMethod = $_SERVER["REQUEST_METHOD"];
	include('../class/Album.php');
	$album = new Album();
	switch($requestMethod)
	{
        case 'GETDROPDOWN':

			$data = $album->getDropdown();
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

		case 'GET':
			$id = '';
			if(isset($_GET['id']))
			{
				$id = $_GET['id'];
				$album->_id = $id;
				$data = $album->one(); //NON ANCORA IMPLEMENTATO
			}
			else
			{
				$data = $album->getAll();
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
			$stud = json_decode(file_get_contents("php://input"),true);

			if(strcmp($stud['name'],"") != 0 && strcmp($stud['surname'],"") != 0 && strcmp($stud['sidi_code'],"") != 0 && strcmp($stud['tax_code'],"") != 0) //controlla che tutti i valori siano stati passati
			{
				$student->_name = $stud['name'];
				$student->_surname = $stud['surname'];
				$student->_sidiCode = $stud['sidi_code'];
				$student->_taxCode = $stud['tax_code'];

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