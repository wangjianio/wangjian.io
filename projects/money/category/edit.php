<?php
namespace wangjian\wangjianio\projects\money;

require_once dirname(__DIR__) . '/includes/Common.php';
require_once dirname(__DIR__) . '/includes/Database.php';

$c_id = $_GET['c_id'];

if (!isset($c_id) || !is_numeric($c_id)) {
  header('location: index');
}

$common = new Common;

$common->checkSession();
$u_id = $_SESSION['u_id'];

$database = new Database;
$username = 'money_root';
$database->connect($username);
$mysqli = $database->mysqli;

$sql = "SELECT t_type_id, c_name FROM category WHERE c_id = ? AND u_id = ?";

if ($stmt = $mysqli->prepare($sql)) {

    $stmt->bind_param("ii", $c_id, $u_id);
    $stmt->execute();
    $stmt->bind_result($t_type_id, $c_name);
    $stmt->fetch();
    $stmt->close();
}

$mysqli->close();

?>

<div class="form-group">
  <label class="h4" for="input-new-old-cate" style="margin-bottom: 15px">修改类别名：</label>
  <input class="form-control" id="input-new-old-cate" type="text" placeholder="必填" autocomplete="off" value="<?php echo $c_name; ?>">
</div>

<div class="form-group">
  <label class="h4" for="input-new-child-cate" style="margin-bottom: 15px">新增子类别：</label>
  <input class="form-control" id="input-new-child-cate" type="text" placeholder="请输入子类别名，不新增请留空" autocomplete="off">
</div>

<hr>

<button class="btn btn-success btn-block hidden" id="btn-submit-selected" type="submit">提交</button>
<button class="btn btn-danger btn-block" id="btn-delete" type="button">删除</button>

<script>
  $(document).ready(function () {
    $('input').on('input propertychange', function () {
      $('#btn-submit-selected').removeClass('hidden');
      $('#btn-delete').removeClass('btn-danger');
      $('#btn-delete').addClass('btn-default');
    });


    $('#btn-delete').on('click', function () {
      // c_name 全局变量，来自 index
      if (confirm('确定删除 ' + c_name + ' 及其子类别？')) {
        $.ajax({
          type: 'post',
          url: 'server?action=delete',
          dataType: 'json',
          data: {
            'c_id': c_id
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
    $('#btn-submit-selected').on('click', function () {
      var new_old_cate = $('#input-new-old-cate').val();
      var new_child_cate = $('#input-new-child-cate').val();

      $.ajax({
        type: "post",
        url: "server?action=edit",
        dataType: "json",
        data: {
          't_type_id': '<?php echo $t_type_id; ?>',
          'new_old_cate': new_old_cate,
          'new_child_cate': new_child_cate,
          'c_id': c_id
        },
        beforeSend: function () {
          if (!new_old_cate) {
            clearTimeout(timeoutID);
            $('#input-new-old-cate').parent().addClass('has-error');
            $('#input-new-old-cate').focus();
            timeoutID = setTimeout(function() {
              $('#input-new-old-cate').parent().removeClass('has-error');
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