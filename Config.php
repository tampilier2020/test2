<?php

class ROOT
{
    /*connection BD*/
    public static $hostname = 'localhost';
    public static $username = 'root';
    public static $password = 'qwerty';
    public static $dbName = 'test1';
    public static $table_prefix = '';
    public static $dbDriver = '/drivers/Mysqli.php';

    public static $client_path = 'http://localhost/test/';
    public static $alt_path = 'test/';

    public static $cookie_domain = "localhost";

    public static function NVLA($array, $key, $default = null, $type='s')
    {
        switch($type)
        {
            case 'i'://integer
                return ($array && array_key_exists($key, $array)) ? (int)$array[$key] : $default;
            break;
            case 'f'://float
                return ($array && array_key_exists($key, $array)) ? (float)$array[$key] : $default;
            break;
            default:
                return ($array && array_key_exists($key, $array)) ? htmlspecialchars(stripslashes($array[$key])) : $default;
        }
    }
}

?>