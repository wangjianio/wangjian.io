<?php
namespace wangjian\wangjianio\projects\niu79\bookmark;

class Index
{
    public function showFileName($dir)
    {
        if ($handle = opendir($dir)) {
            while (false !== ($file_name = readdir($handle))) {
                if ($file_name != "." && $file_name != "..") {
                    $file_src = "../images/$file_name";
                    echo "<tr><td id='file-name'>$file_name</td><td><a href='$file_src' target='_blank'>查看</a></td><td><a href='server?action=delete&file_name=$file_name'>删除</a></td></tr>\n";
                    //<img src='$file_src'>
                }
            }
        closedir($handle);
        }
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
