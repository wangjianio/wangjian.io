<?php

// echo '<pre>';

$arr_input = file("input.json");

foreach ($arr_input as $key => $json) {
  $array = json_decode($json, 1);
  foreach ($array as $key => $value) {
    arsort($array[$key]['category']);
    // print_r($array);

    $str = $key . ',';
    // echo $key . ':';
    foreach ($array[$key]['category'] as $key => $value) {
      $str .= $key . ',' . $value . ',';
      // echo $key . ':' . $value;
    }
  }
  file_put_contents('output.csv', $str . "\r\n", FILE_APPEND | LOCK_EX);
}
echo ('done');
