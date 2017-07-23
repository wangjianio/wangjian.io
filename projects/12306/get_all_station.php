<?php
$trainno = $_GET['train_code'];
$api_url = "http://api.jisuapi.com/train/line?appkey=%20b2d0769f82642a77&trainno=$trainno";
$api_result = file_get_contents($api_url);

$pattern = '/"station":"(.*?)"/';
preg_match_all($pattern, $api_result, $out);

$count = count($out[1]);

for ($i=0; $i < $count; $i++) { 
    echo $out[1][$i];
    echo '<br>';
}
