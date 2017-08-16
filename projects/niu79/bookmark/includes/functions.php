<?php
namespace wangjian\wangjianio\projects\niu79\bookmark;

class Index
{
    public function showFileName($dir)
    {
        $file_list = scandir($dir, 1);
        
        foreach ($file_list as &$file_name) {
            if ($file_name != '.' && $file_name != '..') {
                $file_path = "../images/$file_name";
                echo <<<TBODY
                <tr>
                    <td>$file_name</td>
                    <td><a href="$file_path" target="_blank">查看</a></td>
                    <td><a href="server?action=delete&file_name=$file_name">删除</a></td>
                </tr>
TBODY;
            }
        }
        unset($file_name);
    }
}

class Session
{
    public function checkSession()
    {
        session_start();
        if (!isset($_SESSION['username'])) {
            header("location: login");
            exit;
        }
    }
}


$index = new Index;
$session = new Session;
