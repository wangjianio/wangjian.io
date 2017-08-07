<?php
namespace wangjian\wangjianio\projects\money;

require_once dirname(__DIR__) . '/includes/AccountInfo.php';

$title = '账户详情';
$nav_type = 'money';
$subnav_type = 'account';

$extra_js = '<script src="../scripts/money.js"></script>';
$extra_css = '<link rel="stylesheet" href="edit.css">';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

  <div class="container">
    <div class="row">
      <div class="col-xs-12">

        <!-- 借记账户 -->
        <?php $account_info->printAccountInfo('debit'); ?>
        <!-- 借贷账户 -->
        <?php $account_info->printAccountInfo('credit'); ?>
        <!-- 资产账户 -->
        <?php $account_info->printAccountInfo('asset'); ?>

      </div><!-- .col -->
    </div><!-- .row -->
  </div><!-- .container -->

  <!-- 编辑账户信息 modal -->
  <div class="modal fade" id="editAccountFormModal" tabindex="-1" role="dialog" aria-labelledby="editAccountFormModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <!-- 标题 -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">添加记录：</h4>
        </div>
        <!-- 主体 -->
        <div class="modal-body" id="modalBody" style="padding-right: 24px; padding-left: 24px; margin:16px">
          <!-- 根据点击的按钮用 js 动态载入表单 -->
        </div>
        <!-- 按钮 -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          <button type="button" class="btn btn-primary" onclick="checkInput()">提交</button>
        </div>
      </div>
    </div>
  </div>

<script>
  // 载入编辑表单代码
  $(document).ready(function () {
    $("#debitEditBtn").click(function () {
      $('#modalBody').load('edit.php?a_type=debit');
      $('#editAccountFormModal').modal('show')
    })

    $("#creditEditBtn").click(function () {
      $('#modalBody').load('edit.php?a_type=credit');
      $('#editAccountFormModal').modal('show')
    })

    $("#assetEditBtn").click(function () {
      $('#modalBody').load('edit.php?a_type=asset');
      $('#editAccountFormModal').modal('show')
    })
  })
</script>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
