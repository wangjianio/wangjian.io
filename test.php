<?php
//print_r($_GET);

//echo count($_GET);

if (count($_GET) != 1) exit;

    echo key($_GET);