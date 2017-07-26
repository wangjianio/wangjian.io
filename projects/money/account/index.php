<?php
namespace lopedever\money;

include dirname(__DIR__) . '/includes/account/AccountInfo.php';


$title = '账户详情';
$nav_type = 'money';
$subnav_type = 'account';

$extra_js = '<script src="../scripts/money.js"></script>';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<script>

</script>


  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="page-header">
          <h1><?php echo $account_info->getAccountTypeDescription('debit'); ?>
            <small>
              <button class="btn btn-primary btn-xs" id="editButtonDebit" type="button">
                编辑
              </button>
            </small>
          </h1>
        </div>
          <?php $account_info->printTable('debit'); ?>

        <div class="page-header">
          <h1><?php echo $account_info->getAccountTypeDescription('credit'); ?>
            <small>
              <button class="btn btn-primary btn-xs" id="editButtonCredit" type="button">
                编辑
              </button>
            </small>
          </h1>
        </div>
          <?php $account_info->printTable('credit'); ?>

        <div class="page-header">
          <h1><?php echo $account_info->getAccountTypeDescription('asset'); ?>
            <small>
              <button class="btn btn-primary btn-xs" id="editButtonAsset" type="button">
                编辑
              </button>
            </small>
          </h1>
        </div>
          <?php $account_info->printTable('asset'); ?>

      </div><!-- .col -->
    </div><!-- .row -->
  </div><!-- .container -->

  <div class="modal fade" id="editAccountFormModal" tabindex="-1" role="dialog" aria-labelledby="editAccountFormModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">添加记录：</h4>
        </div>
        <div class="modal-body" id="modalBody" style="padding-right: 24px; padding-left: 24px">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          <button type="button" class="btn btn-primary" id="submitButton" onclick="submitForm('editAccountForm')">提交</button>
        </div>
      </div>
    </div>
  </div>

<script>
  $(document).ready(function () {
    $("#editButtonDebit").click(function () {
      $('#modalBody').load('edit.php?a_type=debit');
      $('#editAccountFormModal').modal('show')
    })
    $("#editButtonCredit").click(function () {
      $('#modalBody').load('edit.php?a_type=credit');
      $('#modalBody').load('test.php');
      $('#editAccountFormModal').modal('show')
    })
    $("#editButtonAsset").click(function () {
      $('#modalBody').load('edit.php?a_type=asset');
      $('#editAccountFormModal').modal('show')
    })
  })
</script>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
