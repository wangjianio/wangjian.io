<?php
namespace lopedever\money;

include dirname(__DIR__) . '/includes/Common.php';
include dirname(__DIR__) . '/includes/category/PrintCategoryData.php';

$title = '类别管理';
$nav_type = 'money';
$subnav_type = 'category';

$extra_css = '<link rel="stylesheet" href="../styles/category.css">';
$extra_js = '<script src="../scripts/money.js"></script>';
$extra_js = '<script src="../scripts/category.js"></script>';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

echo '<div class="container">';

$c = preg_split("/-+/", $_GET['c']);

$type = $c[0];
$cate_1 = $c[1];
$cate_2 = $c[2];
$cate_3 = $c[3];
$cate_4 = $c[4];
$cate_5 = $c[5];

if (!isset($_GET['c'])) {
    $common->redirectTo('/projects/money/category/index.php?c=支出');
} elseif ($type != '支出' && $type != '收入') {
    $common->redirectTo('/projects/money/category/index.php?c=支出');
} else {
    $print_category_data->printData($type, $cate_1, $cate_2, $cate_3, $cate_4, $cate_5);
}

echo '</div><!-- .container -->';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
