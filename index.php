<?php
class Database{

	private $db_host = 'localhost';
	private $db_name = 'geoip';
	private $db_username = 'root';
	private $pass_word = '';
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
		return $this->pass_word;
	}

	private function getCharacterSet(){
		return $this->charset;
	}
}


	$db = new Database();
	$db_conn = $db->connect();
    $fileName = "geoip.csv";
    $row = 1;
    if (($handle = fopen($fileName, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $num = count($data);
            $geoip_array = array();
            for ($c=0; $c < $num; $c++) {
                array_push($geoip_array, $data[$c]);
            }
            $sql = "INSERT INTO geoip (ip_from, ip_to, country_code, country_name, region_name, city_name, latitude, longitude) VALUES (" . array_values($geoip_array)[0] . ", " . array_values($geoip_array)[1] . ", '" . array_values($geoip_array)[2] . "', '" . array_values($geoip_array)[3] . "', '" . array_values($geoip_array)[4] . "', '" . array_values($geoip_array)[5] . "', " . array_values($geoip_array)[6] . ", " . array_values($geoip_array)[7] . ");";
            $result = $db_conn->prepare($sql);
            $result->execute();
        }
        fclose($handle);
    }
?>
            
            

