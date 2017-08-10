<?php
namespace wangjian\wangjianio\projects\niu79\bookmark;

require_once '../includes/functions.php';
require_once '../includes/log.php';

$session->checkSession();

/**
 * Delete files and error output.
 */
$file_name = $_GET['file_name'];
$file = "../bookmark/images/$file_name";

/**
 * 采用 Get 方式，如果没有 $file_name 
 * 或 $file_name 不存在
 * 或删除 $file_name 失败
 * 则结束脚本并给出提示。
 * 都成功则返回主页。
 */
if (!$file_name) {
    exit('别这么进');
} elseif (!file_exists($file)) {
    exit('你删什么呢？');
} elseif (!unlink($file)) {
    exit('删除失败');
} else {
    header('location:index.php');
}
