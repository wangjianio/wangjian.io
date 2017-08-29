<?php
namespace wangjian\wangjianio\projects\money;

require_once dirname(__DIR__) . '/includes/Database.php';

$id = $_GET['id'];

if (!isset($id) || !is_numeric($id)) {
    header('location: index');
}

$database = new Database;
$username = 'money_root';
$database->connect($username);
$mysqli = $database->mysqli;

$sql = "SELECT type, category FROM category WHERE id = ?";

if ($stmt = $mysqli->prepare($sql)) {

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($type, $category);
    $stmt->fetch();
    $stmt->close();
}

$mysqli->close();

?>

<div class="form-group">
  <label class="h4" for="new_old_cate_input" style="margin-bottom: 15px">修改类别名：</label>
  <input class="form-control" id="new_old_cate_input" type="text" placeholder="必填" autocomplete="off" value="<?php echo $category; ?>">
</div>

<div class="form-group">
  <label class="h4" for="new_child_cate_input" style="margin-bottom: 15px">新增子类别：</label>
  <input class="form-control" id="new_child_cate_input" type="text" placeholder="请输入子类别名，不新增请留空" autocomplete="off">
</div>

<hr>

<button class="btn btn-success btn-block hidden" id="selected_submit_btn" type="submit">提交</button>
<button class="btn btn-danger btn-block" id="delete_btn" type="button">删除</button>

<script>
  $(document).ready(function () {
    $('input').on('input propertychange', function () {
      $('#selected_submit_btn').removeClass('hidden');
      $('#delete_btn').removeClass('btn-danger');
      $('#delete_btn').addClass('btn-default');
    });


    $('#delete_btn').on('click', function () {
      if (confirm('确定删除 ' + cate_name + ' 及其子类别？')) {
        $.ajax({
          type: 'post',
          url: 'server?action=delete',
          dataType: 'json',
          data: {
            'id': cate_id
          },
          success: function (response) {
            if (response.result === 'success') {
              location.reload();
            } else {
              alert(response.result);
            }
          },
          error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(XMLHttpRequest.status);
            alert(XMLHttpRequest.readyState);
            alert(textStatus);
          }
        });
      }
    });
    
    var timeoutID;
    $('#selected_submit_btn').on('click', function () {
      var new_old_cate = $('#new_old_cate_input').val();
      var new_child_cate = $('#new_child_cate_input').val();

      $.ajax({
        type: "post",
        url: "server?action=edit",
        dataType: "json",
        data: {
          'type': '<?php echo $type; ?>',
          'new_old_cate': new_old_cate,
          'new_child_cate': new_child_cate,
          'id': cate_id
        },
        beforeSend: function () {
          if (!new_old_cate) {
            clearTimeout(timeoutID);
            $('#new_old_cate_input').parent().addClass('has-error');
            $('#new_old_cate_input').focus();
            timeoutID = setTimeout(function() {
              $('#new_old_cate_input').parent().removeClass('has-error');
            }, 1000);
            return false;
          }
        },
        success: function (response) {
          if (response.result === 'success') {
            location.reload();
          } else {
            alert(response.result);
          }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          alert(XMLHttpRequest.status);
          alert(XMLHttpRequest.readyState);
          alert(textStatus);
        }
      });
    });

  });
</script>