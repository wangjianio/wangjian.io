<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>信息查询</title>
    <link href="css/main.css" rel="stylesheet">
    <script>
        function inputCheck(form) {
            if (form.id_number.value == "") {
                alert("请输入身份证号码!");
                form.id_number.focus();
                return (false);
            }
            if (form.tel.value == "") {
                alert("请输入手机号!");
                form.tel.focus();
                return (false);
            }
            if (form.code.value == "") {
                alert("请输入验证码！");
                form.code.focus();
                return (false);
            }
        }
    </script>
</head>

<body>
    <div>
        <form name="form" method="post" action="yourinfo.php" onsubmit="return inputCheck(this)">
            <fieldset>
                <legend>信息查询</legend>
                <label>身份证号：<input name="id_number" type="text"></label><br>
                <label>手机号码：<input name="tel" type="text"></label><br>
                <label>验证码：<input name="code" type="text"></label><br>
                <label><input name="submit" type="submit"></label>
            </fieldset>
        </form>
    </div>
</body>
</html>