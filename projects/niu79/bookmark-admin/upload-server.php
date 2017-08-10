<?php
namespace wangjian\wangjianio\projects\niu79\bookmark;

include '../includes/config.php';
include '../includes/functions.php';
include '../includes/log.php';

$session->checkSession();

$uploaddir = "../bookmark/images/";
$is_all_ok = -1;
?>
<!DOCTYPE html>
<html>

<head>
  <title>上传结果</title>
</head>

<body>

<?php
if (!is_dir($uploaddir)) {
    if (!mkdir($uploaddir, 0777, true)) {
        echo '文件夹创建失败';
    }
}

foreach ($_FILES["file"]["error"] as $key => $error) {
    $name = $_FILES["file"]["name"][$key];
    $tmp_name = $_FILES["file"]["tmp_name"][$key];
    $upload_file_name = $uploaddir . $name;
    if ($error == UPLOAD_ERR_OK) {
        $mime_content_type = mime_content_type($tmp_name);
        if ($mime_content_type == 'image/jpeg') {
            if (move_uploaded_file($tmp_name, $upload_file_name)) {
            echo "<p>文件 $name <span style='color:#09bb07'>上传成功！</span></p>\n";
            $is_all_ok++;
            } else {
                echo "移动失败，错误代码：".$_FILES['file']['error']['0'];
            }
        } else {
            echo "<p>文件 $name <span style='color:#e64340'>上传失败：类型有误，仅支持 jpg/jpeg 格式。</span></p>\n";
        }
    } elseif ($error = 2) {
        echo "<p>文件 $name <span style='color:#e64340'>上传失败：文件太大，请上传小于 2M 的文件。</span></p>\n";
    } else {
        echo "<p>文件 $name <span style='color:#e64340'>上传失败，错误代码：$error 。</span></p>\n";
    }
}

// echo $key;
// echo $is_all_ok;

if ($is_all_ok == $key) {
    echo '<p>3 秒后<a href="index.php">回到主页</a></p>'."\n";
    echo '<meta http-equiv="refresh" content="3; url=index.php">'."\n"; 
} else {
    echo '<p><a href="index.php">回到主页</a></p>'."\n";
}
/* 老版单文件上传
$uploadfile = $uploaddir . $_FILES['file']['name'];

if (file_exists($_FILES['file']['tmp_name'])) {
    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
            echo '上传成功！';
        } else echo $_FILES['file']['error'];
    } else echo '文件不合法！<br>';
} else echo "文件未选择<br>";
*/
?>

</body>

</html>
