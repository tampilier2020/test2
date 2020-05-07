<?php

class ChatSql extends ConnectGeneral {

    private $limitMessages = 10;

    private function inet_aton($ip)
    {
        $ip = ip2long($ip);
        ($ip < 0) ? $ip+=4294967296 : true;

        return $ip;
    }

    public function update($data)
    {
        $this->connect();
        $result = $this->bd->execute('select ip, message, user, time from messages order by id desc limit %d', array(
            array('d' => $this->limitMessages, 't' => 'i')
        ));

        $list = [];
        if($this->bd->num_rows($result))
        {
            while($row = $this->bd->fetch_assoc($result))
            {
                array_push($list, array(
                    'ip' => long2ip($row['ip']),
                    'message' => $row['message'],
                    'user' => $row['user'],
                    'time' => date("H:i:s", $row['time'])
                ));
            }
        }

        echo json_encode($list);
    }

    public function send($data)
    {
        $this->connect();
        $result = $this->bd->execute('insert into messages values(null, %d, %s, %s, %d)', array(
            array('d' => $this->inet_aton($_SERVER['REMOTE_ADDR']), 't' => 'i'),
            array('d' => $data['message']),
            array('d' => $data['login']),
            array('d' => ServerTime::getNowTime(), 't' => 'i')
        ));

        $status = 0;
        if(!$this->bd->affected_rows($result))
        {
            $status = 1;
        }

        echo json_encode(array(
            'status' => $status
        ));
    }
}

?>