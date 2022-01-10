<?php
	

	//Méthode Fonctionnelle mais trop lente pour 3Million de
	require_once"db_connect.php";
	$db = new Database();
	$db_conn = $db->connect();
    $fileName = "geoip.csv";
	ini_set('memory_limit', '-1');

    if (($handle = fopen($fileName, "r")) !== FALSE) {
		echo("Importation en cours ...");
		$time_pre = microtime(true);
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
		$time_post = microtime(true);
		$exec_time = $time_post - $time_pre;
        fclose($handle);
		echo'Importation terminée en ' . $exec_time;
    }
	
	


	//Test Code Yohann
			//$conn = mysqli_connect("localhost", "root", "", "geoip");
    		//$row = 1;
			//$query = "LOAD DATA INFILE 'geoip.csv' INTO TABLE geoip FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\n' (ip_from, ip_to, country_code, country_name, region_name, city_name, latitude, longitude);";
			//if (!mysqli_query($conn, $query)) {
    		//printf("Errormessage: %s\n", mysqli_error($conn));
			//}

	//Test code yann
			//$connectionString = 'mysql:host=127.0.0.1;dbname=geoip;charset=utf8';
			//$username = 'root';
			//$password = '';
			//ini_set('memory_limit', '-1');
			//try {
			//	$mysqlConnection = new PDO($connectionString, $username, $password,
			//		array(
			//			PDO::MYSQL_ATTR_LOCAL_INFILE => true,
			//			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			//			PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL
			//		));
			//} catch (\PDOException $e) {
			//	throw $e;
			//}
			//
			//function csvToDatabaseImport(PDO $mysqlConnection): void
			//{
			//	try {
			//		$prepareStatement = $mysqlConnection->prepare("LOAD DATA LOCAL INFILE ? INTO TABLE geoip FIELDS TERMINATED BY ? OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY ? (id, ip_from, ip_to, country_code, country_name, region_name, city_name, latitude, longitude) SET id = NULL");
			//		$prepareStatement->execute(array("geoip.csv", ",", "\n"));
			//		echo "Done !";
			//	} catch (\PDOException $e) {
			//		throw $e;
			//	}
			//}
			//
			//;
			//csvToDatabaseImport($mysqlConnection);
			//$mysqlConnection = null;
            
            

