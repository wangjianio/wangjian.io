<?php
namespace wangjian\wangjianio\projects\money;

require_once dirname(__DIR__) . '/includes/Common.php';
require_once dirname(__DIR__) . '/includes/Database.php';

// 检查 Session
$common = new Common;
$common->checkSession();

$u_id = $_SESSION['u_id'];

// 连接数据库
$database = new Database;
$username = 'money_root';
$database->connect($username);
$mysqli = $database->mysqli;

$title = '账户详情';
$nav_type = 'money';
$subnav_type = 'account';

$extra_js  = '<script src="../scripts/money.js"></script>';
$extra_css = '<link rel="stylesheet" href="../styles/money.css">';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

  <div class="container">
    <div class="row">
      <div class="col-xs-12">

        <!-- 借记账户 -->
        <div class="page-header">
          <h1>借记账户
            <small><button class="btn btn-primary btn-xs" type="button" onclick="loadForm('1')">编辑</button></small>
          </h1>
        </div>
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center" width="40%">账户名称</th>
              <th class="text-center">余额</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-right">合计</th>
              <td class="text-right" id="sum-1"></td>
            </tr>
          </tfoot>
          <tbody id="tbody-1"></tbody>
        </table>

        <!-- 借贷账户 -->
        <div class="page-header">
          <h1>借贷账户
            <small><button class="btn btn-primary btn-xs" type="button" onclick="loadForm('2')">编辑</button></small>
          </h1>
        </div>
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center" width="40%">账户名称</th>
              <th class="text-center" width="30%">欠款</th>
              <th class="text-center">额度</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-right">合计</th>
              <td class="text-right" id="sum-2"></td>
              <td class="text-right" id="sum-3"></td>
            </tr>
          </tfoot>
          <tbody id="tbody-2"></tbody>
        </table>

        <!-- 资产负债 -->
        <div class="page-header">
          <h1>资产负债
            <small><button class="btn btn-primary btn-xs" type="button" onclick="loadForm('3')">编辑</button></small>
          </h1>
        </div>
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center" width="40%">账户名称</th>
              <th class="text-center">价值</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-right">合计</th>
              <td class="text-right" id="sum-4"></td>
            </tr>
          </tfoot>
          <tbody id="tbody-3"></tbody>
        </table>
        
        <table class="table table-hover table-bordered">
          <tfoot>
            <tr>
              <th class="text-right" width="40%">合计</th>
              <td class="text-right" id="sum-5"></td>
            </tr>
          </tfoot>
          <tbody id="tbody-4"></tbody>
        </table>

      </div><!-- col -->
    </div><!-- row -->
  </div><!-- container -->

  <!-- 编辑账户信息 modal -->
  <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <!-- 标题 -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">添加记录：</h4>
        </div>
        <!-- 主体 -->
        <div class="modal-body" id="modal-body" style="padding-right: 24px; padding-left: 24px; margin:16px">
          <!-- 根据点击的按钮用 js 动态载入表单 -->
        </div>
        <!-- 按钮 -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
          <button class="btn btn-primary" id="btn-submit" type="button" onclick="$('#form-account-edit').submit()">保存</button>
        </div>
      </div>
    </div>
  </div>

<script>
  $(function () {
    $.ajax({
      url: "json",
      dataType: "json",
      success: function (response) {
        json = response;
        parseJSON(json);
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert(XMLHttpRequest.status);
        alert(XMLHttpRequest.readyState);
        alert(textStatus);
      }
    });
  });

  function loadForm(a_type_id) {
      $('#modal-body').load('edit?a_type_id='+a_type_id);
      $('#modal-form').modal('show');
  }

  function parseJSON(json) {
    
    var sum_1 = 0;
    var sum_2 = 0;
    var sum_3 = 0;
    var sum_4 = 0;
    var sum_5 = 0;

    for (var key in json) {
      if (json.hasOwnProperty(key)) {
        var a_id = json[key].a_id;
        var a_name = json[key].a_name;
        var a_type_id = json[key].a_type_id;
        var money_1 = json[key].money_1;
        var money_2 = json[key].money_2;

        switch (a_type_id) {
          case 1:
            $('#tbody-1').append('\
              <tr>\
                <td>' + a_name + '</td>\
                <td class="text-right">' + money_1 + '</td>\
              </tr>');
            sum_1 += parseFloat(money_1);
            break;
            
          case 2:
            $('#tbody-2').append('\
              <tr>\
                <td>' + a_name + '</td>\
                <td class="text-right">' + money_1 + '</td>\
                <td class="text-right">' + money_2 + '</td>\
              </tr>');
            sum_2 += parseFloat(money_1);
            sum_3 += parseFloat(money_2);
            break;

          case 3:
            if (money_1 > 0) {
              $('#tbody-3').append('\
                <tr>\
                  <td>' + a_name + '</td>\
                  <td class="text-right">' + money_1 + '</td>\
                </tr>');
              sum_4 += parseFloat(money_1);
            } else if (money_1 < 0) {
              $('#tbody-4').append('\
                <tr>\
                  <td>' + a_name + '</td>\
                  <td class="text-right">' + money_1 + '</td>\
                </tr>');
              sum_5 += parseFloat(money_1);
            }
            break;
        
          default:
            break;
        }
      }
    }

    $('#sum-1').append(sum_1.toFixed(2));
    $('#sum-2').append(sum_2.toFixed(2));
    $('#sum-3').append(sum_3.toFixed(2));
    $('#sum-4').append(sum_4.toFixed(2));
    $('#sum-5').append(sum_5.toFixed(2));
  }
</script>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
