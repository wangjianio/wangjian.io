<?php
namespace wangjian\wangjianio\projects\money;

require_once __DIR__ . '/Database.php';

class IndexTransactionData extends Database
{
    public function printTable()
    {
        $username = 'money_root';
        $this->connect($username);

        echo '<table class="table table-hover table-bordered">';
        $this->printTableHead();
        $this->printTableFoot();
        $this->printTableBody();
        echo '</table>';

        $this->mysqli->close();        
    }

    public function printTableHead() {}

    public function printTableFoot()
    {
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


        $in_money = sprintf("%.2f", $in_money);
        $out_money = sprintf("%.2f", $out_money);

        echo '<tfoot><tr>';

        if ($in_money != 0 && $out_money != 0) {

            echo '<td class="sum">总支出<br>总收入</td>';
            echo "<td>$out_money<br>$in_money</td>";
        
        } else if ($in_money == 0 && $out_money == 0) {
        } else if ($in_money == 0 && $out_money != 0) {
        
            echo '<td class="sum">总支出</td>';
            echo "<td>$out_money</td>";
        
        } else if ($in_money != 0 && $out_money == 0) {
        
            echo '<td class="sum">总收入</td>';
            echo "<td>$in_money</td>";
        
        }

        echo '</tr></tfoot>';
    }

    public function printTableBody()
    {
        echo "<tbody>";

        $sql = "SELECT * FROM transaction WHERE to_days(t_datetime) = to_days(now()) ORDER BY t_datetime DESC";
        if ($stmt = $this->mysqli->prepare($sql)) {
            $stmt->execute();
            $stmt->bind_result($t_id, $t_type, $a_name, $t_datetime, $t_money, $t_location, $t_agent, $cate_1, $cate_2, $cate_3, $t_remark);
            while ($stmt->fetch()) {
                switch ($t_type) {
                    case 'in':
                        $sign = '+';
                        if (!empty($cate_3)) {
                            $category = $cate_3;
                        } elseif (!empty($cate_2)) {
                            $category = $cate_2;
                        } elseif (!empty($cate_1)) {
                            $category = $cate_1;
                        }
                        break;

                    case 'out':
                        $sign = '-';
                        if (!empty($cate_3)) {
                            $category = $cate_3;
                        } elseif (!empty($cate_2)) {
                            $category = $cate_2;
                        } elseif (!empty($cate_1)) {
                            $category = $cate_1;
                        }
                        break;

                    default:
                        # code...
                        break;
                }

                //$datetime = date('y-m-d H:i', strtotime($t_datetime));
                $money = sprintf('%.2f', $t_money);

                echo "<tr>";
                echo "<td class=\"category\">$category</td>";
                echo "<td class=\"money\">$sign$money</td>";
                echo "</tr>";

            }
            $stmt->close();
        }

        echo "</tbody>";
    }
}
