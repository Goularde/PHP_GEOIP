<?php

class Database{
    private $db;

    public function __construct(){
        $jsonResult = $this->readJSONConfig("dbconfig.json");
        $this->connection($jsonResult['host'], $jsonResult['databasename'], $jsonResult['user'], $jsonResult['password']);
    }

    private function readJSONConfig(string $sDBConfigFile)
    {
        $aReturn = array();
        $sConfig = file_get_contents($sDBConfigFile);
        $aConfigDB = json_decode($sConfig, true);
        return $aConfigDB;
    }

    private function connection($host, $databasename, $user, $passworld){
        try
        {
            $this->db = new PDO('mysql:host='.$host.';dbname='.$databasename.';charset=utf8', $user, $passworld);
        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }
    }

    public function getConnexion(){
        return $this->db;
    }

}