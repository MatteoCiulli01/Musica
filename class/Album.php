<?php
	include('ConnectDB.php');
	class Album
	{
		protected $db;
		public $_id;
        public $_nome;
        public $_genere;
		public $_anno;
		public $_url_cover;
		public $_cod_artista;

		public function __construct()
		{
			$this->db = new DBConnection(); //crea la connessione da ConnectDB.php
			$this->db = $this->db->returnConnection();
		}
		
		//insert
		public function insert()
		{
			try
			{
				$sql = 'INSERT INTO album (nome, genere, anno, url_cover, cod_artista)  VALUES (:nome, :genere, :anno, :url_cover, :cod_artista)';
				$data = [
					'nome' => $this->_nome,
					'genere' => $this->_genere,
					'anno' => $this->_anno,
					'url_cover' => $this->_url_cover,
					'cod_artista' => $this->_cod_artista
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

        public function getDropdown()
		{
			try
			{
				$sql = "SELECT album.id_album, album.nome AS nomeAlbum, artisti.nome AS nomeArtista FROM album INNER JOIN artisti ON album.cod_artista = artisti.id_artista";
				$stmt = $this-> db->prepare($sql);

				$stmt->execute();
				$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
				return $result;
			}
			catch (Exception $e)
			{
				die("Query error! ".$e);
			}
        }

        
		// getAll 
		public function getAll()
		{
			try
			{
				$sql = "SELECT album.id_album, album.url_cover, album.nome, A.nome AS Nome_Artista, album.anno, album.genere FROM album INNER JOIN artisti A ON A.id_artista = album.cod_artista";
				$stmt = $this-> db->prepare($sql);

				$stmt->execute();
				$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
				return $result;
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

				$sql = "DELETE FROM canzone_artista WHERE cod_canzone IN (SELECT id_canzone FROM canzoni WHERE cod_album = :id)";
				$stmt = $this->db->prepare($sql);
				$data = [
					'id' => $this->_id
				];
				$stmt->execute($data);
				$status += $stmt->rowCount();

				$sql = "DELETE FROM album WHERE id_album = :id";
				$stmt = $this->db->prepare($sql);
				$data = [
					'id' => $this->_id
				];
				$stmt->execute($data);
				$status += $stmt->rowCount();

				$sql = "DELETE FROM canzoni WHERE cod_album = :id";
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
		
		/*
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