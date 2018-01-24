<?php 

$url = "test";
$ch = curl_init($url);

// curl_setopt($ch, CURLOPT_HTTPHEADER,  array('User-agent: curl/7.54.0'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);

$result = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($http_code != 200) {
    echo 1;
}

echo $result;
curl_close($ch);
