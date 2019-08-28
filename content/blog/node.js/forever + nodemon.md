---
title: forever + nodemon
date: 2018-03-19
description: forever 和 nodemon 配合使用
---

forever 用来后台持续运行一项服务，nodemon 监控文件变化，重启服务。

```bash
forever -c nodemon index.js &
```

`forever list` 可查看当前启动的所有进程，但可能不准确，使用  `ps -ef | grep node` 查看实际的所有进程。另外可使用 `pkill node` 或 `killall node`（未验证）杀掉所有 node 进程