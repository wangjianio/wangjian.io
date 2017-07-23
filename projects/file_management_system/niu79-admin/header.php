<?php
$admin_id = $_SESSION['admin_id'];
$admin_query = $mysqli->query("SELECT * FROM admin WHERE id = $admin_id");
$admin_info = mysqli_fetch_array($admin_query);
?>

<table>
    <tr>
        <td>管理员 <?php echo $admin_info['username'];?> 你好！</td>
        <td><a href="index.php">主页</a></td>
        <td><a href="../niu79" target="_blank">用户界面</a></td>
        <td><a href="about.php">关于</a></td>
        <td><a href="logout.php">注销</a></td>
    </tr>
</table><br>