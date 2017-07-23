<?php
$station_name_input = $_GET['station_name'];

$station_name_file = 'station_name.js';
$station_name_string = file_get_contents($station_name_file);

$pattern = "/\|$station_name_input\|([A-Z]{3})\|/";
preg_match($pattern, $station_name_string, $station_telecode);

if (empty($station_telecode[1])) {
    echo "ERROR";
} else {
    echo $station_telecode[1];
}
