<?php
date_default_timezone_set('Asia/Shanghai');
$ini = parse_ini_file('article.ini', TRUE);

$path = array(
    'header' => __DIR__.'/header.php',
    'footer' => __DIR__.'/footer.php',
);
