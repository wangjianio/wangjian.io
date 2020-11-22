---
title: 终端短篇
date: 2016-03-16
---

## 还原 macOS 中的 DNS 缓存设置

OS X 10.10.4 及更高版本： `sudo killall -HUP mDNSResponder`

OS X 10.10 至 10.10.3 中： `sudo discoveryutil mdnsflushcache`

OS X 10.9.5 及更低版本： `sudo killall -HUP mDNSResponder`

OS X 10.6 至 10.6.8 中： `sudo dscacheutil -flushcache`

> 参考资料： [https://support.apple.com/zh-cn/HT202516](https://support.apple.com/zh-cn/HT202516)

## macOS Sierra 允许从以下位置下载的应用：任何来源

```shell
sudo spctl --master-disable
```

## 重置 Launchpad

```shell
defaults write com.apple.dock ResetLaunchPad -bool true && killall Dock
```

## 重置 Dock

```shell
rm ~/Library/Application\ Support/Dock/*.db && killall Dock
```

即：删除 `~/Library/Application Support/Dock/`目录下的`desktoppicture.db`

## 校验 SHA-1 值

```shell
shasum /path
```

## 校验 MD5 值

```shell
md5 /path
```

## 显示隐藏文件

```shell
defaults write com.apple.finder AppleShowAllFiles -bool true; killall Finder
```

macOS Sierra 下快捷键： `Command + Shift + .`

## 隐藏隐藏文件

```shell
defaults write com.apple.finder AppleShowAllFiles -bool false; killall Finder
```

macOS Sierra 下快捷键： `Command + Shift + .`

## 获取局域网 ip 地址

通过 AppleScript 获取：

```shell
osascript -e "IPv4 address of (system info)"
```

获取后输出并复制到剪贴板：

```shell
osascript -e "IPv4 address of (system info)" && echo -n `osascript -e "IPv4 address of (system info)"` | pbcopy
```

