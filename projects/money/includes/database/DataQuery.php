<?php
namespace lopedever\money;

include __DIR__ . '/Database.php';

/**
 * 用于数据库查询的类。
 */
class DataQuery extends Database
{
    /**
     * 根据参数以数组返回某类账户信息。
     *
     * @param char $username 登录 MySQL 的用户名。
     * @param char $sql 要执行的 SQL 语句。
     * @return array[][] 表的二维数组：['行数']['列数或列名']。
     * @return int -1 表示执行失败。
     */
    public function query($username, $sql)
    {
        $this->connect($username);

        if ($result = $this->execSql($sql)) {
            return $result;
        } else {
            return -1;
        }

        $this->mysqli->close();

    }

    /**
     * 执行简单的函数并返回结果。
     *
     * @param char $table 表名
     * @param char $col_name 列名
     * @param char $func 函数名
     * 
     * @return mixed 结果
     */
    public function sqlFunc($table, $col_name, $func)
    {
        $this->connect('money_view_select');

        $sql = "SELECT $func($col_name) FROM $table";
        $result = $this->execSql($sql);
        $result = $result[0][0];

        $this->mysqli->close();
        
        return $result;
    }

    /**
     * 执行 SQL 语句并以数组返回查询结果。
     * 
     * @param char $sql SQL 语句。
     * @param 连接数据库的实例（误
     * @return array[int][int/string] 表的二维数组：['行数']['列数或列名']。
     */
    public function execSql($sql)
    {
        // 将所有信息保存到数组
        if (!$query = $this->mysqli->query($sql)) {
            exit('Error.' . __FUNCTION__ . __LINE__ . $this->mysqli->error);
        }

        while ($info = $query->fetch_array()) {
            $result[] = $info;
        }

        $query->close();

        // 检查后给出返回值
        if (is_array($result) && isset($result)) {
            return $result;
        } elseif (!isset($result)) {
            exit('无');
        } else {
            exit('Error.' . __FUNCTION__ . __LINE__);
        }
    }
}

$data_query = new DataQuery;
