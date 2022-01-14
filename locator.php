<?php
declare (strict_types = 1);
require_once('src/db_connect.php');



    function askIp(){
        $ipUser = readline('Entrez un adresse ip : ');
        return $ipUser;
    }

    function convertIpToDatabase($ipUser){
        return ip2long($ipUser); 
    }

    function geolocalisation(){
        $db = new Database();
        $connexion = $db->getConnexion();
        $ipUser = askIp();
        echo ("Ip de l'utilisateur : " . $ipUser . "\n");
        $ipConverted = convertIpToDatabase($ipUser);
        echo ("Ip convertie : " . $ipConverted . "\n");

        $sql = "select country_code,country_name,region_name,city_name,latitude,longitude FROM geoip where ". $ipConverted ." BETWEEN ip_from and ip_to;";
        $statement = $connexion->prepare($sql);
        $result = $statement->execute();
        // get all publishers
        $publishers = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($publishers) {
        	// show the publishers
        	foreach ($publishers as $publisher) {
        		echo ($publisher['country_code'] . " | ".$publisher['country_name'] . " | ".$publisher['region_name'] . " | ".$publisher['city_name'] . " | ".$publisher['latitude'] . " | ".$publisher['longitude'] . " | ". "\n");
        	}
        }
    }
   
    geolocalisation();