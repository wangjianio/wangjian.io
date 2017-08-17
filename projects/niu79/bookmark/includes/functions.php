<?php
namespace wangjian\wangjianio\projects\niu79\bookmark;

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/Log.php';

class Index extends \wangjian\wangjianio\log\Log
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
                    <td class="action"><a href="$file_path" target="_blank">查看</a></td>
                    <td class="action"><a href="server?action=delete&file_name=$file_name">删除</a></td>
                </tr>
TBODY;
            }
        }
        unset($file_name);
    }

    public function printStatisticTableBody()
    {
        for ($i = 0; $i < 7 ; $i++) {
            $date = strtotime("-$i day");
            $date = date('Y-m-d', $date);
            $pv = $this->getLogNiu79('PV', $date);
            $uv = $this->getLogNiu79('UV', $date);
            echo <<< TR
            <tr>
                <td>$date</td>
                <td class="text-right">$pv</td>
                <td class="text-right">$uv</td>
            </tr>
TR;
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
