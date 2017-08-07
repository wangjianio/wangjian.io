<?php
namespace wangjian\wangjianio\projects\money;

require_once __DIR__ . '/AccountInfo.php';

class EditAccount extends AccountInfo
{
    public function printEditForm($a_type)
    {
        $col_name_1 = $this->col_name[$a_type];
        $col_name_2 = $this->col_name['credit_2'];

        $account_info = $this->query('money_view_select', "SELECT * FROM account_$a_type");
        $count = count($account_info);

        echo <<<FORM_START
        <form class="form-horizontal" id="editAccountForm" name="editAccountForm" method="post" action="editor?a_type=$a_type">
FORM_START;

        echo <<<FORM1
        <div class="form-group">
          <label class="col-sm-2 control-label" for="aTypeDescription">类别名称</label>
          <div class="col-sm-10">
            <input class="form-control"
                    id="aTypeDescription"
                    name="a_type_description"
                    type="text"
                    value="{$this->getDescriptionByAccountType($a_type)}"
                    placeholder="输入类别名称">
          </div>
        </div>
FORM1;

        $this->printFormHead($a_type);

        for ($i = 0; $i < $count; $i++) {
            echo <<<HIDDEN
            <div class="form-group">
              <input class="form-control"
                      name="{$a_type}[{$account_info[$i]['a_id']}][a_id]"
                      type="hidden"
                      value="{$account_info[$i]['a_id']}">
              <input class="form-control input-custom-delete"
                      name="{$a_type}[{$account_info[$i]['a_id']}][delete]"
                      type="hidden"
                      value="0">
HIDDEN;


            if ($a_type == 'credit') {
                echo <<<NAME_MONEY
                  <div class="col-xs-4">
                    <input class="form-control"
                           name="{$a_type}[{$account_info[$i]['a_id']}][a_name]"
                           type="text"
                           value="{$account_info[$i]['a_name']}"
                           placeholder="输入名称">
                  </div>

                  <div class="col-xs-4">
                    <input class="form-control"
                           name="{$a_type}[{$account_info[$i]['a_id']}][$col_name_1]"
                           type="number"
                           value="{$account_info[$i][$col_name_1]}"
                           placeholder="输入金额"
                           step="0.01">
                  </div>

                  <div class="col-xs-4">
                    <input class="form-control"
                           name="{$a_type}[{$account_info[$i]['a_id']}][$col_name_2]"
                           type="number"
                           value="{$account_info[$i][$col_name_2]}"
                           placeholder="输入金额"
                           step="0.01">
                  </div>
                  <span class="glyphicon glyphicon-remove pull-right text-danger remove-old"></span>
                </div>
NAME_MONEY;
            } else {
                echo <<<NAME_MONEY
                  <div class="col-xs-6">
                    <input class="form-control"
                           name="{$a_type}[{$account_info[$i]['a_id']}][a_name]"
                           type="text"
                           value="{$account_info[$i]['a_name']}"
                           placeholder="输入名称">
                  </div>
                  <div class="col-xs-6">
                    <input class="form-control"
                           name="{$a_type}[{$account_info[$i]['a_id']}][$col_name_1]"
                           type="number"
                           value="{$account_info[$i][$col_name_1]}"
                           placeholder="输入金额"
                           step="0.01">
                  </div>
                  <span class="glyphicon glyphicon-remove pull-right text-danger remove-old"></span>
                </div>
NAME_MONEY;
            }
        }
        echo '</form>';
    }

    public function updateQuery($username, $sql)
    {
        $this->connect($username);

        if (!$query = $this->mysqli->query($sql)) {
            exit ('Error.' . __FUNCTION__ . __LINE__ . $this->mysqli->error);
        }

        $this->mysqli->close();
    }

    public function printFormHead($a_type)
    {
        $table_head_1 = $this->table_head[$a_type];
        $table_head_2 = $this->table_head['credit_2'];

        if ($a_type == 'credit') {
            echo <<<FORM_HEAD
            <div class="form-group">
              <label class="col-xs-4 control-label" style="text-align: center">账户名称</label>
              <label class="col-xs-4 control-label" style="text-align: center">$table_head_1</label>
              <label class="col-xs-4 control-label" style="text-align: center">$table_head_2</label>
            </div>
FORM_HEAD;
        } else {
            echo <<<FORM_HEAD
            <div class="form-group">
              <label class="col-xs-6 control-label" style="text-align: center">账户名称</label>
              <label class="col-xs-6 control-label" style="text-align: center">$table_head_1</label>
            </div>
FORM_HEAD;
        }
    }
}

$edit_account = new EditAccount;
