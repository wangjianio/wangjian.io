<?php
namespace lopedever\money;

class Common
{
    public function redirectTo($url = '/php/money/index.php')
    {
        echo '<meta http-equiv="refresh" content="0; url=' . $url . '">';
    }
}

$common = new Common;
