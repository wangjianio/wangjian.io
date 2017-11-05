<?php
date_default_timezone_set('Asia/Shanghai');

if ($_GET['action'] === 'upload') {
    
    $current_time = date('YmdHis');
    $return_time = date('Y-m-d H:i:s');

    $upload_dir = "./original_file/";

    // 检查文件夹，或创建
    if (!is_dir($upload_dir)) {
        if (!mkdir($upload_dir, 0777, true)) {
            $arr['result'] = false;
            $arr['error'] = '文件夹创建失败。';
            exit(json_encode($arr));
        }
    }

    // 检查是否有文件
    if (empty($_FILES['file']['name'])) {
        $arr['result'] = false;
        $arr['error'] = $_FILES['file']['name']; 
        exit(json_encode($arr));
    }
    
    $file_name = $_FILES["file"]["name"];
    $tmp_file = $_FILES["file"]["tmp_name"];
    $upload_file = $upload_dir . 'O' . $current_time . "_" . $file_name;
    
    // 完成上传文件
    if ($error == UPLOAD_ERR_OK) {
        $mime_content_type = mime_content_type($tmp_file);

        if ($mime_content_type == 'text/plain') {
            if (move_uploaded_file($tmp_file, $upload_file)) {
                $arr['result'] = true;
            } else {
                $arr['error'] = $_FILES['file']['error'];
            }
        } else {
            $arr['error'] = "$file_name 上传失败：文件类型有误，仅支持 csv 格式的文件。如扩展名没问题，请使用 Excel 重新导出再试。";
        }
    } elseif ($error = 2) {
        $arr['error'] = "$file_name 上传失败：文件太大，请上传小于 2M 的文件。";
    } else {
        $arr['error'] = "$file_name 上传失败，错误代码：$error 。";
    }

    if ($arr['result']) {
        $array = file($upload_file);
        $num = preg_match_all('/,/', $array[0]);

        foreach ($array as $key => $value) {
            $o_arr = explode(',', $value);
            $u_arr = array_unique($o_arr);
            unset($u_arr[$num]);
            for ($i=0; count($u_arr) < $num+1; $i++) { 
                $u_arr[] = $temp;
            }
            $result = implode(',', $u_arr);
            file_put_contents("result_file/R{$current_time}_{$file_name}", $result . "\n", FILE_APPEND | LOCK_EX);
        }
        $arr['result'] = true;
        $arr['datetime'] = $return_time;
        $arr['file_name'] = $file_name;
        $arr['original_link'] = "original_file/O{$current_time}_{$file_name}";
        $arr['result_link'] = "result_file/R{$current_time}_{$file_name}";
        echo json_encode($arr);
    }
}
