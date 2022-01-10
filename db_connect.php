<?php
	class Database{

	private $db_host = 'localhost';
	private $db_name = 'geoip';
	private $db_username = 'root';
	private $password = '';
	private $charset = 'utf8mb4';
	
	public $conn;
	
	public function connect(){
		$this->conn = null;
		 //test connection
		if($this->conn == null){

				try {
					$server_path = "mysql:host=".$this->getHostName().";dbname=".$this->getDatabaseName().";charset=".$this->getCharacterSet();
					$pdo_features = [
							    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
							    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
							    PDO::ATTR_EMULATE_PREPARES   => false,
							];
					$this->conn = new PDO($server_path,$this->getUserName(),$this->getPassword());
				    return $this->conn;
				} 
				catch (PDOException $e) {
					return $e->getMessage();
				}

	   
	   }
		
	}

	private function getHostName(){
		return $this->db_host;
	}

	private function getDatabaseName(){
		return $this->db_name;
	}

	private function getUserName(){
		return $this->db_username;
	}
	private function getPassword(){
		return $this->password;
	}

	private function getCharacterSet(){
		return $this->charset;
	}

	
	
}
