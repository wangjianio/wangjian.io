<?php
class Database
{
    public function connect()
    {
        $hostname = '127.0.0.1';
        $database = 'poi';
        $username = 'poi_root';
        $password = 'poi_password';
        
        $this->mysqli = new mysqli($hostname, $username, $password, $database);
        
        if ($this->mysqli->connect_errno) {
            exit("Failed to connect to MySQL: $this->mysqli->connect_error");
        } else if (!$this->mysqli->set_charset("utf8")) {
            exit("Error loading character set utf8: $this->mysqli->error");
        }
    }
}
