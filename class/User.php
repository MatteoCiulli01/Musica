<?php
	include('ConnectDB.php');
	require('src/PHPMailer.php');
	require('src/SMTP.php');
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
					'username' => $username
				];
				$stmt = $this->db->prepare($sql);
				$stmt->execute($data);
				$result = $stmt->fetch(\PDO::FETCH_ASSOC);
				return isset($result["id_credenziali"])? $result["id_credenziali"] : null;

			} catch (Exception $e)
			{
				die("Oh noes! There's an error in the query! ".$e);
			}
		}

		//check dell'esistenza di una mail (0 se inesistente e 1 se esistente)
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
		public function error()
		{
			return false;
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
					$confirm_code= rand(100000,999999);
					$sql = 'INSERT INTO utenti (email, sesso, admin, confirmed, confirm_code, cod_credenziali)  VALUES (:email, :sesso, :admin, :confirmed, :confirm_code, :cod_credenziali)';
					$data = [
						'email' => $this->_email,
						'sesso' => $this->_sesso,
						'admin' => $this->_admin,
						'confirmed'=> $this->_confirmed,
						'confirm_code'=> $confirm_code,
						'cod_credenziali' => $cod_credenziali
					];
					$stmt = $this->db->prepare($sql);
					$stmt->execute($data);
					$status = $stmt->rowCount();
					$mail = new PHPMailer\PHPMailer\PHPMailer();

					// Settings mail send
					$mail->SMTPSecure = "tls"; 
					$mail->IsSMTP();
					$mail->CharSet = 'UTF-8';

					$mail->SetFrom("audioneer.service@gmail.com");
					$mail->Host       = "smtp.gmail.com"; // SMTP server example
					$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
					$mail->SMTPAuth   = true;                  // enable SMTP authentication
					$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
					$mail->Username   = "audioneer.service@gmail.com"; // SMTP account username example
					$mail->Password   = "mezzemeleMusica2020";        // SMTP account password example
					$mail->AddAddress($this->_email,$this->_username);

					// Content
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = 'Verification code Audioneer';
					$mail->Body    = '<tbody><tr>
					<td style="font-family:Verdana,sans-serif;font-size:14px;vertical-align:top">&nbsp;</td>
					<td style="font-family:Verdana,sans-serif;font-size:14px;vertical-align:top;display:block;max-width:750px;padding:10px;width:750px;Margin:0 auto!important;width:auto!important">
					<div style="box-sizing:border-box;display:block;Margin:0 auto;max-width:750px;padding:10px">
						
					<table width="100%" style="border-collapse:separate;background:#fff;border-radius:0px;border-spacing:0px;width:100%">
						
						</table><table width="100%" style="border-collapse:separate;background:#fff;border-radius:0px;border-spacing:0px;width:100%">
						
						<tbody><tr>
							<td width="100%" style="font-family:Verdana,sans-serif;font-size:14px;vertical-align:top;box-sizing:border-box;padding:0px">
							<table border="0" cellpadding="5" cellspacing="0" width="100%" style="border-collapse:separate;width:100%;border-top:5px solid #696969;border-bottom:9px solid #696969">
								<tbody><tr>
								<td style="font-family:Verdana,sans-serif;font-size:14px;vertical-align:top">
								<img src="musica.ideeinbit.it/img/Musica.png" style="width:200px;height:50px;" alt="Logo">
								</td>
								</tr>
							</tbody></table>
							</td>
						</tr>
						
						</tbody></table>
						<table style="border-collapse:separate;background:#fff;border-radius:0px;width:100%;margin-bottom:30px;margin-top:10px">
						
						<tbody><tr>
							<td style="font-family:Verdana,sans-serif;font-size:14px;vertical-align:top;box-sizing:border-box;padding:20px">
							<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:separate;width:100%">
								<tbody><tr>
								<td style="vertical-align:top"><span class="im">
									<p style="margin-bottom:15px;list-style-type:disc">Ciao '.$this->_username.'</p><p style="margin-bottom:15px;list-style-type:disc"><br></p><p style="margin-bottom:15px;list-style-type:disc">Di seguito puoi trovare il codice di sicurezza per accedere al tuo account Audioneer:</p></span><b><p style="font-size:18px;margin-bottom:15px;list-style-type:disc">'.$confirm_code.'</p></b><span class="im"><p style="margin-bottom:15px;list-style-type:disc"><span style="background-color:transparent"><br></span></p><p style="margin-bottom:15px;list-style-type:disc">Utilizza il codice sopra per verificare la proprietà del tuo account.</p><p style="margin-bottom:15px;list-style-type:disc"><p style="margin-bottom:15px;list-style-type:disc"><span style="background-color:transparent"><br></span></p><b><p style="margin-bottom:15px;list-style-type:disc">Se invece non eri tu modifica la tua password per garantire la sicurezza del tuo account</p><p style="margin-bottom:15px;list-style-type:disc"><br></p><p style="margin-bottom:15px;list-style-type:disc"><span style="background-color:transparent">Grazie</span><br></p>
								</span></td>
								</tr>
							</tbody></table>
							</td>
						</tr>
						
						</tbody></table><div><div class="adm"><div id="q_1" class="ajR h4" aria-label="Mostra contenuti abbreviati" aria-expanded="false" data-tooltip="Mostra contenuti abbreviati"><div class="ajT"></div></div></div><div class="h5">
						</tbody></table>
						</div>
					</div></div></div>
					</td>
					<td style="font-family:Verdana,sans-serif;font-size:14px;vertical-align:top">&nbsp;</td>
					</tr>
					</tbody>';
					$mail->AltBody = 'Audioneer';
					$mail->send();
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
		public function ifConf($username)
		{
		$sql = 'SELECT U.confirmed FROM utenti U INNER JOIN credenziali C ON C.id_credenziali = U.cod_credenziali WHERE C.username = :username';
		$data2 = [
			'username' => $username
		];
		$stmt = $this->db->prepare($sql);
		$stmt->execute($data2);
		$result = $stmt->fetch(\PDO::FETCH_ASSOC);
		return isset($result["confirmed"])? $result["confirmed"] : null;
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