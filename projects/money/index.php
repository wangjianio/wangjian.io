<?php
namespace wangjian\wangjianio\projects\money;

require_once __DIR__ . '/includes/IndexTransactionData.php';
require_once __DIR__ . '/includes/AddTransForm.php';

$title = 'Money - 个人财务管理';
$nav_type = 'money';
$subnav_type = 'index';

$extra_css .= '<link rel="stylesheet" href="/styles/jquery.datetimepicker.css">';
$extra_css .= '<link rel="stylesheet" href="/node_modules/bootstrap-select/dist/css/bootstrap-select.css">';
$extra_js = '<script src="/scripts/jquery.datetimepicker.full.min.js"></script>';
$extra_js .= '<script src="/node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>';
$extra_js .= '<script src="scripts/money.js"></script>';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';


// 设定日期的显示
$arr_month = array("无","一","二","三","四","五","六","七","八","九","十","十一","十二");
$arr_week = array("日","一","二","三","四","五","六");

$year = date('Y');
$month = $arr_month[date('n')];
$week = $arr_week[date('N')];
$day = date('d');
?>


    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6"><!-- 在 sm 及以上屏幕显示在左半侧，在 xs 屏幕上显示 100% 宽度 -->
                <div class="row">

                    <!-- 当前日期 -->
                    <div class="col-xs-12 h1" style="width:320px;">
                        <span class="pull-left day" style="font-size: 80px; margin-right: 8px;"><?php echo $day; ?></span>
                        <span class="pull-left week" style="font-size: 24px; margin-top: 16px;"><?php echo "星期$week"; ?></span>
                        <span class="pull-left month" style="font-size: 32px;"><?php echo "{$month}月 $year"; ?></span>
                    </div>

                    <!-- 添加记录按钮，在 md lg 屏幕显示加号 -->
                    <a class="pull-right visible-md-inline visible-lg-inline btn-custom-add" data-toggle="modal" data-target="#addTransFormModal"
                        style="position: absolute; right: 15px; top: 20px; cursor: pointer;">
                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true" style="font-size: 80px"></span>
                    </a>

                </div><!-- .row -->

                <!-- 添加记录按钮，在 sm xm 屏幕显示宽按钮 -->
                <button class="btn btn-primary btn-lg btn-block visible-xs-block visible-sm-block btn-custom-add"  type="button" data-toggle="modal"
                    data-target="#addTransFormModal" style="margin-bottom: 8px;">
                    添加记录
                </button>

                <!-- 当日的交易记录 -->
                <?php 
                $trans_data = new IndexTransactionData;
                $trans_data->printTable(); 
                ?>

            </div><!-- .col -->

            <!-- 在 sm 及以上屏幕显示在右半侧，在 xs 屏幕上显示 100% 宽度 -->
            <div class="col-xs-12 col-sm-6">
                <div class="page-header">
                    <h1>概况</h1>
                </div>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>借记账户</th>
                            <th>980.32</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>工商银行</td>
                            <td>100.11</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div><!-- .row -->
    </div><!-- .container -->

    <!-- 添加记录弹出的 modal -->
    <div class="modal fade" id="addTransFormModal" tabindex="-1" role="dialog" aria-labelledby="addTransFormModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- 标题 -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">添加记录：</h4>
                </div>
                <!-- 主体 -->
                <div class="modal-body" style="padding-right: 24px; padding-left: 24px">
                    <form class="form-horizontal" id="add_transaction_form" name="add_transaction_form" method="post" action="transaction/adder">
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="t_type">类　型</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-th-list"></span>
                                    </span>
                                    <select class="form-control selectpicker" id="t_type" name="t_type" data-mobile="true" onchange="changeFormControl(this)">
                                        <?php $add_trans_form->printTransactionTypeSelectOption(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="datetimepicker">时　间</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input class="form-control" id="datetimepicker" name="t_datetime" type="text" placeholder="2017/01/01 00:00">
                                </div>
                            </div>
                        </div>

                        <div id="dynamic_form">
                            <!-- 根据选择的交易类型用 js 动态载入表单项 -->
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="t_remark">备　注</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </span>
                                    <input class="form-control" id="t_remark" name="t_remark" type="text" placeholder="选填">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                
                <!-- 按钮 -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" onclick="submitForm('add_transaction_form')">提交</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            // 点击添加按钮时载入表单
            $('.btn-custom-add').click(function(){
                $('#dynamic_form').load('transaction/add?out', function () {
                    $('.selectpicker').selectpicker('refresh');
                });
            });

            $('form[name="category"]').change(function () {
                $('.preselect').attr('disabled', 'disabled');
            })
        });

        // 动态加载表单选项
        function changeFormControl(obj) {
            $('#dynamic_form').load('transaction/add?' + obj.value, function () {
                $('.selectpicker').selectpicker('refresh');
            });
        }


    </script>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
