<?php
include('database.php');
include('functions.php');

checkSession();


//编辑信息

if (!isset($_POST)) exit(非法访问！);
if (!$_POST['user_id'] || !$_POST['name'] || !$_POST['gender'] || !$_POST['tel'] || !$_POST['id_number']) exit(缺少信息！);

$user_id = $_POST['user_id'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$tel = $_POST['tel'];
$id_number = $_POST['id_number'];

if (!$mysqli->query("UPDATE user SET name = '$name', gender = '$gender', tel = '$tel', id_number = '$id_number' WHERE id = '$user_id'")) {
    echo "ERROR: (" . $mysqli->errno . ") " . $mysqli->error;
} else {
    echo '信息更新成功！<br><br>';
}


//上传文件

for ($file_no=1; $file_no<=5; $file_no++) {
    $user_id_link = md5($user_id);
    $user_file = "file_$file_no";
    $user_file_link = md5($user_file);
    $uploaddir = "../niu79-download/$user_id_link/$user_file_link/";
    $uploadfile = $uploaddir . $_FILES['file']['name']["$file_no"];

    if (!is_dir($uploaddir)) mkdir($uploaddir, 0777, true);

    if (file_exists($_FILES['file']['tmp_name']["$file_no"])) {
        if (is_uploaded_file($_FILES['file']['tmp_name']["$file_no"])) {
            if (move_uploaded_file($_FILES['file']['tmp_name']["$file_no"], $uploadfile)) {
                if ($mysqli->query("UPDATE user SET $user_file = '$uploadfile' WHERE id = '$user_id'")) {
                    echo "文件$file_no 上传成功！<br>";
                } else echo "ERROR: (" . $mysqli->errno . ") " . $mysqli->error;
            } else echo $_FILES['file']['error']["$file_no"];
        } else echo '文件不合法！<br>';
    } else echo "文件$file_no 未选择<br>";
}

echo '<br>3 秒后<a href="index.php">回到主页</a><br>';
echo '<meta http-equiv="refresh" content="3; url=index.php">'; 
?>