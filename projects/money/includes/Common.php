<?php
namespace lopedever\money;

class Common
{
    public function redirectTo($url = '/projects/money/index')
    {
        echo '<meta http-equiv="refresh" content="0; url=' . $url . '">';
    }
}

$common = new Common;
