<?php
namespace wangjian\wangjianio\projects\money;

require_once dirname(__DIR__) . '/includes/AddTransForm.php';

$username = 'money_root';
$add_trans_form->connect($username);

$add_trans_form->printCategoryFormControl('类　别', 'category', 'out');

$add_trans_form->mysqli->close();
