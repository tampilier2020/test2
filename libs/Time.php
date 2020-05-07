<?php

class ServerTime
{
	public static $delta = 0;//3600 second - 1 hour
	public static function getNowTime(){
		return time()+self::$delta;
	}
}

?>