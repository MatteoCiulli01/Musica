<?php
	include('ConnectDB.php');
	class Lezione
	{
		protected $db;
		public $_id;
		public $_data_ora;
		public $_id_utente;
		public $_id_insegnante;

		public function __construct()
		{
			$this->db = new DBConnection(); //crea la connessione da ConnectDB.php
			$this->db = $this->db->returnConnection();
		}

		// getAll 
		public function getAllUser($username)
		{
			try
			{
				$sql = "SELECT L.id_lezione, L.data_ora, I.nome AS NomeInsegnante, I.cognome AS CognomeInsegnante FROM lezioni L INNER JOIN insegnanti I INNER JOIN utenti U ON L.id_utente = U.id_utente AND L.id_insegnante = I.id_insegnante WHERE U.username = :username";
				$stmt = $this-> db->prepare($sql);
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
		
        /*
        //insert
		public function insert()
		{
			try
			{
 				$sql = 'INSERT INTO canzoni (titolo, durata, anno, genere, url_canzone, cod_album)  VALUES (:titolo, :durata, :anno, :genere, :url_canzone, :cod_album)';
				$data = [
					'titolo' => $this->_titolo,
					'durata' => $this->_durata,
					'anno' => $this->_anno,
					'genere' => $this->_genere,
					'url_canzone' => $this->_url_canzone,
					'cod_album' => $this->_cod_album,
				];
				$stmt = $this->db->prepare($sql);
				$stmt->execute($data);
				$status = $stmt->rowCount();

				$id_canzone = $this->getLastId();
				$id_artista = $this->getIdArtista($id_canzone);

				$sql = 'INSERT INTO canzone_artista (cod_canzone, cod_artista) VALUES (:id_canzone, :id_artista)';
				$data = [
					'id_canzone' => $id_canzone,
					'id_artista' => $id_artista
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

		public function delete()
		{
			try
			{
				$status = 0;

				$sql = "DELETE FROM canzone_artista WHERE cod_canzone = :id";
				$stmt = $this->db->prepare($sql);
				$data = [
					'id' => $this->_id
				];
				$stmt->execute($data);
				$status += $stmt->rowCount();

				$sql = "DELETE FROM canzoni WHERE id_canzone = :id";
				$stmt = $this->db->prepare($sql);
				$data = [
					'id' => $this->_id
				];
				$stmt->execute($data);
				$status += $stmt->rowCount();

				return $status;
			}
			catch (Exception $e)
			{
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