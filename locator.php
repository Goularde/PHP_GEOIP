<?php
declare (strict_types = 1);
require_once('db_connect.php');



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
        echo ($result);
    }

   

    
    geolocalisation();