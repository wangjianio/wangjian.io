<?php
namespace wangjian\wangjianio\projects\money;

require_once dirname(__DIR__) . '/includes/EditAccount.php';

if (count($_GET) != 1) { exit; }

$a_type = key($_GET);

if ($a_type == 'asset' || $a_type == 'credit' || $a_type == 'debit') {
    
    $edit_account->printEditForm($a_type);

    echo <<<BTN
    <button type="button" class="btn btn-success btn-block" onclick="appendAddForm('$a_type')">新增</button>
BTN;
    echo '<script src="../scripts/account.js"></script>';
}
