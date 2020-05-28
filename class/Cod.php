<?php
    include('ConnectDB.php');
    class Cod
	{
        protected $db;
        public function __construct()
		{
			$this->db = new DBConnection(); //crea la connessione da ConnectDB.php
			$this->db = $this->db->returnConnection();
        }
        
        public function confirm($username)
        {
            $sql = "UPDATE credenziali C INNER JOIN utenti U ON C.id_credenziali = U.cod_credenziali SET U.confirmed = 1 WHERE C.username= :username";
            $data = [
                'username' => $username
            ];
            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
        }

        public function matchCode()
		{
			$sql = "SELECT U.confirm_code,C.username FROM utenti U INNER JOIN credenziali C WHERE U.confirm_code = :confirm_code and C.username = :username";
			$data = [
                'confirm_code' => $this->_confirm_code,
                'username'=> $this->_username
			];
			$stmt = $this->db->prepare($sql);
			$stmt->execute($data);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            $username = $data["username"];
            $d = $data["confirm_code"];
            $r = $result['confirm_code'] ?? 'default value';
           
            if($d == $r)
            {
                $this->confirm($username);
                return true;
            }
            else
            {
                echo "errore match";
            }
        }
    }
?>