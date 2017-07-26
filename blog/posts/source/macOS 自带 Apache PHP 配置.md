# macOS 10.12.5 内置 PHP 环境搭建

由于 macOS 自带 PHP 和 Apache 服务器，所以只要稍作配置即可使用。

## 1. 编辑 /private/etc/apache2/httpd.conf 文件

此文件需 root 权限才可编辑，可根据个人习惯选择合适的方法。

### 参考方法

在 Terminal.app 中直接执行 `sudo vi /private/etc/apache2/httpd.conf`，找到 `#LoadModule php_module libexec/httpd/libphp5.so` 这行，删除行首的 `#` 注释符，保存并退出 vi。

## 2. 重启 Apache 服务器

### 参考方法

在 Terminal.app 中执行 `sudo apachectl restart` 。

### 扩展阅读

启动 Apache：`sudo apachectl start`

关闭 Apache：`sudo apachectl stop`

重启 Apache：`sudo apachectl restart`

查看 Apache 版本：`apachectl -v`

## 3. 测试是否成功

打开浏览器，进入 http://localhost/ 或 http://127.0.0.1/ ，如果网页上显示 **It works!** 则说明配置成功。

默认 http://localhost/ 对应电脑上的文件目录为 /Library/WebServer/Documents，理论上只要将 .php 文件放到这个文件夹里就可以访问了，但是这是系统目录，每次操作文件都要输入管理员密码，所以推荐大家使用个人目录 [http://localhost/~username/](http://localhost/~username/) （对应 /Users/username/Sites，没有 Sites 文件夹新建一个即可）调试 PHP，在这个目录下权限问题会得到缓解。

### 参考方法

新建 phpinfo.php 文件，在里面写入 `<?php phpinfo(); ?>` ，并保存到 /Users/username/Sites 内，然后访问 [http://localhost/~username/phpinfo.php](http://localhost/~username/phpinfo.php) ，如果显示出 PHP 配置信息则配置成功。

## 4. 扩展阅读

### 开启网址重写功能

编辑 /private/etc/apache2/httpd.conf 文件，删除 `#LoadModule rewrite_module modules/mod_rewrite.so` 前的注释符，目录权限要有

```
Options FollowSymLinks
AllowOverride all
```

重启 Apache 服务器。

在项目目录内新建 .htaccess 文件，文件示例：

```
# 必须，On 开启网址重写，可修改为 Off 关闭
RewriteEngine On

# 支出正则表达式，格式为 RewriteRule 用户访问链接 实际访问地址

# 表示 链接为 */index 时，访问 */index.php
RewriteRule ^index$ index.php
# 表示 链接为 */article/数字 时，访问 */article/article.php?id=数字
RewriteRule ^article/(\d)$  article/article.php?id=$1
```

.htaccess 文件对当前目录及子目录有效。

### 更改 http://localhost/ 对应的文件目录

编辑 /private/etc/apache2/httpd.conf 文件，更改 

```
DocumentRoot "/Library/WebServer/Documents"
<Directory "/Library/WebServer/Documents">
***
</Directory>
```

中的 `/Library/WebServer/Documents` 为需要的目录，并在 Directory 块中加上新行 `Allow from all` 。

### 如果在开发中使用文件功能（如上传文件）遇到权限问题

方法一：根据需要给文件夹设定更宽松的权限，如 777、756 等，Apache 默认用户和组均为 _www，所以一般更改 Others 的权限即可。

方法二：给 Apache 换一个用户或组：编辑 /private/etc/apache2/httpd.conf 文件，更改 

```
User _www
Group _www
```

部分，比如将 _www 改为 username（你的用户名）即可解决绝大多数在个人目录下开发的权限问题。

## 参考资料

[1]: http://php.net/manual/zh/install.macosx.bundled.php