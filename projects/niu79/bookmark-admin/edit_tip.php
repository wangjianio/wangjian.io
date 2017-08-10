<?php
namespace wangjian\wangjianio\projects\niu79\bookmark;

include '../includes/config.php';
include '../includes/functions.php';
include '../includes/log.php';

$session->checkSession();

/**
 * 检查是否用 Post 方式得到正确的参数，否则结束脚本并给出错误信息。
 */
if ($_POST['show'] != 0 && $_POST['show'] != 1) {
    exit('缺少信息！');
}

$new_show = $_POST['show'];
$new_tip = $_POST['tip'];

$string = file_get_contents('../includes/config.php');

$pattern = "/define\('SHOW', .*?\);/";
$replacement = "define('SHOW', $new_show);";
$string = preg_replace($pattern, $replacement, $string);

$pattern = "/define\('TIP', '(.|\n)*?'\);/";
$replacement = "define('TIP', '$new_tip');";
$string = preg_replace($pattern, $replacement, $string);

if (file_put_contents('../includes/config.php', $string)) {
    echo '设置成功！3 秒后 <a href="index.php">返回</a><br>';
    echo '<meta http-equiv="refresh" content="3; url=index.php">'; 
}


