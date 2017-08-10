<?php
namespace wangjian\wangjianio\projects\niu79\bookmark;

class Index
{
    public function showFileName($dir)
    {
        if ($handle = opendir($dir)) {
            while (false !== ($file_name = readdir($handle))) {
                if ($file_name != "." && $file_name != "..") {
                    $file_src = "../bookmark/images/$file_name";
                    echo "    <tr>\n      <td id='file-name'>$file_name</td>\n      <td><a href='$file_src' target='_blank'>查看</a></td>\n    <td><a href='delete.php?file_name=$file_name'>删除</a></td>\n      </tr>\n";
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
            header("location:login.html");
            exit();
        }
    }
}


$index = new Index;
$session = new Session;
