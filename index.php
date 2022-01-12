<?php
	

	//Méthode Fonctionnelle mais trop lente pour 3Million de
	require_once"db_connect.php";

	$db = new Database();
    $db_conn = $db->getConnexion();

    $fileName = "geoip.csv";
	ini_set('memory_limit', '-1');

    if (($handle = fopen($fileName, "r")) !== FALSE) {
		
		$time_pre = microtime(true);
        echo("Importation en cours ...");
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