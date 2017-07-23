var clipboard = new Clipboard('.btn-custom-copy');

clipboard.on('success', function (e) {
    e.clearSelection();
    e.trigger.blur();
    e.trigger.innerHTML = '成功';
    $(e.trigger).parent().parent().mouseleave(function () {
        e.trigger.innerHTML = '复制';
    });
    console.log(e);
});

clipboard.on('error', function (e) {
    e.trigger.blur();
    e.trigger.innerHTML = '复制失败，请手动复制';
    $(e.trigger).parent().parent().mouseleave(function () {
        e.trigger.innerHTML = '复制';
    });
    console.log(e);
});
