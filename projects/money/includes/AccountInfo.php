<?php
namespace wangjian\wangjianio\projects\money;

require_once __DIR__ . '/DataQuery.php';

/**
 * 输出信息的类。
 * a_type 表示 account_type 即 账户类型。
 */
class AccountInfo extends DataQuery
{

    public $table_head = [
        "asset"    => "价值",
        "credit"   => "负债",
        "credit_2" => "额度",
        "debit"    => "余额",
    ];

    public $col_name = [
        "asset"    => "asset_balance",
        "credit"   => "credit_debt",
        "credit_2" => "credit_limit",
        "debit"    => "debit_balance",
    ];

    public $database_table = [
        "asset"  => "account_asset",
        "credit" => "account_credit",
        "debit"  => "account_debit",
    ];

    /**
     * 根据账户类型查询显示名称。
     *
     * @param string $a_type 账户类型[asset | credit | debit]。
     * @return string $description 查询结果。
     */
    public function getDescriptionByAccountType($a_type)
    {
        if ($a_type == 'asset' || $a_type == 'credit' || $a_type == 'debit') {
            $description = $this->query('money_table_account_type', "SELECT description FROM account_type WHERE a_type = '$a_type'");
            return $description[0][0];
        } else {
            exit('Error.' . __FUNCTION__ . __LINE__);
        }
    }

    public function printAccountInfo($a_type)
    {
        echo <<< A
        <div class="page-header">
          <h1>{$this->getDescriptionByAccountType($a_type)}
            <small><button class="btn btn-primary btn-xs" id="{$a_type}EditBtn" type="button">编辑</button></small>
          </h1>
        </div>
A;
        $this->printTable($a_type);
    }

    public function printTable($a_type)
    {
        echo '<table class="table table-hover table-bordered">';
        $this->printTableHead($a_type);
        $this->printTableFoot($a_type);
        $this->printTableBody($a_type);
        echo '</table>';
    }

    public function printTableHead($a_type)
    {
        $table_head_1 = $this->table_head[$a_type];
        $table_head_2 = $this->table_head['credit_2'];

        echo "<thead>";
        echo "<tr>";
        echo '<th width="40%">账户名称</th>';
        echo "<th>$table_head_1</th>";

        if ($a_type == 'credit') {
            echo "<th>$table_head_2</th>";
        }

        echo "</tr>";
        echo "</thead>";
    }

    public function printTableFoot($a_type)
    {
        $col_name_1     = $this->col_name[$a_type];
        $col_name_2     = $this->col_name['credit_2'];
        $database_table = $this->database_table[$a_type];

        $sum = $this->sqlFunc($database_table, $col_name_1, 'SUM');

        echo "<tfoot>";
        echo "<tr>";
        echo '<th class="text-right">合计</th>';
        echo "<td class=\"text-right\">$sum</td>";

        if ($a_type == 'credit') {
            $sum_2 = $this->sqlFunc($database_table, $col_name_2, 'SUM');
            echo "<td class=\"text-right\">$sum_2</td>";
        }

        echo "</tr>";
        echo "</tfoot>";
    }

    public function printTableBody($a_type)
    {
        $col_name_1 = $this->col_name[$a_type];
        $col_name_2 = $this->col_name['credit_2'];

        $info = $this->query('money_view_select', "SELECT * FROM account_$a_type");
        $count = count($info);

        echo "<tbody>";
        for ($i = 0; $i < $count; $i++) {
            echo '<tr>';
            echo "<td>{$info[$i]['a_name']}</td>";
            echo "<td class=\"text-right\">{$info[$i][$col_name_1]}</td>";

            if ($a_type == 'credit') {
                echo "<td class=\"text-right\" width=\"30%\">{$info[$i][$col_name_2]}</td>";
            }

            echo '</tr>';
        }
        echo "</tbody>";
    }

}

$account_info = new AccountInfo;
