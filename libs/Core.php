<?php

class ServerTime
{
	public static $delta = 0;//3600 second - 1 hour
	public static function getNowTime(){
		return time()+self::$delta;
	}
}

class ConnectGeneral extends ROOT
{
    var $bd;

    public function set_cookie($key, $value, $expire = 63072000)
    {
        $time = ServerTime::getNowTime();

        header('Set-cookie: '.$key.'='.$value.'; '.($_SERVER['HTTP_HOST'] != 'localhost' ? 'Domain='.self::$cookie_domain.'; ' : '').'Path='.str_replace('//','/', '/'.self::$alt_path).'; Expires='.gmdate('D, d M Y H:i:s \G\M\T', $time + $expire));
        setcookie(
            $key,
            $value,
            ($time + $expire),
            str_replace('//','/', '/'.self::$alt_path),
            self::$cookie_domain);
    }

    public function del_cookie($key)
    {
        $time = ServerTime::getNowTime();

        header('Set-cookie: '.$key.'=; '.($_SERVER['HTTP_HOST'] != 'localhost' ? 'Domain='.self::$cookie_domain.'; ' : '').'Path='.str_replace('//','/', '/'.self::$alt_path).'; Expires='.gmdate('D, d M Y H:i:s \G\M\T', $time - 3600));
        setcookie(
            $key,
            '',
            ($time  - 3600),
            str_replace('//','/', '/'.self::$alt_path),
            self::$cookie_domain);
    }

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

    public function getGlobalInfo()
    {
        $this->connect();
        $time = ServerTime::getNowTime();
        $sessionData = null;
        $auth = null;

        if(array_key_exists('SESSION_HASH', $_COOKIE))
        {
            $res = $this->bd->execute('select id, user_id, login from user_online where hash = %s limit 1',array(
                array('d' => $_COOKIE['SESSION_HASH']),
            ));
        }

        $count = $this->bd->num_rows($res);
        if($count)
        {
            $res = $this->bd->fetch_assoc($res);
            $sessionData = array(
                'user_id' => $res['user_id'],
                'hash' => $_COOKIE['SESSION_HASH'],
                'login' => $res['login']
            );
        }

        return array(
            'user_id' => $sessionData ? $sessionData['user_id'] : 0,
            'hash' => $sessionData ? $sessionData['hash'] : '',
            'login' => $sessionData ? $sessionData['login'] : '',
            'auth' => $auth
        );
    }

    public function inet_aton($ip)
    {
        $ip = ip2long($ip);
        ($ip < 0) ? $ip+=4294967296 : true;

        return $ip;
    }
}

?>