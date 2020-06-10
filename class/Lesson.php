<?php
	include('ConnectDB.php');
	class Lesson
	{
		protected $db;
		public $_id;
		public $_data_ora;
		public $_via;
		public $_civico;
		public $_cap;
		public $_citta;
		public $_url_mappa;
		public $_id_utente;
		public $_id_insegnante;

		public function __construct()
		{
			$this->db = new DBConnection(); //crea la connessione da ConnectDB.php
			$this->db = $this->db->returnConnection();
		}

		// getAllUser
		public function getAll($url_map)
		{
			try
			{
				$sql = "SELECT YEAR(L.data_ora) anno, MONTH(L.data_ora) mese, I.nome nome_insegnante, I.cognome cognome_insegnante, I.strumento, COUNT(DISTINCT L.id_utente) utenti FROM lezioni L INNER JOIN insegnanti I INNER JOIN scuole S INNER JOIN insegnante_scuola INSC ON L.id_insegnante = I.id_insegnante AND S.id_scuola = INSC.id_scuola AND I.id_insegnante = INSC.id_insegnante
						WHERE S.url_mappa = :map
						GROUP BY S.url_mappa, I.id_insegnante, anno, mese";
				$stmt = $this->db->prepare($sql);
                $data = [
					'map' => $url_map
				];
				$stmt->execute($data);
				$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
				return $result;
			}
			catch (Exception $e)
			{
				die("Query error! ".$e);
			}
		}

		public function getMaps()
		{
			try
			{
				$sql = "SELECT DISTINCT url_mappa FROM scuole";
				$stmt = $this->db->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
				return $result;
			}
			catch (Exception $e)
			{
				die("Query error! ".$e);
			}
		}

		// getAllUser
		public function getAllUser($username)
		{
			try
			{
				$sql = "SELECT L.id_lezione, L.data_ora, I.nome AS NomeInsegnante, I.cognome AS CognomeInsegnante, I.strumento, S.url_mappa FROM lezioni L INNER JOIN insegnanti I INNER JOIN utenti U INNER JOIN credenziali C INNER JOIN scuole S INNER JOIN insegnante_scuola INSC ON L.id_utente = U.id_utente AND L.id_insegnante = I.id_insegnante AND U.cod_credenziali = C.id_credenziali AND S.id_scuola = INSC.id_scuola AND I.id_insegnante = INSC.id_insegnante WHERE C.username = :username";
				$stmt = $this->db->prepare($sql);
                $data = [
					'username' => $username
				];
				$stmt->execute($data);
				$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
				return $result;
			}
			catch (Exception $e)
			{
				die("Query error! ".$e);
			}
		}

		public function getDropdownInsegnanti()
		{
			try
			{
				$sql = "SELECT id_insegnante, nome AS nomeInsegnante, cognome AS cognomeInsegnante, strumento FROM insegnanti";
				$stmt = $this->db->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
				return $result;
			}
			catch (Exception $e)
			{
				die("Query error! ".$e);
			}
		}

		public function checkifAvailable($id_insegnante, $data_ora)
		{
			$giorno = substr($data_ora, 0, 10);
			$ora = substr($data_ora, 11,5) . ":00";

			$data_ora = $giorno . " " . $ora;
			try
			{
				$sql = "SELECT id_lezione FROM lezioni L INNER JOIN insegnanti I ON L.id_insegnante = I.id_insegnante WHERE I.id_insegnante = :id_insegnante AND DAY(L.data_ora) = DAY(:data_ora) AND L.data_ora BETWEEN DATE_SUB(:data_ora, INTERVAL 1 HOUR) AND DATE_ADD(:data_ora, INTERVAL 1 HOUR)";
				$stmt = $this->db->prepare($sql);
				$data = [
					'id_insegnante' => $id_insegnante,
					'data_ora' => $data_ora
				];
				$stmt->execute($data);
				$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
				return $result;
			}
			catch (Exception $e)
			{
				die("Query error! ".$e);
			}
		}

		public function getInsMappa($id_insegnante)
		{
			try
			{
				$sql = "SELECT S.url_mappa FROM insegnanti I INNER JOIN scuole S INNER JOIN insegnante_scuola INSC ON S.id_scuola = INSC.id_scuola AND I.id_insegnante = INSC.id_insegnante WHERE I.id_insegnante = :id_insegnante";
				$stmt = $this->db->prepare($sql);
				$data = [
					'id_insegnante' => $id_insegnante
				];
				$stmt->execute($data);
				$result = $stmt->fetch(\PDO::FETCH_ASSOC);
				return $result;
			}
			catch (Exception $e)
			{
				die("Query error! ".$e);
			}
		}

        //insert
		public function insert()
		{
			$this->_id_utente = $this->getUserFromName($this->_id_utente);

			try
			{
 				$sql = 'INSERT INTO lezioni (data_ora, id_utente, id_insegnante)  VALUES (:data_ora, :id_utente, :id_insegnante)';
				$data = [
					'data_ora' => $this->_data_ora,
					'id_utente' => $this->_id_utente,
					'id_insegnante' => $this->_id_insegnante,
				];
				$stmt = $this->db->prepare($sql);
				$stmt->execute($data);
				$status = $stmt->rowCount();
				return $status;

			} catch (Exception $e)
			{
				die("Oh noes! There's an error in the query! ".$e);
			}
		}

		public function getUserFromName($username)
		{
			try
			{
				$sql = "SELECT U.id_utente FROM utenti U INNER JOIN credenziali C ON U.cod_credenziali = C.id_credenziali WHERE C.username = :username";
				$stmt = $this->db->prepare($sql);
				$data = [
					'username' => $username
				];
				$stmt->execute($data);
				$result = $stmt->fetch(\PDO::FETCH_ASSOC);
				return $result["id_utente"];
			}
			catch (Exception $e)
			{
				die("Query error! ".$e);
			}
		}

		public function delete()
		{
			try
			{
				$status = 0;

				$sql = "DELETE FROM lezioni WHERE id_lezione = :id";
				$stmt = $this->db->prepare($sql);
				$data = [
					'id' => $this->_id
				];
				$stmt->execute($data);
				$status = $stmt->rowCount();

				return $status;
			}
			catch (Exception $e)
			{
				die("Oh noes! There's an error in the query! ".$e);
			}
		}

		/*
		public function getLastId()
		{
			try
			{
				$sql = "SELECT id_canzone FROM canzoni ORDER BY id_canzone DESC";
				$stmt = $this-> db->prepare($sql);

				$stmt->execute();
				$result = $stmt->fetch(\PDO::FETCH_ASSOC);
				return $result["id_canzone"];
			}
			catch (Exception $e)
			{
				die("Query error! ".$e);
			}
		}

		// getOne
		public function one() {
			try {
				$sql = "SELECT * FROM student WHERE id=:id";
				$stmt = $this->db->prepare($sql);
				$data = [
					'id' => $this->_id
				];
				$stmt->execute($data);
				$result = $stmt->fetch(\PDO::FETCH_ASSOC);
				return $result;
			} catch (Exception $e) {
				die("Oh noes! There's an error in the query! ".$e);
			}
		}

		public function getLast()
		{
			try
			{
				$sql = "SELECT * FROM student ORDER BY id DESC LIMIT 1";
				$stmt = $this->db->prepare($sql);
				$stmt->execute($data);
				$result = $stmt->fetch(\PDO::FETCH_ASSOC);
				return $result;
			}
			catch (Exception $e)
			{
				die("Oh noes! There's an error in the query! ".$e);
			}
		}

		public function patch()
		{
			try
			{
				$data = ['id' => $this->_id];
				$sql = 'UPDATE student SET ';

				foreach($this as $key => $value)
				{
					if($value != null && strcmp($key,'db')!=0 && strcmp($key,'id')!=0) //non inserisce la voce db e id nella query
					{
						$key = ltrim($key, "_");
						$sql = $sql . "$key=:$key,"; //statement come name=:name viene aggiunto alla query

						$data[$key] = $value; //statement come 'name' => $this->_name viene inserito all'interno dell'array $data per ogni valore passato;
					}
				}

				$sql = rtrim($sql,",");
				$sql = $sql . " WHERE id=:id";

				$stmt = $this->db->prepare($sql);
				$stmt->execute($data);
				$status = $stmt->rowCount();
				return $status;
			}
			catch (Exception $e)
			{
				die("Oh noes! There's an error in the query! ".$e);
			}
		}

		public function put()
		{
			try
			{
				$sql = 'UPDATE student SET name=:name, surname=:surname, sidi_code=:sidi_code, tax_code=:tax_code WHERE id=:id';

				$data = [
					'id' =>$this->_id,
					'name' => $this->_name,
					'surname' => $this->_surname,
					'sidi_code' => $this->_sidiCode,
					'tax_code' => $this->_taxCode
				];

				$stmt = $this->db->prepare($sql);
				$stmt->execute($data);
				$status = $stmt->rowCount();
				return $status;
			}
			catch (Exception $e)
			{
				die("Oh noes! There's an error in the query! ".$e);
			}
		}
		*/
	}
?>