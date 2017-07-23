<?php
$opts = array(
    'ssl' => array(
        'verify_peer' => false,
    ),
);
$context = stream_context_create($opts);

$train_date = '2017-08-10';
$from_station = 'HRX';
$to_station = 'CCT';
$train_code = 'K1010';

$url = "https://kyfw.12306.cn/otn/leftTicket/query?leftTicketDTO.train_date=$train_date&leftTicketDTO.from_station=$from_station&leftTicketDTO.to_station=$to_station&purpose_codes=ADULT";
$json = file_get_contents($url, false, $context);

$pattern = "/\|预订\|(.{12})\|$train_code\|/";
preg_match($pattern, $json, $train_no);

echo $train_no[1];
