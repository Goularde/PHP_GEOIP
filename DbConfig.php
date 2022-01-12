<?php

class DbConfig
{
    private mixed $dataJson;
    public const  DBCONFIG_FILE = 'dbconfig.json';
    public mixed $DBCONFIG_HOST;
    public mixed $DBCONFIG_DBNAME;
    public mixed $DBCONFIG_CHARSET;
    public mixed $DBCONFIG_USER;
    public mixed $DBCONFIG_PASSWORD;
    public array $DBCONFIG_OPTIONS = array(PDO::ATTR_PERSISTENT => true);

    public function __construct()
    {
        $this->dataJson = $this->readJSONConfig(DbConfig::DBCONFIG_FILE);
        $this->DBCONFIG_HOST = $this->dataJson['host'];
        $this->DBCONFIG_DBNAME = $this->dataJson['databasename'];
        $this->DBCONFIG_CHARSET = $this->dataJson['charset'];
        $this->DBCONFIG_USER = $this->dataJson['user'];
        $this->DBCONFIG_PASSWORD = $this->dataJson['password'];
    }

    private function readJSONConfig(string $sDBConfigFile)
    {

        $sConfig = file_get_contents($sDBConfigFile);
        $aConfigDB = json_decode($sConfig, true);

        return ($aConfigDB);
    }

    public function getHost()
    {
        return ($this->DBCONFIG_HOST);
    }

    public function getDBName()
    {
        return ($this->DBCONFIG_DBNAME);
    }

    public function getCharset()
    {
        return ($this->DBCONFIG_CHARSET);
    }

    public function getUser()
    {
        return ($this->DBCONFIG_USER);
    }

    public function getPassword()
    {
        return ($this->DBCONFIG_PASSWORD);
    }

    public function getOptions()
    {
        return ($this->DBCONFIG_OPTIONS);
    }

}


