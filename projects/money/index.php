<?php
namespace wangjian\wangjianio\projects\money;

require_once __DIR__ . '/includes/IndexTransData.php';
require_once __DIR__ . '/includes/AddTransForm.php';

$title = 'Money - 个人财务管理';
$nav_type = 'money';
$subnav_type = 'index';

$extra_css .= '<link rel="stylesheet" href="/styles/jquery.datetimepicker.css">';
$extra_js = '<script src="/scripts/jquery.datetimepicker.full.min.js"></script>';
$extra_js .= '<script src="scripts/money.js"></script>';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';


// 设定日期的显示
$arr_month = array("无","一","二","三","四","五","六","七","八","九","十","十一","十二");
$arr_week = array("日","一","二","三","四","五","六");

$year = date('Y');
$month = $arr_month[date('n')];
$week = $arr_week[date('N')];
$day = date('d');
?>


  <div class="container">
    <div class="row">
      <!-- 在 sm 及以上屏幕显示在左半侧，在 xs 屏幕上显示 100% 宽度 -->
      <div class="col-xs-12 col-sm-6">
        <div class="row">
          
          <!-- 当前日期 -->
          <div class="col-xs-12 h1" style="width:320px;">
                <span class="pull-left day" style="font-size: 80px; margin-right: 8px;"><?php echo $day; ?></span>
                <span class="pull-left week" style="font-size: 24px; margin-top: 16px;"><?php echo "星期$week"; ?></span>
                <span class="pull-left month" style="font-size: 32px;"><?php echo "{$month}月 $year"; ?></span>
          </div>
              
          <!-- 添加记录按钮，在 md lg 屏幕显示加号 -->
          <a class="pull-right visible-md-inline visible-lg-inline" id="addLink" href data-toggle="modal" data-target="#addTransFormModal" style="position: absolute; right: 15px; top: 20px">
            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true" style="font-size: 80px"></span>
          </a>

        </div><!-- .row -->
        
        <!-- 添加记录按钮，在 sm xm 屏幕显示宽按钮 -->
        <button class="btn btn-primary btn-lg btn-block visible-xs-block visible-sm-block" id="addButton" type="button" data-toggle="modal" data-target="#addTransFormModal" style="margin-bottom: 8px;">
          添加记录
        </button>
        
        <!-- 当日的交易记录 -->
        <?php $index_trans_data->printTable(); ?>

      </div><!-- .col -->

      <!-- 在 sm 及以上屏幕显示在右半侧，在 xs 屏幕上显示 100% 宽度 -->
      <div class="col-xs-12 col-sm-6">
        <div class="page-header">
          <h1>概况</h1>
        </div>
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>借记账户</th>
              <th>980.32</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>工商银行</td>
              <td>100.11</td>
            </tr>
          </tbody>
        </table>
      </div>

    </div><!-- .row -->
  </div><!-- .container -->

  <!-- 添加记录弹出的 modal -->
  <div class="modal fade" id="addTransFormModal" tabindex="-1" role="dialog" aria-labelledby="addTransFormModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <!-- 标题 -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">添加记录：</h4>
        </div>
        <!-- 主体 -->
        <div class="modal-body" style="padding-right: 24px; padding-left: 24px">
          <?php $add_trans_form->printAddTransForm(); ?>
        </div>
        <!-- 按钮 -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          <button type="button" class="btn btn-primary" onclick="submitForm('addTransForm')">提交</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    // 设置日期选择器的默认值为当前时间
    $.datetimepicker.setLocale('zh');
    $('#datetimepicker').datetimepicker({
        value: getNowFormatDate(),
        step: 1
    });
  </script>

  <script>
    // 在关闭 modal 时取消添加按钮的焦点
    $('#addTransFormModal').on('hidden.bs.modal', function (e) {
      window.setTimeout("$('#addLink').blur()", 0);
      window.setTimeout("$('#addButton').blur()", 0);
    })
  </script>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
