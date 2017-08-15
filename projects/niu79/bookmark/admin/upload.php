<?php
namespace wangjian\wangjianio\projects\niu79\bookmark;

include '../includes/config.php';
include '../includes/functions.php';

$session->checkSession();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>上传</title>
  <link href="css/main.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <div>
    <form enctype="multipart/form-data" name="uploadForm" method="post" action="upload-server.php">
      <fieldset>
        <legend>上传新文件</legend>
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
        <p>请将每个文件大小限制在 2M 以内（仅支持 jpg/jpeg 格式）</p>
        <p><input name="file[]" type="file" multiple="yes" accept="image/jpeg"></p>
        <label><input name="submit" type="submit" value="上传"></label>
      </fieldset>
    </form>
  </div>
  <p><a href="./">回到主页</a></p>
</body>

</html>
