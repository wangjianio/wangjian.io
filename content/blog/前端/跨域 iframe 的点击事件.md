---
title: 跨域 iframe 的点击事件
date: 2018-08-14
---

本文主要讲监听不可控的跨域 iframe 的点击。跨域 iframe 通信不在本文讨论范围。



首先，要明确一个前提，也是事实：使用 onclick 或 addEventListener 是不能监听到跨域 iframe 元素的事件的。



就我遇到的应用场景，主要是统计网站广告的点击数据，与广告提供商的数据独立。



分几类：移动端、桌面端；

移动端分 iOS、Android；

iOS 还分 11.2 及以下与 11.3及以上。



## 移动端

移动端相比桌面端有一个特性，就是点击穿透。所以可以利用这个特性监听 iframe 的点击。



### 方法一：覆盖法

大概做法：

在 iframe 上册覆盖一个元素，在 touchstart 或 touchend 时移除，这时 click 就会触发到 iframe 内。不影响 iframe 的点击，也可以得到点击数据。



兼容性：

iOS 11.3（不含 11.3）以下版本只可以在 touchstart 时移除覆盖元素，如果 touchend 时再移除下面的 iframe 不会被点击到。

iOS 11.3 及以上版本此方法无效。

安卓系统 touchstart 或 touchend 时移除均可，touchend 时移除体验会更好写。



### 方法二：activeElement 法

此方法几乎兼容所有平台。



情况一：点击 a 标签，且 target 非 _blank

此法无解。

情况二：点击其他元素，或 target 为 _blank 的超链接

大概做法：

点击 iframe 时会触发当前 window 的 blur 事件，监听当前 window 的 blur 事件，可得到被点击的 iframe 元素。此时便知道哪个 iframe 被点击了。随后可调用 window.focus() 重新设置 activeElement 为主页面。才可直接监听到其他 iframe 的点击（如果不调用 focus 无法监听到点击一个 iframe，又直接点另一个 iframe 的情况）。

```javascript
window.addEventListener('blur', function() {
  console.log(document.activeElement);
  
  setTimeout(function() {
	window.focus();
  }, 0);
});
```

情况二也有例外。

如果点击了一个 a 标签，但是它绑定的 touchend 事件调用了 event.preventDefault()，此时会触发 blur 事件，但不会切换 activeElement

另外如果只需要访问一个 url 的话还可以使用 css。