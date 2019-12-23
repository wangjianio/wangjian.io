---

title: 在前端开发中妥善的处理 CORS 问题
date: 2019-11-12
description: 列举了平时开发中常见的问题与解决方案。
---

## 先复习一下

CORS: Cross-Origin Resource Sharing 跨域资源共享。

请先通读一遍 MDN 上的文章：https://developer.mozilla.org/zh-CN/docs/Web/HTTP/Access_control_CORS

## 什么是跨域

假设当前地址为 `http://localhost:5000/post.html?id=101#title`。

在浏览器控制台执行 `window.location`，会返回下面的内容（部分）：

```json
{   
    "hash": "#title",
    "host": "localhost:5000",
    "hostname": "localhost",
    "href": "http://localhost:5000/post.html?id=101#title",
    "origin": "http://localhost:5000",
    "pathname": "/post.html",
    "port": "5000",
    "protocol": "http:",
    "search": "?id=101"
}
```

虽然 MDN 把 CORS 翻译成跨域资源共享[1]，但实际上并不是跨域名，而是跨源。我们看下 CO 的英文：Cross-Origin，再结合上面的 `window.location.origin` 就很好懂了。

源（origin）是由协议（protocol）、主机名（hostname）、端口（port）组成的，所以只要这三者之一不同，就属于跨源。

> 主机名（hostname）可能是域名（www.example.com）也可能是 IP（127.0.0.1）。

> http 默认 80 端口，http 默认 443 端口。端口显式或隐式的写法属于同一端口。
> 例：在 `https://www.example.com/` 请求 `https://www.example.com:443/api` 不属于跨源。

## HTTP 访问控制（Access Control）

### 需要了解的 Header

详细内容去 MDN 看：https://developer.mozilla.org/zh-CN/docs/Web/HTTP/Access_control_CORS#HTTP_响应首部字段

这里总结一下

- 均为 Access-Control- 开头
    - 四个 Allow（Origin、Credentials、Methods、Headers）
    - 一个 Expose-Headers
    - 预检返回头 Max-Age
    - 预检查请求头两个，Request 开头（Method、Headers）

```
Access-Control-Allow-Origin
Access-Control-Expose-Headers
Access-Control-Max-Age
Access-Control-Allow-Credentials
Access-Control-Allow-Methods
Access-Control-Allow-Headers

Access-Control-Request-Method
Access-Control-Request-Headers
```

#### 跨域携带 Cookie

默认跨域是不携带 Cookie 的，如需携带，浏览器端需手动设置：

```js
// fetch
fetch('http://www.example.com/api', {
    credentials: 'include'
});

// jQuery
$.ajax({
   url: 'http://www.example.com/api',
   xhrFields: {
      withCredentials: true
   }
});
```

此时服务端返回头的 Access-Control-Allow-Origin（以下简称 Allow-Origin）将不可以是 `*`，需要为确定的源（如 http://www.example.com）。且 Allow-Credentials 必须为 `true`。


[1] https://developer.mozilla.org/zh-CN/docs/Glossary/CORS
