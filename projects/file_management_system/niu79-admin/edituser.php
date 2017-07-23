<?php
include('database.php');
include('functions.php');

checkSession();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>编辑</title>
    <link href="css/main.css" rel="stylesheet">
    <script src="userInfoCheck.js"></script>
</head>

<?php
$user_id = $_GET['id'];

if (!$user_id) {  
    exit('编号有误！');  
}

if ($check = $mysqli->query("SELECT * FROM user WHERE id = $user_id")) {
    $user_info = mysqli_fetch_array($check);
} else {
    echo "ERROR: (" . $mysqli->errno . ") " . $mysqli->error;
}

if ($user_info['gender']) {
    if ($user_info['gender'] == '男') {
        $check1 = 'checked';
        $check2 = '';
    } elseif ($user_info['gender'] == '女') {
        $check1 = '';
        $check2 = 'checked';
    } else {
        $check1 = '';
        $check2 = '';
    }
}
?>

<body>
    <?php include('header.php');?>
    <div>
        <form enctype="multipart/form-data" name="edit_user" method="post" action="edituser_server.php" onSubmit="return inputCheck(this)">
            <fieldset>
                <legend>编辑信息</legend>
                <h3>基本信息（必填）</h3>
                <input type="hidden" name="user_id" value="<?php echo $user_info['id'];?>"><!--请勿修改user_id，否则将导致信息混乱-->
                <input type="hidden" name="MAX_FILE_SIZE" value="300000">
                <label>姓　　名：<input id="name" name="name" type="text" value="<?php echo $user_info['name'];?>"></label><br>
                <label>性　　别：<input id="gender" name="gender" type="radio" value="男" <?php echo $check1;?>>男 <input id="gender" name="gender" type="radio" value="女" <?php echo $check2;?>>女</label><br>
                <label>电　　话：<input id="tel" name="tel" type="text" value="<?php echo $user_info['tel'];?>"></label><br>
                <label>身份证号：<input id="id_number" name="id_number" type="text" value="<?php echo $user_info['id_number']?>"></label><br>
                <h3>上传文件（每个文件在 300KB 以内）</h3>
<?php for ($file_no=1; $file_no<=5; $file_no++) { echo '
                上传文件' . $file_no . "：<input name='file[$file_no]'" . 'type="file"><br>';}?>
                <p>注：不选择文件保存不做更改</p>
                <label><input name="submit" type="submit" value="保存"</label>
            </fieldset>
        </form>
    </div>
    <?php include('footer.php');?>
</body>

</html>