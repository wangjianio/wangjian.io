<?php

if (strpos($_SERVER['HTTP_USER_AGENT'], 'GitHub-Hookshot/') == 0) {
    exec('git pull');
}
