<?php
namespace lopedever\money;

include __DIR__ . '/AccountInfo.php';

class EditAccount extends AccountInfo
{
    public function printEditForm($a_type)
    {
        $account_info = $this->query('money_view_select', "SELECT * FROM account_$a_type");
        $count = count($account_info);

        switch ($a_type) {
            case 'asset':
                $col_name = 'asset_balance';
                break;
            case 'credit':
                $col_name = 'credit_debt';
                $col_name_2 = 'credit_limit';
                break;
            case 'debit':
                $col_name = 'debit_balance';
                break;

            default:
                exit('Error.' . __FUNCTION__ . __LINE__);
                break;
        }
        echo <<<FORM_START
        <form class="form-horizontal" id="editAccountForm" name="editAccountForm" method="post" action="editor.php?a_type=$a_type">
FORM_START;

        echo <<<FORM1
        <div class="form-group">
          <label class="col-sm-2 control-label" for="aTypeDescription">类别名称</label>
          <div class="col-sm-10">
            <input class="form-control" 
                    id="aTypeDescription" 
                    name="a_type_description" 
                    type="text" 
                    value="{$this->getAccountTypeDescription($a_type)}"
                    placeholder="输入类别名称">
          </div><!-- .col -->
        </div><!-- .form-group -->
FORM1;

        $this->printFormHead($a_type);

        for ($i = 0; $i < $count; $i++) {
            echo <<<HIDDEN
            <input class="form-control" 
                    name="{$a_type}[{$account_info[$i]['a_id']}][a_id]"
                    type="hidden" 
                    value="{$account_info[$i]['a_id']}">
HIDDEN;


            if ($a_type == 'credit') {
                echo <<<NAME_MONEY
                <div class="form-group">
                  <div class="col-xs-4">
                    <input class="form-control" 
                           name="{$a_type}[{$account_info[$i]['a_id']}][a_name]"
                           type="text" 
                           value="{$account_info[$i]['a_name']}"
                           placeholder="输入名称">
                  </div><!-- .col -->

                  <div class="col-xs-4">
                    <input class="form-control" 
                           name="{$a_type}[{$account_info[$i]['a_id']}][$col_name]"
                           type="number" 
                           value="{$account_info[$i][$col_name]}"
                           placeholder="输入金额"
                           step="0.01">
                  </div><!-- .col -->

                  <div class="col-xs-4">
                    <input class="form-control" 
                           name="{$a_type}[{$account_info[$i]['a_id']}][$col_name_2]"
                           type="number" 
                           value="{$account_info[$i][$col_name_2]}"
                           placeholder="输入金额"
                           step="0.01">
                  </div><!-- .col -->
                </div><!-- .form-group -->
NAME_MONEY;
            } else {
                echo <<<NAME_MONEY
                <div class="form-group">
                  <div class="col-xs-6">
                    <input class="form-control" 
                            name="{$a_type}[{$account_info[$i]['a_id']}][a_name]"
                            type="text" 
                            value="{$account_info[$i]['a_name']}"
                            placeholder="输入名称">
                  </div><!-- .col -->
                  <div class="col-xs-6">
                    <input class="form-control" 
                            name="{$a_type}[{$account_info[$i]['a_id']}][$col_name]"
                            type="number" 
                            value="{$account_info[$i][$col_name]}"
                            placeholder="输入金额"
                            step="0.01">
                  </div><!-- .col -->
                </div><!-- .form-group -->
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
        switch ($a_type) {
            case 'asset':
                $th = '价值';
                break;
            case 'credit':
                $th = '负债';
                $th_2 = '额度';
                break;
            case 'debit':
                $th = '余额';
                break;

            default:
                exit ('Error.PrintInfo.' . __LINE__);
                break;
        }


        if ($a_type == 'credit') {
            echo <<<FORM_HEAD
            <div class="form-group">
              <label class="col-sm-4 control-label" style="text-align: center">账户名称</label>
              <label class="col-sm-4 control-label" style="text-align: center">$th</label>
              <label class="col-sm-4 control-label" style="text-align: center">$th_2</label>
            </div><!-- .form-group -->
FORM_HEAD;
        } else {
            echo <<<FORM_HEAD
            <div class="form-group">
              <label class="col-sm-6 control-label" style="text-align: center">账户名称</label>
              <label class="col-sm-6 control-label" style="text-align: center">$th</label>
            </div><!-- .form-group -->
FORM_HEAD;
        }
    }
}

$edit_account = new EditAccount;
