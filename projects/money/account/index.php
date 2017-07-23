<?php
namespace lopedever\money;

include dirname(__DIR__) . '/includes/account/AccountInfo.php';

?>
<!DOCTYPE html>
<html>

<head>
  <title>账户详情</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../styles/account/index.css">
  <script src="../scripts/account.js"></script>
  <script>
    function iframeFormSubmit(iframeId, formId) {
        var i = document.getElementById(iframeId).contentDocument;
        i.getElementById(formId).submit();
    }
  </script>
</head>

<body>

<?php include dirname(__DIR__) . '/includes/header.php'; ?>

  <div class="content">
    <div class="account-info">
      <h2><?php echo $account_info->getAccountTypeDescription('debit'); ?></h2>
      <a class="edit" href="javascript:void(0)" onclick="ShowDiv('hideDiv', 'debit')">[编辑]</a>
      <?php $account_info->printTable('debit'); ?>

      <h2>
        <?php echo $account_info->getAccountTypeDescription('credit'); ?></h2>
        <a class="edit" href="javascript:void(0)" onclick="ShowDiv('hideDiv', 'credit')">[编辑]</a>
      <?php $account_info->printTable('credit'); ?>

      <h2>
        <?php echo $account_info->getAccountTypeDescription('asset'); ?></h2>
        <a class="edit" href="javascript:void(0)" onclick="ShowDiv('hideDiv', 'asset')">[编辑]</a>
      <?php $account_info->printTable('asset'); ?>
    </div>
  </div>

  <div id="hideDiv">
    <div id="bgDiv">
      <div id="editDiv">
        <iframe id="iframe" frameborder="0"></iframe>
        <div class="button">
          <span class="submit" onclick="iframeFormSubmit('iframe', 'edit_account'); CloseDiv('hideDiv', 1);">保存</span>
          <span class="close" onclick="CloseDiv('hideDiv')">关闭</span>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
