<?php
include 'database.php';
include 'functions.php';

checkSession();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>添加信息</title>
    <link href="css/main.css" rel="stylesheet">
    <script src="userInfoCheck.js"></script>
</head>

<body>
    <?php include('header.php');?>
    <div>
        <form name="adduser" method="post" action="adduser_server.php" onSubmit="return inputCheck(this)">
            <fieldset>
                <legend>添加信息</legend>
                <label>姓　　名：<input id="name" name="name" type="text"></label><br>
                <label>性　　别：<input id="gender" name="gender" type="radio" value="男">男 <input id="gender" name="gender" type="radio" value="女">女</label><br>
                <label>电　　话：<input id="tel" name="tel" type="text"></label><br>
                <label>身份证号：<input id="id_number" name="id_number" type="text"></label><br>
                <label><input name="submit" type="submit"</label>
            </fieldset>
        </form>
    </div>
    <?php include('footer.php');?>
</body>

</html>