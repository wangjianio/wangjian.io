<?php
namespace lopedever\money;

class PrintAddTransForm extends Database
{
    public function printAddTransForm()
    {
        $username = 'money_root';
        $this->connect($username);

        echo <<<FORM_START
        <form id="addTransForm" name="addTransForm" method="post" action="transaction/add.php">
        <h3>添加记录：</h3>
FORM_START;

        echo <<<FORM_T_TYPE
        <label>类　型：
            <select name="t_type">
                <option value="out" selected>支出</option>
                <option value="in">收入</option>
                <option value="transfer">转账</option>
            </select>
        </label><br>
FORM_T_TYPE;

        echo <<<FORM_ACCOUNT
        <label>账　户：
            <select name="a_name">
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
        </label><br>
FORM_ACCOUNT;

        echo <<<FORM_T_DATETIME
        <label>时　间：
            <input name="t_datetime" type="text" id="datetimepicker"/>
        </label><br>
FORM_T_DATETIME;

        echo <<<FORM_T_MONEY
        <label>金　额：
            <input name="t_money"
                type="number"
                placeholder="输入金额"
                step="0.01">
        </label><br>
FORM_T_MONEY;

        echo <<<FORM_CATEGORY
        <label>类　别：
            <select name="category">
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
        </label><br>
FORM_CATEGORY;

        echo <<<FORM_LOCATION_AGENT_REMARK
        <label>地　点：
            <input name="t_location" type="text" placeholder="选填">
        </label><br>
        <label>相关人：
            <input name="t_agent" type="text" placeholder="选填">
        </label><br>
        <label>备　注：
            <input name="t_remark" type="text" placeholder="选填">
        </label>
FORM_LOCATION_AGENT_REMARK;
        echo '</form>';
        $this->mysqli->close();
    }
}

$print_add_trans_form = new PrintAddTransForm;
