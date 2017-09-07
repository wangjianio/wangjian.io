<?php
namespace wangjian\wangjianio\projects\money;

require_once __DIR__ . '/Database.php';

class AddTransForm extends Database
{
    /**
     * 根据数据库输出表单中交易类型选项。
     */
    public function printTransactionTypeSelectOption()
    {
        $username = 'money_root';
        $this->connect($username);

        $sql = 'SELECT t_type, type FROM transaction_type';

        if ($stmt = $this->mysqli->prepare($sql)) {
            $stmt->execute();
            $stmt->bind_result($t_type, $type);
            while ($stmt->fetch()) {
                echo "<option value=\"$t_type\">$type</option>";
            }
            $stmt->close();
        }

        $this->mysqli->close();
    }

    private function printMoneyFormControl($label, $name)
    {
        $id = $name;

        echo <<<FORM_T_MONEY
        <div class="form-group">
            <label class="col-sm-2 control-label" for="$id">$label</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-yen"></span>
                    </span>
                    <input class="form-control"
                        id="$id"
                        name="$name"
                        type="number"
                        placeholder="0.00"
                        step="0.01">
                </div>
            </div>
        </div>
FORM_T_MONEY;
    }

    private function printLocationFormControl($label, $name)
    {
        $id = $name;

        echo <<<FORM_LOCATION_AGENT
        <div class="form-group">
            <label class="col-sm-2 control-label" for="$id">$label</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-map-marker"></span>
                    </span>
                    <input class="form-control" id="$id" name="$name" type="text" placeholder="选填">
                </div>
            </div>
        </div>
FORM_LOCATION_AGENT;
    }

    private function printAgentFormControl($label, $name)
    {
        $id = $name;

        echo <<<FORM_AGENT
        <div class="form-group">
            <label class="col-sm-2 control-label" for="$id">$label</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-user"></span>
                    </span>
                    <input class="form-control" id="$id" name="$name" type="text" placeholder="选填">
                </div>
            </div>
        </div>
FORM_AGENT;
    }

    private function printAccountFormControl($label, $name, $icon = 'glyphicon-credit-card')
    {
        $id = $name;

        echo <<<FORM_ACCOUNT
        <div class="form-group">
            <label class="col-sm-2 control-label" for="$id">$label</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon $icon"></span>
                    </span>
                    <select class="form-control selectpicker" id="$id" name="$name" data-mobile="true">
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
                </div>
            </div>
        </div>
FORM_ACCOUNT;
    }

    public function printCategoryFormControl($label, $name, $type, $cate_1 = null, $cate_2 = null, $cate_3 = null)
    {
        if ($type !== 'out' && $type !== 'in') { exit; }

        $name = $name . '_1';
        $id = $name;

        echo <<<FORM_CATEGORY
        <div class="form-group">
            <label class="col-sm-2 control-label" for="$id">$label</label>
            <div class="col-sm-10">
                <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </span>
                <select class="form-control selectpicker category" id="$id" name="$name" data-mobile="true">
                    <option class="preselect">请选择</option>
FORM_CATEGORY;

        $sql = "SELECT {$type}_1 FROM category_$type GROUP BY {$type}_1";
        if ($stmt = $this->mysqli->prepare($sql)) {
            $stmt->execute();
            $stmt->bind_result($cate_1);
            while ($stmt->fetch()) {
            echo "<option value='$cate_1'>$cate_1</option>";
            }
            $stmt->close();
        }

        echo <<<FORM_CATEGORY
                    </select>
                </div>
            </div>
        </div>
FORM_CATEGORY;
    }

    public function printDynamicFormControl($t_type)
    {
        // $username = 'money_root';
        // $this->connect($username);

        switch ($t_type) {
            case 'out':
                $this->printAccountFormControl('账　户', 'a_name_minus');
                $this->printCategoryFormControl('类　别', 'category', 'out');
                $this->printMoneyFormControl('金　额', 't_money');
                $this->printLocationFormControl('地　点', 't_location');
                $this->printAgentFormControl('相关人', 't_agent');
                break;
            case 'in':
                $this->printAccountFormControl('账　户', 'a_name_plus');
                $this->printCategoryFormControl('类　别', 'category', 'in');
                $this->printMoneyFormControl('金　额', 't_money');
                $this->printLocationFormControl('地　点', 't_location');
                $this->printAgentFormControl('相关人', 't_agent');
                break;
            case 'transfer':
                $this->printAccountFormControl('付款账户', 'a_name_minus', 'glyphicon glyphicon-export');
                $this->printAccountFormControl('收款账户', 'a_name_plus', 'glyphicon glyphicon-import');
                $this->printMoneyFormControl('金　额', 't_money');
                $this->printMoneyFormControl('手续费', 't_fee');
                break;
            case 'money_to_value':
                $this->printAccountFormControl('付款账户', 'a_name_minus');
                $this->printAccountFormControl('资产账户', 'a_name_plus', 'glyphicon-piggy-bank');
                $this->printMoneyFormControl('金　额', 't_money');
                $this->printMoneyFormControl('手续费', 't_fee');
                break;
            case 'value_to_money':
                $this->printAccountFormControl('收款账户', 'a_name_plus');
                $this->printAccountFormControl('资产账户', 'a_name_minus', 'glyphicon-piggy-bank');
                $this->printMoneyFormControl('卖出资产', 't_money');
                $this->printMoneyFormControl('收入金额', 't_fee');
                break;
            case 'debt_to_money':
                $this->printAccountFormControl('账　户', 'a_name_plus');
                $this->printAccountFormControl('负　债', 'a_name_minus', 'glyphicon-flash');
                $this->printMoneyFormControl('金　额', 't_money');
                $this->printAgentFormControl('相关人', 't_agent');
                $this->printLocationFormControl('地　点', 't_location');
                break;
            case 'money_to_debt':
                $this->printAccountFormControl('账　户', 'a_name_minus');
                $this->printAccountFormControl('负　债', 'a_name_plus', 'glyphicon-flash');
                $this->printMoneyFormControl('本　金', 't_money');
                $this->printMoneyFormControl('利　息', 't_money');
                $this->printMoneyFormControl('额外还款', 't_money');
                $this->printMoneyFormControl('总　计', 't_money');
                $this->printLocationFormControl('地　点', 't_location');
                break;

            default:
                # code...
                break;
        }

        // $this->mysqli->close();
    }

}
