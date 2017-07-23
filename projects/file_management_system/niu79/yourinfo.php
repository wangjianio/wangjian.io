<?php
include('database.php');

if (!isset($_POST)) exit(header('location:index.php'));
if (!$_POST['id_number'] || !$_POST['tel'] || !$_POST['code']) {
    exit('缺少信息！');
}

$id_number = htmlspecialchars($_POST['id_number']);
$tel = htmlspecialchars($_POST['tel']);
$code = htmlspecialchars($_POST['code']);

if (!$select = $mysqli->query("SELECT * FROM user WHERE id_number = '$id_number' AND tel = '$tel'")) {
    echo 'error: (', $mysqli->errno, ')', $mysqli->error;
}

if ($user_info = mysqli_fetch_array($select)) {
    echo '查询成功！<br><br>';
    echo '姓名：', $user_info['name'], '<br>';
    echo '性别：', $user_info['gender'], '<br>';
    echo '电话：', $user_info['tel'], '<br>';
    echo '身份证号：', $user_info['id_number'], '<br><br>';
    for ($file_no=1; $file_no<=5; $file_no++) {
        if ($user_info["file_$file_no"]) {
            echo '文件', $file_no, '：<a href="', $user_info["file_$file_no"], '">下载<a><br>';
        }
    }

} else {
    echo '不匹配';
}
?>