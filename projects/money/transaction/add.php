<?php
namespace wangjian\wangjianio\projects\money;

require_once dirname(__DIR__) . '/includes/AddTransForm.php';

if (count($_GET) != 1) { exit; }

$a_type = key($_GET);

$username = 'money_root';
$add_trans_form->connect($username);

$add_trans_form->printDynamicFormControl($a_type);

$add_trans_form->mysqli->close();

?>


<script>
    $(document).ready(function () {
        // 设置日期选择器的默认值为当前时间
        $.datetimepicker.setLocale('zh');
        $('#datetimepicker').datetimepicker({
            value: getNowFormatDate(),
            step: 1
        });
        
        $('select.category').change(function () {
            $('.preselect').attr('disabled', 'disabled');
        })
    })

</script>
