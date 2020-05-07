<?php

require_once dirname(dirname(__FILE__)).ROOT::$dbDriver;

class ConnectGeneral
{
    var $bd;

    public function connect()
    {
        if(!$this->bd)
        {
            $this->bd = new Mysqli__driver();
            $this->bd->connect(
                ROOT::$hostname,
                ROOT::$username,
                ROOT::$password,
                ROOT::$dbName);
        }
    }
}

?>