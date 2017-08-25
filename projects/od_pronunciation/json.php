<?php
// https://developer.oxforddictionaries.com

// echo '{ "metadata": { "provider": "Oxford University Press" }, "results": [ { "id": "ace", "language": "en", "lexicalEntries": [ { "language": "en", "lexicalCategory": "Noun", "pronunciations": [ { "audioFile": "http://audio.oxforddictionaries.com/en/mp3/ace_gb_1.mp3", "dialects": [ "British English" ], "phoneticNotation": "IPA", "phoneticSpelling": "eɪs" } ], "text": "ace" }, { "language": "en", "lexicalCategory": "Adjective", "pronunciations": [ { "audioFile": "http://audio.oxforddictionaries.com/en/mp3/ace_gb_1.mp3", "dialects": [ "British English" ], "phoneticNotation": "IPA", "phoneticSpelling": "eɪs" } ], "text": "ace" }, { "language": "en", "lexicalCategory": "Verb", "pronunciations": [ { "audioFile": "http://audio.oxforddictionaries.com/en/mp3/ace_gb_1.mp3", "dialects": [ "British English" ], "phoneticNotation": "IPA", "phoneticSpelling": "eɪs" } ], "text": "ace" } ], "type": "headword", "word": "ace" } ] }';

$source_lang = 'en';
$word_id = strtolower($_GET['word_id']);
$region = strtolower($_GET['region']);

// word_id 为空则输出错误消息并结束脚本
if (empty($word_id)) {
    $json['error'] = '缺少参数：word_id 为空。';
    echo json_encode($json);
    exit;
} else if (empty($region)) { // region 为空则默认为 ‘gb’
    $region = 'gb';
} else if ($region !== 'gb' && $region !== 'us') { // 如果 region 不为空且不是 ‘gb’ 或 ‘us’，输出错误信息并结束脚本
    $json['error'] = '参数有误：region 只接受 ‘gb’ 或 ‘us’。';
    echo json_encode($json);
    exit;
}

// 只有参数正确时才会来到这一步
$ch = curl_init();

$options = [
    CURLOPT_URL => "https://od-api.oxforddictionaries.com:443/api/v1/entries/$source_lang/$word_id/regions=$region;pronunciations",
    CURLOPT_HEADER => 0,
    CURLOPT_HTTPHEADER => array(
        "Accept: application/json",
        "app_id: 46650c3e",
        "app_key: 19390c3055dae1e41cf717dc9c8005f5",
    ),
    // 将结果以字符串返回，而不直接输出
    CURLOPT_RETURNTRANSFER => 1,
];

curl_setopt_array($ch, $options);

$curl_result = curl_exec($ch);

// 得到状态码
$curl_http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($curl_http_status_code === 200) {
    echo $curl_result;
} else {
    $json['error'] = '抱歉，这个单词尚未在字典中提供。';
    echo json_encode($json);
}

curl_close($ch);
