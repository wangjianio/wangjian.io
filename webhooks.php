<?php
$str = file_get_contents('../X-Hub-Signature');
if ($_SERVER['X-Hub-Signature'] == $str) {
    shell_exec('git pull');
}
