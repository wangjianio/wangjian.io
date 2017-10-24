<?php
$title = '12306 短信保存到日历 - Workflow';
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
      <p>如遇到错误、问题或有好的建议，请根据页面最下方的 <a href="#contact-info">联系方式</a> 联系我。</p>

      <h2>效果预览</h2>
      <img src="images/1.png" alt="预览图 1" width="45%">
      <img src="images/2.png" alt="预览图 2" width="45%">

      <h2>注意事项</h2>
      <p>在通知中心运行时目的地列表最多只能显示 16 个，如果可选站点过多且没有想要的结果，请到应用内运行；</p>
      <p>因现在直接从 12306.cn 查询，所以有效的日期在最近 30 天左右，所以对已经发车的行程没有很好的支持，一般最多到前两天；</p>
      <p>由于现在 12306 短信在出发车站后增加了“站”字，所以 1.x 版本全部失效，若要使用可以把短信中的“站”字去掉后复制运行；</p>
      <p>由于正则表达式的原因，大陆号、低窝铺、读书铺、路口铺、那铺、上西铺、新窝铺、照福铺、白沙铺、哈达铺车站上车的朋友们，使用起来<strong>可能</strong>会出现问题，我会尽力解决。</p>

      <h2>隐私声明</h2>
      <p>本 Workflow 仅会向 <a href="https://www.jisuapi.com" target="_blank">api.jisuapi.com</a> 上传短信中的<strong>车次</strong>信息，用来获取可能的到达站选项。</p>
      <p>本 Workflow 会向本站，即 <a href="https://wangjian.io">wangjian.io</a> 上传短信中的<strong>日期</strong>、<strong>车次</strong>、<strong>出发站</strong>和手动选择的<strong>到达站</strong>，用来获取出发时间和到达时间。</p>
      <p>其他信息操作均在本地 Workflow App 内完成，大家可放心使用。</p>

      <h2>更新日志</h2>

      <h3>v2.0<small> - 20171023 <a href="https://workflow.is/workflows/c705dbe4e45c4d42a645487effeb3d39" target="_blank">GET</a></small></h3>
      <p>现在列车时间直接从 12306.cn 查询，时间不再出错；</p>
      <p>新增支持短信中的检票口信息；</p>
      <p>现在仅支持在售车票行程（即还未发车），历史短信无效。</p>

      <h3>v1.4<small> - 20170515 <a href="https://workflow.is/workflows/d0b54ab4a71f4cb2bb476c4afe2c20e1" target="_blank">GET</a></small></h3>
      <p>更新变量名，方便大家辨识结果来源并根据需要修改；</p>
      <p>增加验证机制，若短信中的发车时间与 API 查询结果不符：发车时间以短信为准，到站时间使用 API 数据计算。</p>

      <h3>v1.3<small> - 20170504 <a href="https://workflow.is/workflows/43c23c8df41c49a881b548bc35c7b318" target="_blank">GET</a></small></h3>
      <p>修复了在始发站出发不能正确确定时间的 bug。</p>
      
      <h3>v1.2<small> - 20170407 <a href="https://workflow.is/workflows/c50626367c8e4d649f5978338a432e15" target="_blank">GET</a></small></h3>
      <p>感谢 <a href="https://twitter.com/ysjiang4869" target="_blank">@ysjiang4869</a> 介绍的接口，现在只需要选择目的地即可完成操作（需使用网络）；</p>
      <p>现支持在通知中心直接运行，但如果可选车站列表大于 16 个，在通知中心会显示不全，届时请进入应用运行。</p>
      
      <h3>v1.1<small> - 20170408 <a href="https://workflow.is/workflows/b5818e1f1b2b4f10a88d0445f961221e" target="_blank">GET</a></small></h3>
      <p>修复 bug，新增支持无座票。至此已支持所有类型短信。</p>
      
      <h3>v1.0<small> - 20170407 <a href="https://workflow.is/workflows/9c581dd83da74c33bbfe17fa937bfbc7" target="_blank">GET</a></small></h3>
      <p>初始版本。</p>
      
    </div><!-- container -->

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
