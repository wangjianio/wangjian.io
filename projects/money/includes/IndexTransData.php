<?php
namespace wangjian\wangjianio\projects\money;

require_once __DIR__ . '/Database.php';

class IndexTransData extends Database
{
    public function printTable()
    {
        echo '<table class="table table-hover table-bordered">';
        $this->printTableHead();
        $this->printTableFoot();
        $this->printTableBody();
        echo '</table>';
    }

    public function printTableHead() {}

    public function printTableFoot()
    {
        $username = 'money_root';

        $this->connect($username);

        echo 'bb';
        
        $sql = "SELECT SUM(t_money) FROM transaction WHERE to_days(t_datetime) = to_days(now()) AND t_type = 'in'";
        if ($stmt = $this->mysqli->prepare($sql)) {
            $stmt->execute();
            $stmt->bind_result($in_money);
            $stmt->fetch();
            $stmt->close();
        }
        
        $sql = "SELECT SUM(t_money) FROM transaction WHERE to_days(t_datetime) = to_days(now()) AND t_type = 'out'";
        if ($stmt = $this->mysqli->prepare($sql)) {
            $stmt->execute();
            $stmt->bind_result($out_money);
            $stmt->fetch();
            $stmt->close();
        }
        $this->mysqli->close();

        $in_money = sprintf("%.2f", $in_money);
        $out_money = sprintf("%.2f", $out_money);

        if ($in_money != 0 && $out_money != 0) {
            echo <<<TFOOT
            <tfoot>
            <tr>
                <td class="sum">总支出<br>总收入</td>
                <td>$out_money<br>$in_money</td>
            </tr>
            </tfoot>
TFOOT;
        } else if ($in_money == 0 && $out_money == 0) {

        } else if ($in_money == 0 && $out_money != 0) {
            echo <<<TFOOT
            <tfoot>
            <tr>
                <td class="sum">总支出</td>
                <td>$out_money</td>
            </tr>
            </tfoot>
TFOOT;
        } else if ($in_money != 0 && $out_money == 0) {
            echo <<<TFOOT
            <tfoot>
            <tr>
                <td class="sum">总收入</td>
                <td>$in_money</td>
            </tr>
            </tfoot>
TFOOT;
        }



    }

    public function printTableBody()
    {
        echo "<tbody>";

        $username = 'money_root';
        $this->connect($username);
        $sql = "SELECT * FROM transaction WHERE to_days(t_datetime) = to_days(now()) ORDER BY t_datetime DESC";
        if ($stmt = $this->mysqli->prepare($sql)) {
            $stmt->execute();
            $stmt->bind_result($t_id, $t_type, $a_name, $t_datetime, $t_money, $t_location, $t_agent, $in_1, $in_2, $in_3, $in_4, $in_5, $out_1, $out_2, $out_3, $out_4, $out_5, $t_remark);
            while ($stmt->fetch()) {
                switch ($t_type) {
                    case 'in':
                        $sign = '+';
                        if (!empty($in_5)) {
                            $category = $in_5;
                        } elseif (!empty($in_4)) {
                            $category = $in_4;
                        } elseif (!empty($in_3)) {
                            $category = $in_3;
                        } elseif (!empty($in_2)) {
                            $category = $in_2;
                        } elseif (!empty($in_1)) {
                            $category = $in_1;
                        }
                        break;

                    case 'out':
                        $sign = '-';
                        if (!empty($out_5)) {
                            $category = $out_5;
                        } elseif (!empty($out_4)) {
                            $category = $out_4;
                        } elseif (!empty($out_3)) {
                            $category = $out_3;
                        } elseif (!empty($out_2)) {
                            $category = $out_2;
                        } elseif (!empty($out_1)) {
                            $category = $out_1;
                        }
                        break;

                    default:
                        # code...
                        break;
                }

                //$datetime = date('y-m-d H:i', strtotime($t_datetime));
                $money = sprintf('%.2f', $t_money);

                echo "<tr>";
                echo "<td class='category'>$category</td>";
                echo "<td class='money'>$sign$money</td>";
                echo "</tr>";

            }
            $stmt->close();
        }

        $this->mysqli->close();
        echo "</tbody>";
    }
}

$index_trans_data = new IndexTransData;
