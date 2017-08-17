<?php
namespace wangjian\wangjianio\log;

// require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/Log.php';

class Log
{
    public function connect()
    {
        $this->table_name = '1708_1712';

        $hostname = '127.0.0.1';
        $username = 'log_root';
        $password = 'i_z03N-NoCaVpt"mE';
        $database = 'log';

        $this->mysqli = new \mysqli($hostname, $username, $password, $database);

        // 如果连接错误输出错误信息，否则将编码设置为 UTF-8
        if ($this->mysqli->connect_errno) {
            exit("Failed to connect to MySQL: $this->mysqli->connect_error");
        } else if (!$this->mysqli->set_charset("utf8")) {
            exit("Error loading character set utf8: $this->mysqli->error");
        }
    }
    
    public function logUV($project, $activity, $note = null, $result = null)
    {
        if (!$_COOKIE[$project . '_' . $activity]) {
            $name = $project . '_' . $activity;
            $value = true;
            $expire = mktime(24, 0, 0);
            $path = '';
            $domain = '';
            $secure = false;
            $httponly = true;

            setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
            

            $this->connect();
            
            $a = $ip_address = $_SERVER['REMOTE_ADDR'];
            $b = $user_agent = substr($_SERVER['HTTP_USER_AGENT'], 0, 255);
            $c = $type = 'UV';
            $d = $project;
            $e = $activity;
            $f = $note;
            $g = $result;

            $sql = "INSERT INTO $this->table_name (ip_address, useragent, type, project, activity, note, result) VALUES(?, ?, ?, ?, ?, ?, ?)";
        
            if ($stmt = $this->mysqli->prepare($sql)) {
                $stmt->bind_param("sssssss", $a, $b, $c, $d, $e, $f, $g);
                $stmt->execute();
                $stmt->close();
            }

            $this->mysqli->close();
        }
    }

    public function logPV($project, $activity, $note = null, $result = null)
    {
        $this->connect();
        
        $a = $ip_address = $_SERVER['REMOTE_ADDR'];
        $b = $user_agent = substr($_SERVER['HTTP_USER_AGENT'], 0, 255);
        $c = $type = 'PV';
        $d = $project;
        $e = $activity;
        $f = $note;
        $g = $result;

        $sql = "INSERT INTO $this->table_name (ip_address, useragent, type, project, activity, note, result) VALUES(?, ?, ?, ?, ?, ?, ?)";
    
        if ($stmt = $this->mysqli->prepare($sql)) {
            $stmt->bind_param("sssssss", $a, $b, $c, $d, $e, $f, $g);
            $stmt->execute();
            $stmt->close();
        }

        $this->mysqli->close();
    }

    public function getLogNiu79($type, $date)
    {
        $this->connect();

        $project = '/projects/niu79/bookmark/';
        $activity = 'visit';
        $note = 'index';
        
        $sql = "SELECT COUNT(id) FROM $this->table_name WHERE type = ? AND to_days(datetime) = to_days(?) AND project = ? AND activity = ? AND note = ?";
        
        if ($stmt = $this->mysqli->prepare($sql)) {
            $stmt->bind_param("sssss", $type, $date, $project, $activity, $note);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
        
            return $count;
        
            $stmt->close();
        } else {
            return $this->mysqli->errno;
        }

        $this->mysqli->close();
    }
}

$log = new Log;
