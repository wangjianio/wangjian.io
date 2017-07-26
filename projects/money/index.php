<?php
namespace lopedever\money;

include __DIR__ . '/includes/database/database.php';
include __DIR__ . '/includes/index/PrintIndexTransData.php';
include __DIR__ . '/includes/index/PrintAddTransForm.php';

$title = 'Money - 个人财务管理';
$nav_type = 'money';
$subnav_type = 'index';

$extra_css .= '<link rel="stylesheet" href="/styles/jquery.datetimepicker.css">';
$extra_js = '<script src="/scripts/jquery.datetimepicker.full.min.js"></script>';

$extra_js .= '<script src="scripts/money.js"></script>';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

$year = date('Y');
$month = date('n');
switch ($month) {
  case '1':
    $month = '一月';
    break;
  case '2':
    $month = '二月';
    break;
  case '3':
    $month = '三月';
    break;
  case '4':
    $month = '四月';
    break;
  case '5':
    $month = '五月';
    break;
  case '6':
    $month = '六月';
    break;
  case '7':
    $month = '七月';
    break;
  case '8':
    $month = '八月';
    break;
  case '9':
    $month = '九月';
    break;
  case '10':
    $month = '十月';
    break;
  case '11':
    $month = '十一月';
    break;
  case '12':
    $month = '十二月';
    break;

  default:
    break;
}
$week = date('N');
switch ($week) {
  case '1':
    $week = '星期一';
    break;
  case '2':
    $week = '星期二';
    break;
  case '3':
    $week = '星期三';
    break;
  case '4':
    $week = '星期四';
    break;
  case '5':
    $week = '星期五';
    break;
  case '6':
    $week = '星期六';
    break;
  case '7':
    $week = '星期日';
    break;

  default:
    break;
}
$day = date('d');
?>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <div class="row">
          <div class="col-xs-12 h1" style="width:320px;">
                <span class="pull-left day" style="font-size: 80px; margin-right: 8px;"><?php echo $day; ?></span>
                <span class="pull-left week" style="font-size: 24px; margin-top: 16px;"><?php echo $week; ?></span>
                <span class="pull-left month" style="font-size: 32px;"><?php echo "$month $year"; ?></span>
          </div>
          <a class="pull-right hidden-xs hidden-sm" id="addLink" href data-toggle="modal" data-target="#addTransFormModal" style="position: absolute; right: 15px; top: 20px">
            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true" style="font-size: 80px"></span>
          </a>
        </div><!-- .row -->
        <button class="btn btn-primary btn-lg btn-block hidden-md hidden-lg" id="addButton" type="button" data-toggle="modal" data-target="#addTransFormModal" style="margin-bottom: 8px;">
          添加记录
        </button>
<?php $print_index_trans_data->printTable(); ?>
      </div><!-- .col -->

      <div class="col-xs-12 col-sm-6">
        <div class="page-header">
          <h1>概况</h1>
        </div>
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>借记账户</th>
              <th class="money">980.32</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>工商银行</td>
              <td class="money">100.11</td>
            </tr>
          </tbody>
        </table>
      </div>

    </div><!-- .row -->
  </div><!-- .container -->

  <!-- Modal -->
  <div class="modal fade" id="addTransFormModal" tabindex="-1" role="dialog" aria-labelledby="addTransFormModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">添加记录：</h4>
        </div>
        <div class="modal-body" style="padding-right: 24px; padding-left: 24px">
          <?php $print_add_trans_form->printAddTransForm(); ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          <button type="button" class="btn btn-primary" onclick="submitForm('addTransForm')">提交</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $.datetimepicker.setLocale('zh');
    $('#datetimepicker').datetimepicker({
        value: getNowFormatDate(),
        step: 1
    });
  </script>
  <script>
  $('#addTransFormModal').on('hidden.bs.modal', function (e) {
    window.setTimeout("$('#addLink').blur()", 0);
    window.setTimeout("$('#addButton').blur()", 0);
  })
  </script>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
