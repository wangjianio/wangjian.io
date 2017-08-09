# Apache Module mod_rewrite

http://httpd.apache.org/docs/2.4/mod/mod_rewrite.html

**描述：**一个使用规则重写被请求的 URL 的引擎

**状态：**扩展

**模块标识符：**rewrite_module

**源文件：**mod_rewrite.c

### 概要

`mod_rewrite` 模块使用一个基于规则的重写引擎，基于 PCRE 正则表达式解析器，来即时重写被请求的 URL。默认情况下，`mod_rewrite` 映射 URL 到一个文件系统路径。但是它也可以用来重定向一个 URL 到另一个 URL，或者调用一个内部代理However, it can also be used to redirect one URL to another URL, or to invoke an internal proxy fetch.

`mod_rewrite` 提供了灵活且强大的方式操作 URL。可以使用不限量的规则，每条规则可以附加不限量的条件，允许你使用服务器变量、环境变量、HTTP 头信息或时间戳重写 URL 。

`mod_rewrite` 对整个 URL 路径起作用，包括路径信息（path-info）。在 `httpd.conf` 或 `.htaccess` 中的规则可以生效。重写规则生成的路径可以包括参数字符串，可以转到内部的子处理部分、外部请求重定向或内部代理。

更多详情、讨论和例子，见 [mod_rewrite 文档](http://httpd.apache.org/docs/2.4/rewrite/)。

## Logging

`mod_rewrite` offers detailed logging of its actions at the `trace1` to `trace8` log levels. The log level can be set specifically for `mod_rewrite` using the `LogLevel` directive: Up to level `debug`, no actions are logged, while `trace8` means that practically all actions are logged.

`mod_rewrite` 提供 `trace1` 到 `trace8` 8 个级别来记录处理详情。使用 `LogLevel` 指令设定日志级别：

## RewriteBase Directive

**描述：**为 per-directory rewrite 设定基础 URL

**语法：**`RewriteBase URL-path`

**默认值：**无

**环境：**目录、.htaccess

**Override：**FileInfo

**地位：**模块

**模块：**mod_rewrite



The `RewriteBase` directive specifies the URL prefix to be used for per-directory (htaccess) `RewriteRule` directives that substitute a relative path.

`RewriteBase` 指令指定了 URL 前缀来替代 .htaccess 中 `RewriteRule` 指令的相对路径。

This directive is *required* when you use a relative path in a substitution in per-directory (htaccess) context unless any of the following conditions are true:

当 .htaccess 中的替换链接使用相对链接时，这个语句是*必须的*。除非：

- The original request, and the substitution, are underneath the `DocumentRoot` (as opposed to reachable by other means, such as `Alias`).

- 原始请求和替换链接都在 `DocumentRoot` 下（而不是通过其他方式达到，比如 `Alias`）。

- The *filesystem* path to the directory containing the `RewriteRule`, suffixed by the relative substitution is also valid as a URL path on the server (this is rare).

- 目录的文件系统路径包含 `RewriteRule`，后缀为相对替换，作为服务器上的 URL 路径同样有效（这很少见）。

- 在 Apache HTTP Server 2.4.16 及更新版本，当请求通过 [`Alias`](http://httpd.apache.org/docs/2.4/mod/mod_alias.html#alias) 或 [`mod_userdir`](http://httpd.apache.org/docs/2.4/mod/mod_userdir.html) 映射时，这个命令也许会被忽略。


In the example below, `RewriteBase` is necessary to avoid rewriting to http://example.com/opt/myapp-1.2.3/welcome.html since the resource was not relative to the document root. This misconfiguration would normally cause the server to look for an "opt" directory under the document root.

在下面的例子中，`RewriteBase` 是必要的去避免重写至 http://example.com/opt/myapp-1.2.3/welcome.html 直到资源不再相对于 DocumentRoot。这个错误配置将使服务器在 DocumentRoot 下寻找 “opt” 目录。

```con
DocumentRoot "/var/www/example.com"
AliasMatch "^/myapp" "/opt/myapp-1.2.3"
<Directory "/opt/myapp-1.2.3">
    RewriteEngine On
    RewriteBase "/myapp/"
    RewriteRule "^index\.html$"  "welcome.html"
</Directory>
```

