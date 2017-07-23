//弹出隐藏层
function ShowDiv(hideDiv, a_type) {
    var url = "edit.php?a_type=" + a_type;
    document.getElementById("iframe").src = url;
    document.getElementById(hideDiv).style.display = 'block';
};
//关闭弹出层
function CloseDiv(hideDiv, reload = 0) {
    document.getElementById(hideDiv).style.display = 'none';

    if (reload == 1) {
        setTimeout("location.reload(true);", 1000);
    }
};
