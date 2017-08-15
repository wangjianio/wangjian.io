<?php
namespace wangjian\wangjianio\projects\money;

/**
 * 用于连接数据库的类。
 */
class Database
{
    /**
     * 根据不同的用户名连接数据库，在数据库设置好权限，用于保障数据库安全。
     * 注意：需用 close() 函数关闭。
     *
     * @param string $username 登录数据库的用户名。
     * @return int 连接成功返回 0，失败输出错误信息。
     */
    public function connect($username)
    {
        echo 'cc';

        $hostname = '127.0.0.1';
        $database = 'money';

        switch ($username) {
            // 拥有 Money 数据库的全部权限，主要用于调试
            case 'money_root':
                $password = 'Z_WG-7vNPQ"I06JU';
                break;
            // 只有视图的 SELECT 权限
            case 'money_view_select':
                $password = 'mnTpSiQnC4X5fRze';
                break;
            // 拥有 account_type 表的 SELECT 和 UPDATE 权限
            case 'money_table_account_type':
                $password = 'hm57EoYey5NiAIkV';
                break;
            // 拥有 account 表的 UPDATE 权限和其中 a_id 列的 SELECT 权限
            case 'money_table_account_update':
                $password = 'tRMFt4prrOfVjsYu';
                break;
            // 拥有 category_in & category_out 表的 SELECT 权限
            case 'money_table_category_select':
                $password = '1iFfRk5jatMLsyzF';
                break;

            default:
                exit('Error.' . __FUNCTION__ . __LINE__);
                break;
        }

        $this->mysqli = new \mysqli($hostname, $username, $password, $database);

        // 如果连接错误输出错误信息，否则将编码设置为 UTF-8
        if ($this->mysqli->connect_errno) {
            exit("Failed to connect to MySQL: $this->mysqli->connect_error");
        } else if (!$this->mysqli->set_charset("utf8")) {
            exit("Error loading character set utf8: $this->mysqli->error");
        }
    }
}

$database = new Database;
