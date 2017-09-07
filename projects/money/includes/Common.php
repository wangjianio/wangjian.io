<?php
namespace wangjian\wangjianio\projects\money;

class Common
{
    public function redirectTo($url = '/projects/money/index')
    {
        echo '<meta http-equiv="refresh" content="0; url=' . $url . '">';
    }

    public function checkSession()
    {
        session_start();
        if (empty($_SESSION['u_id'])) {
            header('location: /projects/money/login');
        }
    }
}

