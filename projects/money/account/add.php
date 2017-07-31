<?php
namespace wangjian\wangjianio\projects\money;

echo <<<A
  <form class="form-horizontal" id="editAccountForm" name="editAccountForm" method="post" action="editor?a_type=$a_type">
    <div class="form-group">
      <div class="col-xs-6">
        <input class="form-control" 
                name="{$a_type}[{$account_info[$i]['a_id']}][a_name]"
                type="text" 
                value="{$account_info[$i]['a_name']}"
                placeholder="输入名称">
      </div><!-- .col -->
      <div class="col-xs-6">
        <input class="form-control" 
                name="{$a_type}[{$account_info[$i]['a_id']}][$col_name_1]"
                type="number" 
                value="{$account_info[$i][$col_name_1]}"
                placeholder="输入金额"
                step="0.01">
      </div><!-- .col -->
    </div><!-- .form-group -->
A;
