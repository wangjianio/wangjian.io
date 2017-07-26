<?php
namespace lopedever\money;

include dirname(__DIR__) . '/database/Database.php';

class PrintTransData extends Database
{
    public function printTable()
    {
        echo '<table class="table table-hover table-condensed">';
        $this->printTableHead();
        //$this->printTableFoot();
        $this->printTableBody();
        echo '</table>';
    }

    public function printTableHead()
    {
        echo <<<THEAD
        <thead>
          <tr>
            <th class="type">类型</th>
            <th class="account">账户</th>
            <th class="datetime">时间</th>
            <th class="money">金额</th>
            <th class="category">类别</th>
            <th class="location">地点</th>
            <th class="agent">相关人</th>
            <th class="remark">备注</th>
            <th class="action">操作</th>
          </tr>
        </thead>
THEAD;
    }

    public function printTableFoot()
    {
        echo <<<TFOOT
        <tfoot>
          <tr>
            <td class="page" colspan="9">上一页 1 2 3 4 下一页</td>
          </tr>
        </tfoot>
TFOOT;
    }

    public function printTableBody()
    {
        echo '<tbody>';

        $username = 'money_root';
        $this->connect($username);

        switch ($_GET['type']) {
            case '收入':
                $sql = "SELECT * FROM transaction WHERE t_type = 'in' ORDER BY t_datetime DESC";
                break;
            case '支出':
                $sql = "SELECT * FROM transaction WHERE t_type = 'out' ORDER BY t_datetime DESC";
                break;
            
            default:
                $sql = "SELECT * FROM transaction ORDER BY t_datetime DESC";
                break;
        }

        if ($stmt = $this->mysqli->prepare($sql)) {
            $stmt->execute();
            $stmt->bind_result($t_id, $t_type, $a_name, $t_datetime, $t_money, $t_location, $t_agent, $in_1, $in_2, $in_3, $in_4, $in_5, $out_1, $out_2, $out_3, $out_4, $out_5, $t_remark);
            while ($stmt->fetch()) {
                switch ($t_type) {
                    case 'in':
                        $type = '收入';

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
                        $type = '支出';

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

                // 如果交易时间为当前年份，则只显示月、日、时、分
                // 否则显示年月日、时分
                if (date('y', strtotime($t_datetime)) == date('y')) {
                    $datetime = date('m-d H:i', strtotime($t_datetime));
                } else {
                    $datetime = date('y-m-d H:i', strtotime($t_datetime));
                }
                
                // 格式化金额，保留两位小数
                $money = sprintf('%.2f', $t_money);

                if ($t_type == 'in') {
                }

                echo <<<TR
                <tr>
                <td class="type">$type</td>
                <td class="account">$a_name</td>
                <td class="datetime">$datetime</td>
                <td class="money">$money</td>
                <td class="category">$category</td>
                <td class="location">$t_location</td>
                <td class="agent">$t_agent</td>
                <td class="remark">$t_remark</td>
                <td class="action"><a href="">编辑</a> <a href="delete.php?id=$t_id">删除</a></td>
                </tr>
TR;
            }
            $stmt->close();
        }

        $this->mysqli->close();

        echo "</tbody>";
    }

    public function printTransCate()
    {
        # code...
    }
}

$print_trans_data = new PrintTransData;
