<?php
namespace lopedever\money;

include dirname(__DIR__) . '/database/DataQuery.php';

/**
 * 输出信息的类。
 */
class AccountInfo extends DataQuery
{

    /**
     * 根据账户类型查询显示名称。
     *
     * @param string $a_type 账户类型[asset | credit | debit]。
     * @return string $description 查询结果。
     */
    public function getAccountTypeDescription($a_type)
    {
        if ($a_type == 'asset' || $a_type == 'credit' || $a_type == 'debit') {
            $account_type = $this->query('money_table_account_type', "SELECT description FROM account_type WHERE a_type = '$a_type'");
            return $account_type[0][0];
        } else {
            exit;
        }
    }

    public function printTable($a_type)
    {
        echo '<table>';
        $this->printTableHead($a_type);
        $this->printTableFoot($a_type);
        $this->printTableBody($a_type);
        echo '</table>';
    }

    public function printTableHead($a_type)
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

        echo "<thead>";
        echo "<tr>";
        echo "<th>账户名称</th>";
        echo "<th>$th</th>";

        if ($a_type == 'credit') {
            echo "<th>$th_2</th>";
        }
        echo "</tr>";
        echo "</thead>";
    }

    public function printTableFoot($a_type)
    {
        switch ($a_type) {
            case 'asset':
                $col_name = 'asset_balance';
                $db_table = 'account_asset';
                break;
            case 'credit':
                $col_name = 'credit_debt';
                $col_name_2 = 'credit_limit';
                $db_table = 'account_credit';
                break;
            case 'debit':
                $col_name = 'debit_balance';
                $db_table = 'account_debit';
                break;

            default:
                exit ('Error.PrintInfo.' . __LINE__);
                break;
        }

        $sum = $this->sqlFunc($db_table, $col_name, 'SUM');

        echo "<tfoot>";
        echo "<tr>";
        echo '<th class="sum">合计</th>';
        echo "<td class=\"money\">$sum</td>";

        if ($a_type == 'credit') {
            $sum_2 = $this->sqlFunc($db_table, $col_name_2, 'SUM');
            echo "<td class=\"money\">$sum_2</td>";
        }

        echo "</tr>";
        echo "</tfoot>";
    }

    public function printTableBody($a_type)
    {
        $info = $this->query('money_view_select', "SELECT * FROM account_$a_type");
        $count = count($info);

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
                exit ('Error.PrintInfo.' . __LINE__);
                break;
        }

        echo "<tbody>";
        for ($i = 0; $i < $count; $i++) {
            echo '<tr>';
            echo '<td class="a_name">' . $info[$i]['a_name'] . '</td>';
            echo '<td class="money">' . $info[$i][$col_name] . '</td>';

            if ($a_type == 'credit') {
                echo '<td class="money">' . $info[$i][$col_name_2] . '</td>';
            }

            echo '</tr>';
        }
        echo "</tbody>";
    }

}

$account_info = new AccountInfo;
