<?php
include('database.php');
include('functions.php');

checkSession();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>主页</title>
    <link href="css/main.css" rel="stylesheet">
</head>
<body>
    <?php include('header.php');?>
    <table>
        <tr>
            <th>编号</th>
            <th>姓名</th>
            <th>性别</th>
            <th>电话</th>
            <th>身份证号</th>
            <th>文件1</th>
            <th>文件2</th>
            <th>文件3</th>
            <th>文件4</th>
            <th>文件5</th>
            <th>修改时间</th>
            <th>操作</th>
        </tr>

<?php
for ($user_id=0; $user_id<=100; $user_id++) {
    $user_query = $mysqli->query("SELECT * FROM user WHERE id = $user_id");
    $user_info = mysqli_fetch_array($user_query);
    if (!$user_info['id'] == '') {
        echo '<tr>';
        echo '<td>', $user_info['id'], '</td>';
        echo '<td>', $user_info['name'], '</td>';
        echo '<td>', $user_info['gender'], '</td>';
        echo '<td>', $user_info['tel'], '</td>';
        echo '<td>', $user_info['id_number'], '</td>';
        
        for ($file_no=1; $file_no<=5; $file_no++) {
            if ($user_info["file_$file_no"]) {
                echo '<td><a href=', $user_info["file_$file_no"], '>查看</a>
                 <a href="deleteUserFile_server.php?user_id=', $user_info['id'], '&user_file_id=', $file_no, '">删除</a></td>';
            } else {
                echo '<td>无</td>';
            }
        }

        $edit_time = date('Y年n月j日 G:i', strtotime($user_info['edit_time']));
        echo '<td>', $edit_time, '</td>';
        echo '<td><a href="edituser.php?id=', $user_info['id'], '">编辑</a>
         <a href="deleteuser_server.php?id=', $user_info['id'], '">删除</a></td></tr>';
    }
}
?>
        <tr>
            <td colspan="11"></td>
            <td><a href="adduser.php">新增</a></td>
        </tr>
        <?php include('footer.php');?>
    </table>

</body>
</html>