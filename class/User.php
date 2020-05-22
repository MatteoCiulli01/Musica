<?php
	include('ConnectDB.php');
	class User
	{
		protected $db;
		public $_email;
		public $_sesso;
		public $_admin;

		public $_username;
		public $_password;

		public function __construct()
		{
			$this->db = new DBConnection(); //crea la connessione da ConnectDB.php
			$this->db = $this->db->returnConnection();
		}

		//get delle credenziali con username
		public function getCredenziali($username)
		{
			try
			{
				$sql = 'SELECT id_credenziali FROM credenziali WHERE username = :username';
				$data = [
					'username' => $this->_username
				];
				$stmt = $this->db->prepare($sql);
				$result = $stmt->fetch(\PDO::FETCH_ASSOC);
				return $result["id_credenziali"];

			} catch (Exception $e)
			{
				die("Oh noes! There's an error in the query! ".$e);
			}
		}

		//check dell'esistenza di una mail (0 se inesistente e output della email se esistente)
		public function checkEmail($email)
		{
			try
			{
				$sql = 'SELECT email FROM utenti WHERE email = :email';
				$data = [
					'email' => $email
				];
				$stmt = $this->db->prepare($sql);
				$stmt->execute($data);
				$result = $stmt->fetch(\PDO::FETCH_ASSOC);
				return $result;

			} catch (Exception $e)
			{
				die("Oh noes! There's an error in the query! ".$e);
			}
		}

		//insert
		public function insert()
		{
			try
			{
				if($this->getCredenziali($this->_username)==null && $this->checkEmail($this->_email)==0) //se non esiste un utente con lo stesso username o con la stessa email
				{
					$sql = 'INSERT INTO credenziali (username, password)  VALUES (:username, :password)';
					$data = [
						'username' => $this->_username,
						'password' => $this->_password
					];
					$stmt = $this->db->prepare($sql);
					$stmt->execute($data);
					$status = $stmt->rowCount();

					$cod_credenziali = $this->getCredenziali($this->_username);

					$sql = 'INSERT INTO utenti (email, sesso, admin, cod_credenziali)  VALUES (:email, :sesso, :admin, :cod_credenziali)';
					$data = [
						'email' => $this->_email,
						'sesso' => $this->_sesso,
						'admin' => $this->_admin,
						'cod_credenziali' => $cod_credenziali
					];
					$stmt = $this->db->prepare($sql);
					$stmt->execute($data);
					$status = $stmt->rowCount();
					return $status;
				}
				else
				{
					echo "Account già esistente";
				}

			} catch (Exception $e)
			{
				echo "Oh noes! There's an error in the query! ".$e;
			}

		}

		//UserMatch
		public function match()
		{
			try
			{
				$sql = "SELECT admin FROM utenti U INNER JOIN credenziali C ON C.id_credenziali = U.cod_credenziali WHERE C.username = :username AND C.password = :password";
				$data = [
					'username' => $this->_username,
					'password' => $this->_password
				];
				$stmt = $this->db->prepare($sql);
				$stmt->execute($data);
				$result = $stmt->fetch(\PDO::FETCH_ASSOC);
				return $result;
			}
			catch (Exception $e)
			{
				echo "Oh noes! There's an error in the query! ".$e;
			}
		}

		/* getAll 
		public function getAll()
		{
			try
			{
				$sql = "SELECT C.titolo, C.genere, C.anno, A.nome AS Nome_Artista, Album.nome AS Nome_Album, C.url_canzone FROM Canzoni C INNER JOIN Artisti A INNER JOIN Canzone_Artista CA INNER JOIN Album ON C.id_canzone = CA.cod_canzone AND A.id_artista = CA.cod_artista AND CA.cod_artista = Album.cod_artista";
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

		public function delete()
		{
			try
			{
				$sql = "DELETE FROM student_class WHERE id_student=:id";
				$stmt = $this->db->prepare($sql);
				$data = [
					'id' => $this->_id
				];
				$stmt->execute($data);
				$status = $stmt->rowCount();

				$sql = "DELETE FROM student WHERE id=:id";
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