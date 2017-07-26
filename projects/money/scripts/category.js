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
    document.getElementById(col1).onclick = function () {
        location.href = document.URL + '-' + cateName;
    }
    document.getElementById(col2).innerHTML = '<a href="javascript:void(0)" onclick="checkIsThereEditForm(\'' + query + "', '" + cateName + '\')">编辑</a>';
    document.getElementById(col3).innerHTML = '<a href="delete.php?c=' + query + '">删除</a>';
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