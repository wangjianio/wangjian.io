<?php
namespace lopedever\money;

class PrintAddTransForm extends Database
{
    public function printAddTransForm()
    {
        $username = 'money_root';
        $this->connect($username);

        echo <<<FORM_START
        <form class="form-horizontal" id="addTransForm" name="addTransForm" method="post" action="transaction/add.php">
FORM_START;

        echo <<<FORM_T_TYPE
        <div class="form-group">
          <label class="col-sm-2 control-label" for="t_type" style="text-align: left">类　型：</label>
          <div class="col-sm-10">
            <select class="form-control" id="t_type" name="t_type">
              <option value="out" selected>支出</option>
              <option value="in">收入</option>
              <option value="transfer">转账</option>
            </select>
          </div><!-- .col -->
        </div><!-- .form-group -->
FORM_T_TYPE;

        echo <<<FORM_ACCOUNT
        <div class="form-group">
          <label class="col-sm-2 control-label" for="a_name" style="text-align: left">账　户：</label>
          <div class="col-sm-10">
            <select class="form-control" id="a_name" name="a_name">
FORM_ACCOUNT;

        $sql = "SELECT a_name FROM account WHERE a_type != 'asset'";
        if ($stmt = $this->mysqli->prepare($sql)) {
            $stmt->execute();
            $stmt->bind_result($a_name);
            while ($stmt->fetch()) {
            echo "<option value='$a_name'>$a_name</option>";
            }
            $stmt->close();
        }

        echo <<<FORM_ACCOUNT
            </select>
          </div><!-- .col -->
        </div><!-- .form-group -->
FORM_ACCOUNT;

        echo <<<FORM_T_DATETIME
        <div class="form-group">
          <label class="col-sm-2 control-label" for="datetimepicker" style="text-align: left">时　间：</label>
          <div class="col-sm-10">
            <input class="form-control" id="datetimepicker" name="t_datetime" type="text" placeholder="2017/01/01 00:00">
          </div><!-- .col -->
        </div><!-- .form-group -->
FORM_T_DATETIME;

        echo <<<FORM_T_MONEY
        <div class="form-group">
          <label class="col-sm-2 control-label" for="t_money" style="text-align: left">金　额：</label>
          <div class="col-sm-10">
            <input class="form-control"
                   id="t_money"
                   name="t_money"
                   type="number"
                   placeholder="0.00"
                   step="0.01">
          </div><!-- .col -->
        </div><!-- .form-group -->
FORM_T_MONEY;

        echo <<<FORM_CATEGORY
        <div class="form-group">
          <label class="col-sm-2 control-label" for="category" style="text-align: left">类　别：</label>
          <div class="col-sm-10">
            <select class="form-control" id="category" name="category">
FORM_CATEGORY;

        $sql = 'SELECT out_1 FROM category_out GROUP BY out_1';
        if ($stmt = $this->mysqli->prepare($sql)) {
            $stmt->execute();
            $stmt->bind_result($out_1);
            while ($stmt->fetch()) {
            echo "<option value='$out_1'>$out_1</option>";
            }
            $stmt->close();
        }

        echo <<<FORM_CATEGORY
            </select>
          </div><!-- .col -->
        </div><!-- .form-group -->
FORM_CATEGORY;

        echo <<<FORM_LOCATION_AGENT_REMARK
        <div class="form-group">
          <label class="col-sm-2 control-label" for="t_location" style="text-align: left">地　点：</label>
          <div class="col-sm-10">
            <input class="form-control" id="t_location" name="t_location" type="text" placeholder="选填">
          </div><!-- .col -->
        </div><!-- .form-group -->

        <div class="form-group">
          <label class="col-sm-2 control-label" for="t_agent" style="text-align: left">相关人：</label>
          <div class="col-sm-10">
            <input class="form-control" id="t_agent" name="t_agent" type="text" placeholder="选填">
          </div><!-- .col -->
        </div><!-- .form-group -->

        <div class="form-group">
          <label class="col-sm-2 control-label" for="t_remark" style="text-align: left">备　注：</label>
          <div class="col-sm-10">
            <input class="form-control" id="t_remark" name="t_remark" type="text" placeholder="选填">
          </div><!-- .col -->
        </div><!-- .form-group -->
FORM_LOCATION_AGENT_REMARK;
        echo '</form>';
        $this->mysqli->close();
    }
}

$print_add_trans_form = new PrintAddTransForm;
