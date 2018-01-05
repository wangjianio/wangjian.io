<?php
$action = $_GET['action'];
$current_month = date('m');

if ($action === 'query' || $current_month === '10') {
    /**
     * 车次：G1506
     * train_code = G1506
     * 车次代码：71000G150604
     * train_no = 71000G150604
     *
     * 车站名：北京
     * station_name = 北京北
     * 车站代码：VAP
     * station_telecode = VAP
     * 
     * 出发站：北京北
     * from_station = VAP
     * 到达站：上海
     * to_station = SHH
     * 
     * 出发日期：2017-01-01
     * train_date = 2017-01-01
     */
    
    $train_code = $_GET['train_code'];
    $from_station_name = $_GET['from_station_name'];
    $to_station_name = $_GET['to_station_name'];
    $train_date = $_GET['train_date'];
    
    $from_station = getStationTelecodeByStationName($from_station_name);
    $to_station = getStationTelecodeByStationName($to_station_name);
    $train_no = getTrainNo($train_date, $from_station, $to_station, $train_code);
    $query = queryByTrainNo($train_no, $from_station, $to_station, $train_date);
    
    // echo '<pre>';
    // print_r($query);
    $data = $query->data->data;
    
    $day = 0;
    $hour_value = 0;
    
    foreach ($data as $key => $value) {
        // print_r($value);
        
        if ($value->station_name === $from_station_name) {
            // 行程开始时间
            $start_time = $value->start_time;
    
            // 记录第一站发车时间
            $last_start_time = $value->start_time;
    
        } else if ($value->isEnabled) {
            
            if ($value->station_name === $to_station_name) {
                
                // 如果车站为下车站使用 arrive_time 判断 day 是否增加
                if ($value->arrive_time < $last_start_time) {
                    $day++;
                }
                
                // 记录到达站下车时间
                $arrive_time = $value->arrive_time;
    
            // 如果车站非下车站使用上一站发车时间判断 day 是否增加
            } else if ($value->start_time < $last_start_time) {
                $day++;
            }
            
            // 记录本站发车时间，用于下次比较
            $last_start_time = $value->start_time;
        }
    }
    
    $start_date = date('Y-m-d', strtotime($train_date));
    $arrive_date = date('Y-m-d', strtotime("+$day day", strtotime($start_date)));
    
    $start_datetime = $start_date . ' ' . $start_time;
    $arrive_datetime = $arrive_date . ' ' . $arrive_time;
    
    $last_time_text = getLastTimeText($start_datetime, $arrive_datetime);

    // echo $day;
    $tmp['start_datetime'] = $start_datetime;
    $tmp['arrive_datetime'] = $arrive_datetime;
    $tmp['last_time'] = $last_time_text;
    
    echo $json = json_encode($tmp);
    // echo $start_datetime, $arrive_datetime;
}



function getStationNamesByTrainCode($train_code)
{
    $api_url = "http://api.jisuapi.com/train/line?appkey=b2d0769f82642a77&trainno=$train_code";
    $api_result = file_get_contents('line.html');
    $pattern = '/"station":"(.*?)"/';

    preg_match_all($pattern, $api_result, $preg_result);

    foreach ($preg_result[1] as $key => $value) {
        $tmp = $value;
        $json[] = $tmp;
    }

    return empty($json)?false:json_encode($json);
}

function getStationTelecodeByStationName($station_name)
{
    // 读 station_name.js 文件
    $station_name_file = 'station_name.js';
    $station_name_string = file_get_contents($station_name_file);
    
    // 根据 station_name 匹配出三位大写字母 station_telecode
    $pattern = "/\|$station_name\|([A-Z]{3})\|/";
    preg_match($pattern, $station_name_string, $station_telecode);
    
    // 检查是否成功
    return empty($station_telecode[1])?false:$station_telecode[1];
}

function getTrainNo($train_date, $from_station, $to_station, $train_code)
{
    // 设置 file_get_contents() 的参数：不验证 SSL 证书
    $opts = array(
        'ssl' => array(
            'verify_peer' => false,
        ),
    );
    $context = stream_context_create($opts);
    
    // 根据参数从 12306.cn 查询
    $url = "https://kyfw.12306.cn/otn/leftTicket/queryA?leftTicketDTO.train_date=$train_date&leftTicketDTO.from_station=$from_station&leftTicketDTO.to_station=$to_station&purpose_codes=ADULT";
    $result = file_get_contents($url, false, $context);
    
    // 根据 train_code 匹配得出 12 位 train_no
    $pattern = "/\|(.{12})\|$train_code\|/";
    preg_match($pattern, $result, $train_no);

    // 检查是否成功
    return empty($train_no[1])?false:$train_no[1];
}

function queryByTrainNo($train_no, $from_station, $to_station, $train_date)
{
    // 设置 file_get_contents() 的参数：不验证 SSL 证书    
    $opts = array(
        'ssl' => array(
            'verify_peer' => false,
        ),
    );
    $context = stream_context_create($opts);
    
    // 根据参数从 12306.cn 查询
    $url = "https://kyfw.12306.cn/otn/czxx/queryByTrainNo?train_no=$train_no&from_station_telecode=$from_station&to_station_telecode=$to_station&depart_date=$train_date";
    $json = file_get_contents($url, false, $context);
    
    // 检查是否成功
    return empty($json)?false:json_decode($json);
}

function getLastTimeText($start_datetime, $arrive_datetime)
{
    // 算出历时总秒数
    $last_seconds = strtotime($arrive_datetime) - strtotime($start_datetime);

    // 算出历时小时数
    $last_hour = intval($last_seconds / 3600);

    // 算出除去小时余下的分钟数
    $last_min = intval($last_seconds % 3600 / 60);

    // 根据情况得到历时文字
    if ($last_hour) {
        $last_hour_text = $last_hour . '小时';
    }
    if ($last_min) {
        $last_min_text = $last_min . '分钟';
    }

    // 拼接
    $last_time_text = $last_hour_text . $last_min_text;

    return $last_time_text;
}
