<?php
namespace lopedever\money;

include dirname(__DIR__) . '/includes/Common.php';
include dirname(__DIR__) . '/includes/category/PrintCategoryData.php';

?>
<!DOCTYPE html>
<html>

<head>
  <title>类别管理</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../styles/category/index.css">
  <script src="../scripts/jquery-3.2.1.min.js"></script>
  <script src="../scripts/svg.js"></script>
  <script src="../scripts/common.js"></script>
  <script>
    function showAddForm(query) {
        form = '<form id="addCateForm" name="add_cate_form" method="post" action="add.php?' + query + '"><input name="new_cate" id="addInput" type="text" placeholder="输入新类别"></form>';
        document.getElementById("blank").innerHTML = form;
        document.getElementById("add").innerHTML = '<a href="javascript:void(0)" onclick="checkInput()">完成</a>';
        document.getElementById("addInput").focus();
    }

    function showEditForm(query, cateName) {
        form = '<form id="editCateForm" name="edit_cate_form" method="post" action="edit.php?c=' + query + '"><input name="new_cate" id="editInput" type="text" value="' + cateName + '" placeholder="输入新类别名"></form>';
        var col1 = cateName + 'Col1';
        var col2 = cateName + 'Col2';
        var col3 = cateName + 'Col3';
        document.getElementById(col1).innerHTML = form;
        document.getElementById(col1).onclick = null;
        document.getElementById(col1).style.padding = 0;
        document.getElementById(col2).innerHTML = '<a id="save" href="javascript:void(0)" onclick="submitForm(\'editCateForm\')"><b>保存</b></a>';
        document.getElementById('save').style.color = 'rgba(0, 112, 201, 1)';
        document.getElementById(col3).innerHTML = '<a id="cancel" href="javascript:void(0)" onclick="hideEditForm(\'' + query + "', '" + cateName + '\')">取消</a>';
        document.getElementById('cancel').style.color = 'rgba(0, 112, 201, 1)';
        document.getElementById("editInput").focus();
    }

    function hideEditForm(query, cateName) {
        var col1 = cateName + 'Col1';
        var col2 = cateName + 'Col2';
        var col3 = cateName + 'Col3';
        document.getElementById(col1).innerHTML = cateName;
        document.getElementById(col1).style.padding = '8px';
        document.getElementById(col1).onclick = function() {
            location.href = document.URL + '-' + cateName;
        }
        document.getElementById(col2).innerHTML = '<a href="javascript:void(0)" onclick="checkIsThereEditForm(\''+query+"', '"+cateName+'\')">编辑</a>';
        document.getElementById(col3).innerHTML = '<a href="delete.php?c='+ query +'">删除</a>';
    }

    function checkIsThereEditForm(query, cateName) {
        if (document.getElementById('editCateForm')) {
            document.getElementById('cancel').click();
            showEditForm(query, cateName);
        } else {
            showEditForm(query, cateName);
        }
    }
    
    function checkInput() {
        if (!addCateForm.new_cate.value) {
            alert("类别名不能为空。");
            addCateForm.new_cate.focus();
            return (false);
        } else if (addCateForm.new_cate.value) {
            var re = /-/;
            var contain = re.exec(addCateForm.new_cate.value);
            if (contain) {
                alert("类别名不能含有下划线 “-”。");
                return (false);
            } else {
                submitForm('addCateForm');
            }
        }
    }
  </script>
</head>

<body>

<?php 
include dirname(__DIR__) . '/includes/header.php';

echo '<div class="content">';

$c = preg_split("/-+/", $_GET['c']);

$type = $c[0];
$cate_1 = $c[1];
$cate_2 = $c[2];
$cate_3 = $c[3];
$cate_4 = $c[4];
$cate_5 = $c[5];

if (!isset($_GET['c'])) {
    $common->redirectTo('/php/money/category/index.php?c=支出');
} elseif ($type != '支出' && $type != '收入') {
    $common->redirectTo('/php/money/category/index.php?c=支出');
} else {
    $print_category_data->printData($type, $cate_1, $cate_2, $cate_3, $cate_4, $cate_5);
}

?>

  </div>
</body>

</html>
