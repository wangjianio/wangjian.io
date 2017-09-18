<?php
$title = '12306 短信保存到日历';
$nav_type = 'workflow';
$subnav_type = '12306';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

    <div class="container">

      <div class="page-header">
        <h1><?php echo $title; ?></h1>
      </div>

      <h2>使用方法</h2>
      <p>复制 12306 短信，在应用内或通知中心运行 Workflow，选择目的地，即可将火车票信息保存到系统日历（需使用网络）。</p>
      <p>如遇到错误、问题，请联系我。</p>

      <h2>效果预览</h2>
      <p>如遇到错误、问题，请联系我。</p>

      <h2>更新日志</h2>

      <h3>v1.4 <small> - 20170515 <a href="https://workflow.is/workflows/d0b54ab4a71f4cb2bb476c4afe2c20e1" target="_blank">GET</a></small></h3>
      <o>更新变量名，方便大家辨识结果来源并根据需要修改；</p>
      <p>增加验证机制，若短信中的发车时间与 API 查询结果不符：发车时间以短信为准，到站时间使用 API 数据计算。</p>

      <h3>v1.3 <small> - 20170504 <a href="https://workflow.is/workflows/43c23c8df41c49a881b548bc35c7b318" target="_blank">GET</a></small></h3>
      <p>修复了在始发站出发不能正确确定时间的 bug。</p>
      
      <h3>v1.2 <small> - 20170407 <a href="https://workflow.is/workflows/c50626367c8e4d649f5978338a432e15" target="_blank">GET</a></small></h3>
      <p>感谢 <a href="https://twitter.com/ysjiang4869" target="_blank">@ysjiang4869</a> 介绍的接口，现在只需要选择目的地即可完成操作（需使用网络）；</p>
      <p>现支持在通知中心直接运行，但如果可选车站列表大于 16 个，在通知中心会显示不全，届时请进入应用运行。</p>
      
      <h3>v1.1 <small> - 20170408 <a href="https://workflow.is/workflows/b5818e1f1b2b4f10a88d0445f961221e" target="_blank">GET</a></small></h3>
      <p>修复 bug，新增支持无座票。至此已支持所有类型短信。</p>
      
      <h3>v1.0 <small> - 20170407 <a href="https://workflow.is/workflows/9c581dd83da74c33bbfe17fa937bfbc7" target="_blank">GET</a></small></h3>
      <p>初始版本。</p>
      
    </div><!-- container -->

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
