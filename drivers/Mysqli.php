<?php

class Mysqli__driver
{
    var $link = NULL;
    public function connect($host,$user,$password,$dbname)
    {
        if(!$this->link)
        {
            $this->link = mysqli_connect($host,$user,$password,$dbname);
            mysqli_query($this->link, "SET NAMES 'utf8'");
        }
    }

    public function execute($sql, $params = array())
    {
        $items = array();
        foreach($params as $item)
        {
            switch(@$item['t'])
            {
                case 'i':array_push($items, (int)$item['d']);break;
                case 'f':array_push($items, (float)$item['d']);break;
                case 's?':array_push($items, $item['d'] ? (str_replace('[text]', mysqli_real_escape_string($this->link, (string)$item['d']), $item['template'])) : $item['default']);break; //for where
                default: array_push($items, "'".mysqli_real_escape_string($this->link, (string)$item['d'])."'");
            }
        }

        $res = mysqli_query(
            $this->link,
            count($items) ? vsprintf($sql, $items) : $sql
        ) or die(mysqli_error($this->link));
        unset($items);
        return $res;
    }

    public function insert_id()
    {
        return mysqli_insert_id($this->link);
    }

    public function fetch_assoc($resource)
    {
        return mysqli_fetch_assoc($resource);
    }

    public function num_rows($resource)
    {
        return mysqli_num_rows($resource);
    }

    public function affected_rows()
    {
        return mysqli_affected_rows($this->link);
    }
}

?>