<?php
namespace lopedever\niu79\bookmark;
/*
// bool error_log ( string $message [, int $message_type = 0 [, string $destination [, string $extra_headers ]]] )
// error_log($message, $message_type, $destination);

$current_datetime = date('c');
// $current_datetime = date('Y-m-d H:i:s');

class Log
{
    public function logLogin()
    {
        global $current_datetime;
        
        $array_message = [
            'time' => $current_datetime,
            'username' => $_SESSION['username'],
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'useragent' => $_SERVER['HTTP_USER_AGENT'],
        ];

        $a = $array_message['time'];
        $b = $array_message['username'];
        $c = $array_message['ip_address'];
        $d = $array_message['useragent'];

        $message = "$a, $b, $c, $d\n";
        $message_type = 3;
        $destination = '../log/login.log';
        $extra_headers = null;

        error_log($message, $message_type, $destination);
        error_log($message, $message_type, '../log/log.log');
    }

    public function logUpload()
    {
        global $current_datetime;

        $array_message = [
            'time' => $current_datetime,
            'username' => $_SESSION['username'],
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'useragent' => $_SERVER['HTTP_USER_AGENT'],
            'file_name' => $a,
        ];

        $a = $array_message['time'];
        $b = $array_message['username'];
        $c = $array_message['ip_address'];
        $d = $array_message['useragent'];

        $message = "$a, $b, $c, $d\n";
        $message_type = 3;
        $destination = '../log/upload.log';
        $extra_headers = null;

        error_log($message, $message_type, $destination);
        error_log($message, $message_type, '../log/log.log');
    }
}

$log = new Log;
*/