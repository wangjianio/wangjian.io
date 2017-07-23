<?php
namespace lopedever\money;

include __DIR__ . '/AccountInfo.php';

class EditAccount extends AccountInfo
{
    public function printEditForm($a_type)
    {
        $account_info = $this->query('money_view_select', "SELECT * FROM account_$a_type");
        $count = count($account_info);

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
                exit('Error.' . __FUNCTION__ . __LINE__);
                break;
        }

        echo '<form id="edit_account" name="edit_account" method="post" action="editor.php?a_type=' . $a_type . '">';
        echo '<table>';
        echo '
        <label>类别名称：
        <input
          type="text"
          name="a_type_description"
          value="' . $this->getAccountTypeDescription($a_type) . '"
          placeholder="输入类别名称">
        </label>';

        $this->printTableHead($a_type);

        for ($i = 0; $i < $count; $i++) {
            echo '
            <input
              type="hidden"
              name="' . $a_type . '[' . $account_info[$i]['a_id'] . '][a_id]"
              value="' . $account_info[$i]['a_id'] . '">

            <tr>
              <td>
                <input
                  class="' . $a_type . '"
                  type="text"
                  name="' . $a_type . '[' . $account_info[$i]['a_id'] . '][a_name]"
                  value="' . $account_info[$i]['a_name'] .'"
                  placeholder="输入名称"
                  step="0.01">
              </td>
              <td>
                <input
                  class="' . $a_type . '"
                  type="number"
                  name="' . $a_type . '[' . $account_info[$i]['a_id'] . '][' . $col_name . ']"
                  value="' . $account_info[$i][$col_name] .'"
                  placeholder="输入金额"
                  step="0.01">
              </td>';

              if ($a_type == 'credit') {
                  echo '
                  <td>
                    <input
                      class="' . $a_type . '"
                      type="number"
                      name="' . $a_type . '[' . $account_info[$i]['a_id'] . '][' . $col_name_2 . ']"
                      value="' . $account_info[$i][$col_name_2] .'"
                      placeholder="输入金额"
                      step="0.01">
                  </td>';
              }

            echo '</tr>';
        }

        echo '</table>';
        echo '</form>';
    }

    public function updateQuery($username, $sql)
    {
        $this->connect($username);

        if (!$query = $this->mysqli->query($sql)) {
            exit ('Error.' . __FUNCTION__ . __LINE__ . $this->mysqli->error);
        }

        $this->mysqli->close();
    }
}

$edit_account = new EditAccount;
